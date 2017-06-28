<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GetSalesRepSum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesrepsum', function(Blueprint $table){
$table->string('adminName')->nullable();
$table->string('receiptNumber')->nullable();
$table->string('action')->nullable();
$table->double('dailyTotalQuantity')->nullable();
$table->double('dailyTotalPrice')->nullable();
$table->string('itemName')->nullable();
$table->integer('itemQuantity')->nullable();
$table->double('itemSrp')->nullable();
$table->double('total')->nullable();
$table->integer('taxrate')->nullable();
$table->double('subtotal')->nullable();
$table->double('tax')->nullable();
$table->increments('id');
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
      Schema::drop('salesrepsum');
    }
}
