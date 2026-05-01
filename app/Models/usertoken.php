<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class usertoken extends Model
{
    use HasApiTokens;
    use Notifiable;
}
