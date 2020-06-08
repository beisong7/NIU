<?php

namespace App;

use App\Models\Admin;
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
        'assigned_to',
        'countdown_otp',
        'otp',
        'token',
        'status',
        'theme_type',
        'email_verified_at',
    ];


    public function getFullNameAttribute(){
        return "$this->first_name $this->last_name";
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

    public function getassignedAttribute(){
        $admin = Admin::where('uuid', $this->assigned_to)->first();
        return !empty($admin)?$admin->first_name:"not assigned";
    }

    public function getcreatChannelAttribute(){
        return !empty($this->created_by)?$this->created_by:'admin';
    }
}
