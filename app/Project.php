<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    private $id;

    public function setId($project)
    {
        $this->$id = $project;
    }
    
    public function getId()
    {
        return $this->id;
    }

    protected $fillable = ['name', 'description'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function (Project $project) {
            foreach ($project->tasks as $one) {
                $one->delete();
            }
        });


    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }



}
