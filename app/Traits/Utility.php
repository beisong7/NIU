<?php

namespace App\Traits;

use App\Services\SoftMailer;
use Illuminate\Support\Str;

trait Utility{
    private $softmail;

    public function __construct(SoftMailer $softMailer)
    {
        $this->softmail = $softMailer;
    }

    public function generateId(){
        return (string)Str::uuid();
    }

    public function sendMail($email_type, $payload = null, $create_type = null){
        if($email_type==='welcome'){
            $this->softmail->welcome($payload);
        }
    }
}