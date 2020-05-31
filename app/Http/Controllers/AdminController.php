<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $inactive = User::where('active', false)->select(['id'])->get();
        return view('pages.admin.dashboard.index')
            ->with([
                'users' => $users,
                'inactive'=>$inactive
            ]);
    }

    public function logoutUser(Request $request){
        Auth::guard('admin')->logout();
        return back();
    }
}
