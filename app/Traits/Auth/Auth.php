<?php

namespace App\Traits\Auth;
use App\Session\Authenticated;



trait Auth {
    private $auth;

    function __construct(Authenticated $auth)
    {
        $this->auth = $auth;
    }


    public function guard($username){
        return session($username);
    }

    public function logout(){
        $this->auth->logout();
    }



}