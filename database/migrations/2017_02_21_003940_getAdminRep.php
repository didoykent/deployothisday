<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GetAdminRep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('AdminRep', function(Blueprint $table){

        $table->increments('id');
        $table->rememberToken();
        $table->timestamps();
        $table->string('position')->nullable();
        $table->string('accountName')->nullable();
        $table->string('adminName')->nullable();

      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('AdminRep');
    }
}
