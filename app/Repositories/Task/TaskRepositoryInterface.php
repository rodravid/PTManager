<?php

namespace App\Repositories\Task;

use Illuminate\Http\Request;

interface TaskRepositoryInterface
{
    public function find($project);

    public function save(Request $request);

    public function findById($id);

    public function update(Request $request, $id);
}