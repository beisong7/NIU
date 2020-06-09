<?php

namespace App\Services;

use App\Models\Admin;
use App\Traits\Utility;
use App\User;
use Illuminate\Http\Request;

class RegistrationServices {
    use Utility;

    public function store(Request $request, $type){


        $email = $request->input('email');

        $exist = User::where('email', $email)->first();
        if(!empty($exist)){
            if($type==='mobile'){
                $user = new User();
                $user->message = 'user already exist';
                return response()->json($user, 403);
            }else{
                return back()->withErrors(['email'=>'Account already exist with given email'])->withInput($request->input());
            }

        }
        $password = "";
        $admins = Admin::inRandomOrder()->first();
        $user = new User();
        if($type==='mobile'){
            $password = bcrypt($request->input('pass'));
            $user->assigned_to = $admins->uuid;
            $user->status = "lead";
        }else{
            $staff = $request->user('admin');
            $user->assigned_to = !empty($staff)?$staff->id:1;
            $password = bcrypt($request->input('phone'));
            $user->status = $request->input('status');
        }


        $user->uuid = $this->generateId();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $email;

        $user->created_by = $type;
        $user->password = $password;
        $user->last_seen = time();
        $user->save();

        if($type==='mobile'){
            //send email
            $this->sendMail("welcome", $user, $type);
            $user->message = "success";
            return response()->json($user, 200);
        }else{
            return redirect()->route('users')->withMessage('New Prospect Created');
        }
        //return user

    }
}