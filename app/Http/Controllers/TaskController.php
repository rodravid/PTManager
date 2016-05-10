<?php

namespace App\Http\Controllers;

use App\Repositories\Task\TaskRepositoryInterface;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;

class TaskController extends Controller
{
    private $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get($project)
    {
        $info = $this->repository->find($project);
        return view('task.tasks', compact('info'));
    }

    public function save(Request $request)
    {
        $this->repository->save($request);
        return redirect()->back();

    }

    public function edit($id)
    {
        $task = $this->repository->findById($id);

        return view('task.editTask', compact('task'));

    }

    public function update(Request $request, $id)
    {
        //Validation
        $this->repository->update($request, $id);

        return redirect('/tasks/view/'.$request->project_id);
    }

    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }
}
