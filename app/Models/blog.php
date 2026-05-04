<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class blog extends Model
{
    use HasApiTokens;
    use Notifiable;

    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'description',
        'user_id',


    ];

    function manytoone()
    {
        return $this->belongsTo('App\Models\login', 'user_id');
    }
}
