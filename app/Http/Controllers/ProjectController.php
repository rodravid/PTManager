<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
//      //$people = ['Rodrigo', 'Felipe', 'Thiago']
//
//      //return view('welcome', [people => $people]);
//      //return view('welcome')->with('people', $people);
//      //return view('welcome', compact('people'));
//      //-----------DINAMIC METHODS---------------------
//      //return view('welcome')->withPeople($people);

        return view('welcome');
    }

public function indexPost(Request $request)
{
    Project::create($request->all());
    return redirect()->back();
}
    
    
}