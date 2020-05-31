<?php

namespace App\Traits\Auth;

trait Password{

    public function checkPassword($pwd) {
        $status = true;
        $errors = "";
        if (strlen($pwd) < 8) {
            $errors = "Password too short!";
            $status = false;
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $errors = "Password must include at least one number!";
            $status = false;
        }

        if (!preg_match("#[a-zA-Z]+#", $pwd)) {
            $errors = "Password should contain letters!";
            $status = false;
        }

        if (!preg_match("#[A-Z]#",$pwd)) {
            $errors = "Your new password must contain at least one uppercase letter.";
            $status = false;
        }
        if (!preg_match("#[a-z]#",$pwd)) {
            $errors = "Your new password must contain at least one lowercase letter.";
            $status = false;
        }
        
        /**
        if (!preg_match('/'.preg_quote('^\'£$%^&*()}{@#~?><,@|-=-_+-¬', '/').'/', $pwd)) {
            $errors = "Password should have a special character!";
            $status = false;
        }
         */

        return [$status, $errors];
    }
}


