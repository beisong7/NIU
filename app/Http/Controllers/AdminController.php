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
            'status',
            'created_at',
            'photo',
            'last_seen',
        ])->orderBy('id', 'desc')->paginate(50);
        $leads = User::where('status', 'lead')->get()->count();
        $opportunity = User::where('status', 'opportunity')->get()->count();
        $outright = User::where('status', 'out right sale')->get()->count();
        $inactive = User::where('active', false)->select(['id'])->get();
        return view('pages.admin.dashboard.index')
            ->with([
                'users' => $users,
                'inactive'=>$inactive,
                'opportunity'=>$opportunity,
                'outright'=>$outright,
                'leads'=>$leads
            ]);
    }

    public function users(){
        $users = User::OrderBy('id', 'desc')->paginate(30);
        return view('pages.admin.users.index')
            ->with([
                'users' => $users,
            ]);
    }

    public function createUserPage(){
        return view('pages.admin.users.create');
    }

    public function logoutUser(Request $request){
        Auth::guard('admin')->logout();
        return back();
    }
}
