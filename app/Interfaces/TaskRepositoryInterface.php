<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface TaskRepositoryInterface
{
    public function getAll($project, $status);

    public function save(Request $request);

    public function findById($id);

    public function getByProject($projectId, $taskStatus);

    public function update(Request $request, $id);

    public function delete($id);
}