<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }

    public function indexPost(Request $request)
    {
        Task::create($request->all());
        return redirect()->back();
    }

    public function indexDelete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back();
    }
}
