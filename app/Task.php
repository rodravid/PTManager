<?php

namespace App;

use App\Presenters\TaskPresenter;
use Illuminate\Database\Eloquent\Model;
use Robbo\Presenter\PresentableInterface;

class Task extends Model implements PresentableInterface
{

    protected $table = 'tasks';
    protected $fillable = ['project_id', 'user_id', 'status', 'priority','title', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects', 'projects.id', 'tasks.project_id');
    }

    public function status()
    {
        return $this->hasOne(RF_CODES::class, 'RF_CODES', 'RF_CODES.ref_id', 'tasks.status');
    }

    public function priority()
    {
        return $this->hasOne(RF_CODES::Class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'tasks_users', 'task_id', 'user_id');
    }
    
    public function getPresenter()
    {
        return new TaskPresenter($this);
    }
}
