<?php

namespace App\Services;

use App\User;

class SoftMailer
{

    public function prepareMail($emailType, $user=null, $table=null){

    }

    public function welcome($user){
        $view = view('email.welcome')
            ->with("user", $user)
            ->with("token", encrypt($user->unid));
        $this->sendMails($user->email, $view, 'Welcome to NIU Properties');
    }

    public function sendMails($mail, $htmlContent, $title){

        $to = $mail;
        $sender = "noreply@smileplanetef.com";

        $separator = md5(time());
        $eol = "\r\n";

        $subject = $title;

        $fromMail = "NIU Properties <$sender>";

        $headersMail = '';

        $headersMail .= "Reply-To:" . $fromMail . "\r\n";
        $headersMail .= "Return-Path: ". $fromMail ."\r\n";
        $headersMail .= 'From: ' . $fromMail . "\r\n";
        $headersMail .= "Organization: NIU \r\n";

        $headersMail .= 'MIME-Version: 1.0' . "\r\n";

        $headersMail .= "X-Priority: 3\r\n";
        $headersMail .= "X-Mailer: PHP". phpversion() ."\r\n" ;
        $headersMail .=  "Content-Type: text/html; charset=ISO-8859-1; boundary=\"" . $separator . "\"" . $eol;
//        $headersMail .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";

        $headersMail .= 'Content-Transfer-Encoding: 7bit' . "\r\n";



//        @mail($to,$subject, $htmlContent, $headersMail, $sender);
        @mail($to,$subject,$htmlContent,$headersMail, "-f ". $sender);

    }
}