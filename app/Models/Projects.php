<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
        protected $table='projects';
    protected $fillable=['title','description','image','color','links'];
}
