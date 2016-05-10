<?php

namespace App\ViewComposers;

use App\Status;
use Illuminate\View\View;

class TaskComposer
{
    public function compose(View $view)
    {
        $view->with('status', Status::select('ref_id', 'name')->where('type', '=', 'Task_Status_Open')->pluck('name', 'ref_id')->toArray());
    }
}