<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Project $project) {
            foreach ($project->tasks as $task) {
                $task->delete();
            }
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user()
    {
        return $this->belongsToMany('User', 'project_user', 'project_id', 'user_id');
    }



}
