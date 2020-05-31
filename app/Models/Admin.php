<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'uuid',
        'title',
        'first_name',
        'last_name',
        'email',
        'phone',
        'photo',
        'address',
        'created_by',
        'who',
        'active',
        'password',
        'last_seen',
        'dob',
        'countdown_pass',
        'countdown_otp',
        'otp',
        'token',
        'theme_type',
        'email_verified_at',
    ];


}
