<?php

namespace App\Http\Controllers;

use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests;

class TaskController extends Controller
{
    private $taskRepository;
    private $mainRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, MainRepositoryInterface $mainRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->mainRepository = $mainRepository;

    }
    
    public function save(Request $request)
    {
        $this->taskRepository->save($request);
        return redirect()->back();

    }

    public function edit($id)
    {
        $task = $this->taskRepository->findById($id);

        return view('task.editTask', compact('task'));

    }

    public function update(Request $request, $id)
    {
        //Validation
        $this->taskRepository->update($request, $id);
        $url = '/project/'.$request->all()['project_id'].'/tasks/view/'.$request->all()['status'];
        return redirect($url);
    }

    public function delete($id)
    {
        $this->taskRepository->delete($id);

        return redirect()->back();
    }

    public function getTasksByProject($projectId, $taskStatus)
    {
        $return = $this->mainRepository->getTasksByProject($projectId, $taskStatus);
        $project = $return['ProjectReturned'];
        $tasks = $this->mainRepository->addTaskOwner($return['TasksReturned']);

        return view('task.tasks', compact('tasks', 'taskStatus', 'project'));
    }
}