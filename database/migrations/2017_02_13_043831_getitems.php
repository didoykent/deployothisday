<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Getitems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

      Schema::create('items', function(Blueprint $table){

        $table->increments('id');
        $table->string('itemName');
        $table->double('itemSrp');
        $table->integer('itemQuantity');
        $table->double('totalPrice')->nullable();
        $table->integer('totalQuantity')->nullable();
        $table->integer('totalItems')->nullable();
        $table->integer('itemDiscount')->nullable();
        $table->double('itemTotalDiscount')->nullable();
        $table->double('itemOriginalPrice')->nullable();
        $table->double('itemClientPrice')->nullable();
        $table->string('itemImagePath')->nullable();
        $table->string('itemCategory')->nullable();
        $table->double('itemDealerPrice')->nullable();
        $table->double('itemAgentPrice')->nullable();
        $table->string('itemClientName')->nullable();
        $table->integer('itemTempQ')->default(1);
        $table->string('action')->nullable();
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
        Schema::drop('items');
    }
}
