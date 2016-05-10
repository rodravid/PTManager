<?php

namespace App\Repositories\Project;


use App\Project;
use Illuminate\Http\Request;

class ProjectRepository implements ProjectRepositoryInterface
{

    public function findById($id)
    {
        return Project::find($id);

    }

    public function findAll()
    {
        return Project::paginate(4);

    }

    public function save(Request $request)
    {
        Project::create($request->all());

    }

    public function update(Request $request, $id)
    {
        Project::find($id)->update($request->all());

    }

    public function delete($id)
    {
        Project::find($id)->delete();

    }
}