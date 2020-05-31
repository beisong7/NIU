<?php

namespace App\Session;

use App\User;

class Authenticated
{
    public function login(User $user){
        //store user model object to the session - login bypass
        session([$user->username=>$user]);
        session(["current_user_name"=>$user->username]);
    }

    public function get($username){
        //get user model object from the session
        return null;
    }

    public function logout(){
        //clears this session
        $username = session('current_user_name');
        session()->forget($username);
    }
}