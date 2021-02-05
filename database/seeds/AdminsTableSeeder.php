<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $emails = ['admin1@niu.com', 'admin2@niu.com', 'admin3@niu.com', 'admin4@niu.com'];
        $names = [['Benjamin', 'Joseph'], ['Abraham', 'Miles'], ['Clement', 'Elvis'], ['Ijeoma', 'Joy']];

        foreach ($emails as $key=>$email){
            factory(\App\Models\Admin::class)->create([
                'first_name' => $names[$key][0],
                'last_name' => $names[$key][1],
                'email' => $email,
            ]);
        }
    }
}
