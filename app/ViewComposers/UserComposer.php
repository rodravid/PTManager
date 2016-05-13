<?php

namespace App\ViewComposers;


use App\User;

class UserComposer
{
    public function composer(View $view)
    {
        $view->with('users', User::select('id', 'name')->pluck('name', 'id')->toArray());
    }
}