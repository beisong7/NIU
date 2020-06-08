<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //the codes below creates two records in two days from 2019 till date
        $start = strtotime('2019-01-01 12:00:00');
        $end = strtotime('today');
        $k = 60*60*24*2;

        while ($end > $start){
            factory(\App\User::class, 2)->create([
                'created_at'=>date('Y-m-d h:i:s', $start)
            ]);
            $start+=$k;
        }

    }
}
