<?php

namespace App\Models;

// 1. You MUST import this specific class
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class login extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;

    // protected $primaryKey = 'id';
    // public $incrementing = true;


    protected $table = 'logins';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Hidden fields for security
    protected $hidden = [
        'password',
        'remember_token',
    ];

    function blogdata()
    {
        return $this->hasOne('App\Models\blog', 'user_id');
    }

    function manylist()
    {
        return $this->hasMany('App\Models\blog', 'user_id');
    }
}
