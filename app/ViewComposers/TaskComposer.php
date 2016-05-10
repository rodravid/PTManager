<?php

namespace App\ViewComposers;

use App\Status;
use Illuminate\View\View;

class TaskComposer
{
    public function compose(View $view)
    {
        $view->with('status', Status::all()->pluck('status', 'id')->toArray());
    }
}