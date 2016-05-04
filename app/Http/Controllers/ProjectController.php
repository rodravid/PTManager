<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects', compact('projects'));
    }

public function indexPost(Request $request)
{
    Project::create($request->all());
    return redirect()->back();
}
    
    
}