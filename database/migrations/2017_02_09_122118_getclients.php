<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Getclients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
          $table->increments('id');
          $table->rememberToken();
          $table->timestamps();
          $table->string('clientName')->nullable();
          $table->string('clientType')->nullable();
          $table->integer('clientAge')->nullable();
          $table->string('clientBday')->nullable();
          $table->integer('clientCN')->nullable();
          $table->string('clientSpouse')->nullable();
          $table->string('clientJob')->nullable();
          $table->string('clientAdmin')->nullable();
        


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('clients');
    }
}
