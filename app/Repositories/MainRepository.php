<?php

namespace App\Repositories;

use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
class MainRepository implements MainRepositoryInterface
{
    private $project;
    private $task;
    private $user;

    public function __construct(ProjectRepositoryInterface $projectRepository, TaskRepositoryInterface $taskRepository, UserRepositoryInterface $userRepository)
    {
        $this->project = $projectRepository;
        $this->task = $taskRepository;
        $this->user = $userRepository;
    }

    public function getTasksByProject($projectId, $taskStatus)
    {
        $projectReturned = $this->project->findById($projectId);
        $tasksReturned = $this->task->getByProject($projectId, $taskStatus);
        $return = [
            'ProjectReturned' => $projectReturned,
            'TasksReturned' => $tasksReturned
        ];

        return $return;
    }

    public function addTaskOwner($tasks)
    {
        foreach ($tasks as $key => $task)
        {
            if ($task->user_id != 0) {
                $user_name = $this->user->find($task->user_id);
                $tasks[$key]['user_name'] = $user_name[$task->user_id];
            }else{
                $tasks[$key]['user_name'] = '-';
            }
        }

        return $tasks;
    }
}