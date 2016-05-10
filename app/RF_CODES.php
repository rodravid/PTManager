<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RF_CODES extends Model
{

    protected $fillable = ['ref_id', 'name', 'type'];

    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
