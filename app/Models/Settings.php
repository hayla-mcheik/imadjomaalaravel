<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table='settings';
    protected $fillable=['fb','insta','call','twitter','linkedin','snapchat','tiktok','youtube','image'];
}
