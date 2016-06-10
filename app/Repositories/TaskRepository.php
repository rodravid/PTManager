<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll($project, $status)
    {
        $projects = Project::with(['tasks' => function($query) use ($status, $project) {

            $query->whereStatus($status);

        }])->find($project);

        $info['Tasks'] = Task::where([
            ['status', '=', $status],
            ['project_id', '=', $project]
        ])->get();

        $info[0] = $projects->tasks;
        $info[1] = $projects->id;
        $info[2] = $projects->name;

        return $info;
    }

    public function save(Request $request)
    {

        $request = $request->all();

        $user = Auth::user();
        $request['user_id'] = (String) $user['id'];

        Task::create($request);
    }

    public function update(Request $request, $id)
    {
        Task::find($id)->update($request->all());
    }

    public function findById($id)
    {
        return Task::find($id);
    }

    public function delete($id)
    {
        Task::find($id)->delete();
    }

    public function getByProject($projectId, $taskStatus)
    {
        return Task::where([
                    ['project_id', '=', $projectId],
                    ['status', '=', $taskStatus]
                ])->paginate(3);
    }
}