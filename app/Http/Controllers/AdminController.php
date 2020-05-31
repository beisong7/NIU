<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function dashboard(Request $request){
        $users = User::select([
            'uuid',
            'first_name',
            'last_name',
            'email',
            'photo',
            'last_seen',
        ])->orderBy('id', 'desc')->paginate(50);
        return view('pages.admin.dashboard.index')->with('users', $users);
    }
}
