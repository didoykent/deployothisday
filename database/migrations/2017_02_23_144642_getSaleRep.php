<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GetSaleRep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SaleRep', function(Blueprint $table){

          $table->increments('id');
          $table->rememberToken();
          $table->timestamps();
          $table->string('adminName')->nullable();
          $table->string('action')->nullable();
          $table->string('itemName')->nullable();
          $table->integer('previousQuantity')->nullable();
          $table->integer('currentQuantity')->nullable();
          $table->double('currentPrice')->nullable();
          $table->double('previousPrice')->nullable();
          $table->string('currentName')->nullable();
          $table->string('previousName')->nullable();
          $table->integer('currentSale')->nullable();
          $table->integer('previousSale')->nullable();
          $table->double('previousTotalDiscount')->nullable();
          $table->double('currentTotalDiscount')->nullable();
          $table->string('currentImagePath')->nullable();
          $table->string('previousImagePath')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('SaleRep');
    }
}
