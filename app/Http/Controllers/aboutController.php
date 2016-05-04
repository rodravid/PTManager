<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class aboutController extends Controller
{
    public function aboutIndex()
    {
        return view('pages.about'); //  resources/views/pages/about.blade.php
    }
}
