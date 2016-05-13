<?php

namespace App;

use App\Presenters\TaskPresenter;
use Illuminate\Database\Eloquent\Model;
use Robbo\Presenter\PresentableInterface;

class Task extends Model implements PresentableInterface
{

    protected $fillable = ['project_id', 'user_id', 'status', 'priority','title', 'description'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function status()
    {
        return $this->hasOne(RF_CODES::class);
    }

    public function priority()
    {
        return $this->hasOne(RF_CODES::Class);
    }
    
    public function getPresenter()
    {
        return new TaskPresenter($this);
    }
}
