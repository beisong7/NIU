<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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


    public function getFullNameAttribute(){
        return "$this->first_name $this->last_name";
    }

    public function getStatusAttribute(){
        return "Lead - Opportunity";
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
