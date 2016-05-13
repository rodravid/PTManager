<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface ProjectRepositoryInterface
{
    public function getAll();
    
    public function findById($id);

    public function findProjectWithTasksByStatus($project, $status);

    public function save(Request $request);

    public function update(Request $request, $id);

    public function delete($id);
}