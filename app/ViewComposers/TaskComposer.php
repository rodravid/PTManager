<?php

namespace App\ViewComposers;

use App\Models\Project;
use App\Models\RF_CODES;
use Illuminate\View\View;

class TaskComposer
{
    public function compose(View $view)
    {
        $view->with('status_open', RF_CODES::select('ref_id', 'name')->where('type', '=', 'Task_Status_Open')->pluck('name', 'ref_id')->toArray());
        $view->with('status_closed', RF_CODES::select('ref_id', 'name')->where('type', '=', 'Task_Status_Closed')->pluck('name', 'ref_id')->toArray());
        $view->with('task_priority', RF_CODES::select('ref_id', 'name')->where('type', '=', 'Task_Priority')->pluck('name', 'ref_id')->toArray());
        $view->with('projects', Project::select('id', 'title')->pluck('title', 'id')->toArray());
    }
}