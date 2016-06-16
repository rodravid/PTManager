<?php

namespace App\Repositories;

use App\Interfaces\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    public function save(Request $request)
    {
        $request = $request->all();

        $user = Auth::user();
        $request['user_id'] = $user['id'];

        $taskCreated = Task::create($request);
        $this->designateTaskToUser($request['participants'], $taskCreated['id']);
    }

    public function update(Request $request, $id)
    {
        $request->all()['updated_at'] = date('Y-m-d H:m:s');

        Task::find($id)->update($request->all());
        $this->designateTaskToUser($request['participants'], $id);
    }

    public function designateTaskToUser($users, $taskId = null)
    {
        DB::Table('tasks_users')
            ->select('*')
            ->where('task_id', '=', $taskId)
            ->delete();

        foreach ($users as $user){
            DB::table('tasks_users')
                ->insert([
                    'task_id' => $taskId,
                    'user_id' => $user,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
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
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->name == "admin") {
            return Task::with('users')
                       ->where([
                           ['tasks.project_id', '=', $projectId],
                           ['tasks.status', '=', $taskStatus]
                       ])
                       ->paginate(3);
        }
        
        return Task::with('users')
                   ->where([
                       ['tasks.project_id', '=', $projectId],
                       ['tasks.status', '=', $taskStatus]
                   ])
                   ->whereHas('users', function ($query) use ($authenticatedUser) {
                       $query->where('users.id', '=', $authenticatedUser->id);
                   })
                   ->paginate(3);
    }

    private function getBaseQuery($projectId, $taskStatus)
    {
        return Task::with('users')
                   ->where([
                        ['tasks.project_id', '=', $projectId],
                        ['tasks.status', '=', $taskStatus]
                   ]);
    }
}