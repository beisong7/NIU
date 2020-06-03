<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('created_by')->nullable(); //web-self, mobile-self, admin-name, api
            $table->boolean('active')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable(); // lead, opportunity, out right sale, uncategorized
            $table->bigInteger('assigned_to')->nullable(); //id of staff
            $table->bigInteger('last_seen')->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('countdown_pass')->nullable(); //countdown to expire token
            $table->bigInteger('countdown_otp')->nullable(); //countdown to expire otp
            $table->string('otp')->nullable(); //
            $table->string('token')->nullable(); //unique token to be used for dynamics
            $table->string('theme_type')->nullable();//dark theme or light theme
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
