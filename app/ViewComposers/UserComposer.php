<?php

namespace App\ViewComposers;

use App\User;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with('users', User::select('id', 'name')->get());
    }
}