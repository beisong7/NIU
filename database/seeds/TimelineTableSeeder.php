<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Timeline;
use App\Models\Cashflow;

class TimelineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\User::get();
        foreach ($users as $user){
            if($user->status==="lead"){
                factory(Timeline::class)->create([
                    'user_id' => $user->uuid,
                    'admin_id' =>  $user->assigned_to,
                    'details' =>  $this->setDetails('assigned', $user),
                    'created_at'=>date('Y-m-d h:i:s', strtotime($user->created_at)),
                ]);
            }else{
                factory(Timeline::class)->create([
                    'user_id' => $user->uuid,
                    'admin_id' =>  $user->assigned_to,
                    'details' =>  $this->setDetails('assigned', $user),
                    'created_at'=>date('Y-m-d h:i:s', strtotime($user->created_at)),
                ]);
                factory(Timeline::class)->create([
                    'user_id' => $user->uuid,
                    'admin_id' =>  $user->assigned_to,
                    'details' =>  $this->setDetails($user->status, $user),
                    'created_at'=>date('Y-m-d h:i:s', strtotime($user->created_at)),
                ]);
            }
        }
    }

    public function setDetails($type, $user){
        $admin = Admin::where('uuid',$user->assigned_to)->first();
        if($type==='assigned'){
            return 'New User Created and assigned to '.$admin->first_name . " by System";
        }else{
            $cashflow = Cashflow::where('user_id', $user->uuid)->first();
            $message = "User upgraded to $type with cash expectation of N". number_format($cashflow->amount, 2) . " on " . date('F d, Y', strtotime($cashflow->created_at)) . " by ".$admin->first_name;
            return $message;
        }

    }
}
