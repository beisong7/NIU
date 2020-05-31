<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $admin = new Admin();
        $admin->who = 4;
        $admin->uuid = (string) Str::uuid();
        $admin->title = "Mr";
        $admin->first_name = "Super";
        $admin->last_name = "Admin";
        $admin->email = 'admin@niucms.com'; //$faker->unique()->safeEmail;
        $admin->phone = "090Admin";
        $admin->address = "Not Updated";
        $admin->active = true;
        $admin->password = bcrypt('password');
        $admin->last_seen = time();
        $admin->dob = null;
        $admin->theme_type = 'light';
        $admin->email_verified_at = now();
        $admin->remember_token = Str::random(10);
        $admin->save();
    }
}
