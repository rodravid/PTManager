<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'tasks_users', 'user_id', 'task_id');
    }
}
