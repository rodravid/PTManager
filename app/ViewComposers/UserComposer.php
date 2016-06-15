<?php

namespace App\ViewComposers;

use App\Models\User;
use Illuminate\View\View;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with('users', User::select('id', 'name')->where('id', '!=', 1)->get());
    }
}