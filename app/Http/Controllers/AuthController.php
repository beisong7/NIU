<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function validateSystemAdmin(Request $request){

        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }
        else {
            return back()->withErrors(array('email' => 'Invalid credentials given'))->withInput($request->input());
        }


    }

    public function mobileLogin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $credentials = ['email' => $email, 'password' => $password];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user->message = 'success';
            return response()->json($user, 200);
        }
        else {
            $user = new User();
            $user->message = 'authentication failed';
            return response()->json($user, 403);
        }
    }


}
