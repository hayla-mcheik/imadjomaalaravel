<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
        protected $table='milestones';
    protected $fillable=['title','description','image','date'];
}
