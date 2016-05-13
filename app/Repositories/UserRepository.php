<?php

namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    public function find($id)
    {
        return User::select('name', 'id')->where('id', '=', $id)->pluck('name', 'id')->toArray();
    }
}