<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Project;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface
{
    public function save(Request $request)
    {
        $request = $request->all();

        $user = Auth::user();
        $request['user_id'] = (int) $user['id'];

        Task::create($request);
    }

    public function update(Request $request, $id)
    {
        Task::find($id)->update($request->all());
    }

    public function designateTaskToUser($users, $taskId = null)
    {
        if (!empty($taskId)){
            DB::Table('tasks_users')
                ->select('*')
                ->where('task_id', '=', $taskId)
                ->delete();
        }

        foreach ($users as $user){
            DB::table('tasks_user')
                ->insert([

                ]);
        }
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
        $tasks = Task::where([
                    ['project_id', '=', $projectId],
                    ['status', '=', $taskStatus]
                ])->paginate(3);

        return $tasks;
    }
}