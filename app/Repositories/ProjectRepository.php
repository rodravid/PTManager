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
        return Project::find($id);

    }

    public function getAll()
    {
        return Project::with('user')
            ->join('project_user', 'projects.id', '=', 'project_id')
            ->where('user_id', '=', '')
            ->paginate(4);

    }

    public function save(Request $request)
    {
        Project::create($request->all());
        $project = Project::get()->last();

        $this->addParticipants($request->participants, $project);

    }

    public function addParticipants(Array $participants, Project $project)
    {
        $project_id = $project->id;
        foreach ($participants as $participant){
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