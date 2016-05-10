<?php

namespace App\Repositories\Task;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskRepository implements TaskRepositoryInterface
{
    public function find($project)
    {
        $project = Project::with('tasks')->find($project);

        $info[0] = $project->tasks;
        $info[1] = $project->id;
        $info[2] = $project->name;

        return $info;
    }

    public function save(Request $request)
    {
        Task::create($request->all());
    }

    public function update(Request $request, $id)
    {
        Task::find($id)->update($request->all());
    }

    public function findById($id)
    {
        return Task::find($id);
    }
}