<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'admin_id',
        'type',
        'amount',
    ];
}
