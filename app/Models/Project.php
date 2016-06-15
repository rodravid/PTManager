<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $table = 'projects';
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function containsParticipant(User $user)
    {
        foreach($this->users as $participant){
            if ($participant->id == $user->id)
                return true;
        }

        return false;
    }
}
