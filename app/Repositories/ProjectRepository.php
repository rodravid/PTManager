<?php

namespace App\Repositories;

use App\Interfaces\ProjectRepositoryInterface;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function findById($id)
    {
        return Project::find($id);

    }

    public function getAll()
    {
        return Project::paginate(4);

    }

    public function save(Request $request)
    {
        Project::create($request->all());

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