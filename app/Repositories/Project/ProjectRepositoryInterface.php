<?php

namespace App\Repositories\Project;

use Illuminate\Http\Request;

interface ProjectRepositoryInterface
{
    public function findById($id);

    public function findAll();

    public function save(Request $request);

    public function update(Request $request, $id);

    public function delete($id);
}