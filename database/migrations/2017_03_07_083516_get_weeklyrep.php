<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GetWeeklyrep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('weeklyrep', function(Blueprint $table){

        $table->increments('id');
        $table->rememberToken();
        $table->timestamps();
        $table->double('dailyTotalSales')->nullable();
        $table->integer('dailyTotalSoldItems')->nullable();
        $table->string('itemName')->nullable();
        $table->string('action')->nullable();
        $table->string('best')->nullable();
      $table->double('profit')->nullable();
      $table->double('returns')->nullable();
      $table->double('revenue')->nullable();

      });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('weeklyrep');
    }
}
