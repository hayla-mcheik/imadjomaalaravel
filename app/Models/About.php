<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table='abouts';
    protected $fillable=['title','smalldesc','description','image','mission','vision'];
}
