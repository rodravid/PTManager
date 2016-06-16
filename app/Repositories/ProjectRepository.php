<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function findById($id)
    {
        return Project::with('users')
            ->where('projects.id', '=', $id)
            ->first();
    }

    public function getAll($perPage = 4)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->name == "admin"){
            return Project::with('users')->where('projects.deleted_at', '=', null)->paginate(4);
        }

        return Project::with('users')
                      ->where('projects.deleted_at', '=', null)
                      ->whereHas('users', function($query) use ($authenticatedUser) {
                          $query->where('users.id', $authenticatedUser->id);
                      })
                      ->paginate(4);
    }

    public function save(Request $request)
    {
        $project = Project::create($request->all());

        if (empty($request->participants)) {
            return redirect()->back();
        }

        $this->addParticipants($request->participants, $project->id);
    }

    public function update(Request $request, $id)
    {
        Project::find($id)->update($request->all());
        $this->addParticipants($request->participants, $id);
    }

    public function addParticipants(Array $participants, $projectId)
    {
        DB::table('project_user')
            ->where('project_id', '=', $projectId)
            ->delete();

        foreach ($participants as $participant) {
            DB::table('project_user')
                ->insert([
                    'project_id' => $projectId,
                    'user_id' => $participant,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                ]);
        }
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