<?php
/**
 * Created by PhpStorm.
 * User: webeleven
 * Date: 09/05/16
 * Time: 10:15
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status';
    protected $fillable = ['status'];

    public function task()
    {
        return $this->hasMany();
    }
}