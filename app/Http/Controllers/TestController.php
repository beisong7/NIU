<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $users = User::select([
            'title',
            'first_name',
            'last_name',
            'email',
            'phone',
        ])->take(20)->get();
        return response()->json($users);
    }
}
