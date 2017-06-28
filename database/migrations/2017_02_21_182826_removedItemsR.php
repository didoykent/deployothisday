<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovedItemsR extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('removedItems', function(Blueprint $table){

        $table->increments('id');
        $table->string('adminName');
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
        $table->integer('itemDealerPrice')->nullable();
        $table->integer('itemAgentPrice')->nullable();
        $table->string('itemClientName')->nullable();
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
      Schema::drop('removedItems');
    }
}
