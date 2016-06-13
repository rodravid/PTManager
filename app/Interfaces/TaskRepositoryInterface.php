<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface TaskRepositoryInterface
{

    public function save(Request $request);

    public function update(Request $request, $id);

    public function designateTaskToUser($userId, $taskId = null);

    public function findById($id);

    public function getByProject($projectId, $taskStatus);

    public function delete($id);
}