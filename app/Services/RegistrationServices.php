<?php

namespace App\Services;

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
                return response()->json(['message'=>'user already exist'], 403);
            }else{
                return back()->withErrors(['email'=>'Account already exist with given email'])->withInput($request->input());
            }

        }
        $password = "";
        $user = new User();
        if($type==='mobile'){
            $password = bcrypt($request->input('pass'));
            $user->assigned_to = 1;
            $user->status = "lead";
        }else{
            $staff = $request->user('staff');
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
            return response()->json($user, 200);
        }else{
            return redirect()->route('users')->withMessage('New Prospect Created');
        }
        //return user

    }
}