<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prouser_name');
            $table->string('prouser_email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('prouser_password');
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
        Schema::dropIfExists('pro_users');
    }
}
