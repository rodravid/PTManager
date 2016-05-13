<?php

namespace App\Interfaces;


interface MainRepositoryInterface
{
    public function getTasksByProject($project, $taskStatus);
}