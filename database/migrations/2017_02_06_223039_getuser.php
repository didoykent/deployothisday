<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Getuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('users', function (Blueprint $table) {
        $table->increments('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('position')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->DateTime('login_time')->nullable();
            $table->DateTime('logout_time')->nullable();
            $table->string('thisUserRole')->default('user');
            $table->string('status')->default('active');


      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('users');
    }
}
