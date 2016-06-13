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
        $tasks = Task::with('users')
                     ->join('tasks_users', 'tasks_users.task_id', '=', 'tasks.id')
                     ->join('users', 'tasks_users.user_id', '=', 'users.id')
                     ->where([
                         ['tasks.project_id', '=', $projectId],
                         ['tasks.status', '=', $taskStatus]
                     ])
                     ->distinct()
                     ->paginate(3);

        return $tasks;
    }
}