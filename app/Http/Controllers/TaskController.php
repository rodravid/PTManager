<?php

namespace App\Http\Controllers;

use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests;

class TaskController extends Controller
{
    private $taskRepository;
    private $mainRepository;
    private $userRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, MainRepositoryInterface $mainRepository, UserRepositoryInterface $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->mainRepository = $mainRepository;
        $this->userRepository = $userRepository;

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
        $tasks = $this->addTaskOwner($return['TasksReturned']);

        return view('task.tasks', compact('tasks', 'taskStatus', 'project'));
    }

    public function addTaskOwner($tasks)
    {
        foreach ($tasks as $key => $task)
        {
            if ($task->user_id != 0) {
                $user_name = $this->userRepository->find($task->user_id);
                $tasks[$key]['user_name'] = $user_name[$task->user_id];
            }else{
                $tasks[$key]['user_name'] = '-';
            }
        }

        return $tasks;
    }
}