<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\Cashflow;
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

    public function setDetails($type, $user, $admin=null){
        $admin = Admin::where('uuid',$user->assigned_to)->first();
        if($type==='assigned'){
            return 'New User Created and assigned to '.$admin->first_name;
        }else{
            $cashflow = Cashflow::where('user_id', $user->uuid)->first();
            $message = "User upgraded to $type with cash expectation of N". number_format($cashflow->amount, 2) . " on " . date('F d, Y', strtotime($cashflow->created_at)) . " by ".$admin->first_name;
            return $message;
        }

    }
}