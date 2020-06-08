<?php

use Illuminate\Database\Seeder;

class CashflowTableSeeder extends Seeder
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
            $amount = random_int(120000, 1200000);
            factory(\App\Models\Cashflow::class)->create([
                'user_id' => $user->uuid,
                'admin_id' =>  $user->assigned_to,
                'type' =>  $user->status,
                'amount' =>  $amount,
                'created_at'=>date('Y-m-d h:i:s', strtotime($user->created_at)),
            ]);
        }
    }
}
