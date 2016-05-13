<?php

namespace App\Http\Controllers;

use App\Interfaces\ProjectRepositoryInterface;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private $repository;

    public $error = '';

    public function __construct(ProjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    public function get()
    {
        $projects = $this->repository->getAll();
        return view('project.projects', compact('projects'));

    }

    /**
     * @param $project
     * @param $status
     * @return mixed
     */
    public function findProjectWithTasksByStatus($project, $status)
    {
        $project_returned = $this->repository->findProjectWithTasksByStatus($project, $status);

        return view('task.tasks', compact('project_returned', 'status'));
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

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