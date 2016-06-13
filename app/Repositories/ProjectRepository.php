<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function findById($id)
    {
        return Project::with('users')
            ->where('projects.id', '=', $id)
            ->get();
    }

    public function getAll($perPage = 4)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->name == "admin"){
            // return Project::ofUser()->paginate($perPage);
            return $this->getProjectQueryWithUser()->paginate(4);
        }

        //return Project::ofUser($authenticatedUser->id)->paginate($perPage);

        return $this->getProjectQueryWithUser()
            ->where('users.id', '=', $authenticatedUser->id)
            ->paginate(4);
    }

    public function getProjectQueryWithUser()
    {
        return Project::with('users')
            ->join('project_user', 'projects.id', '=', 'project_id')
            ->join('users', 'project_user.user_id', '=', 'users.id')
            ->select('projects.id', 'projects.title', 'projects.description')
            ->distinct()
            ->where('projects.deleted_at', '=', null);
    }

    public function save(Request $request)
    {
        Project::create($request->all());
        $project = Project::get()->last();

        if (empty($request->participants)) {
            return redirect()->back();
        }

        $this->addParticipants($request->participants, $project);
    }

    public function addParticipants(Array $participants, Project $project)
    {
        $project_id = $project->id;
        foreach ($participants as $participant) {
            DB::table('project_user')->insert([
                'project_id' => $project_id,
                'user_id' => $participant
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        Project::find($id)->update($request->all());

    }

    public function delete($id)
    {
        Project::find($id)->delete();

    }

    public function findProjectWithTasksByStatus($project, $status)
    {
        $project_returned = Project::with(['tasks' => function($query) use ($project, $status) {

            $query->whereStatus($status);
            $query->whereProjectId($project);

        }])->where('id', '=', $project)->get();

        return $project_returned;
    }
}