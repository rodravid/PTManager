<?php

namespace App\Repositories;

use App\Interfaces\MainRepositoryInterface;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;

class MainRepository implements MainRepositoryInterface
{
    private $project;
    private $task;

    public function __construct(ProjectRepositoryInterface $projectRepository, TaskRepositoryInterface $taskRepository)
    {
        $this->project = $projectRepository;
        $this->task = $taskRepository;
    }

    public function getTasksByProject($projectId, $taskStatus)
    {
        $projectReturned = $this->project->findById($projectId);
        $tasksReturned = $this->task->getByProject($projectId, $taskStatus);

        $return = [
            'ProjectReturned' => $projectReturned->first(),
            'TasksReturned' => $tasksReturned
        ];

        return $return;
    }
}