<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'admin_id',
        'details',
    ];
}
