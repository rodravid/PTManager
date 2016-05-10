<?php

namespace App\Http\Controllers;

use App\Repositories\Project\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $repository;

    public function __construct(ProjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function get()
    {
        $projects = $this->repository->findAll();
        return view('project.projects', compact('projects'));
    }

    public function save(Request $request)
    {
        $this->repository->save($request);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $this->repository->update($request, $id);
        return redirect()->route('projects.index');

    }

    public function edit($id)
    {
        $project = $this->repository->findById($id);
        return view('project.editProject', compact('project'));

    }

    public function delete($id)
    {
        $this->repository->delete($id);
        return redirect()->back();

    }
}