<?php

namespace App;

use App\Presenters\TaskPresenter;
use Illuminate\Database\Eloquent\Model;
use Robbo\Presenter\PresentableInterface;

class Task extends Model implements PresentableInterface
{

    protected $fillable = ['project_id', 'status', 'title', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->hasOne(Status::class);
    }
    
    public function getPresenter()
    {
        return new TaskPresenter($this);
    }
}
