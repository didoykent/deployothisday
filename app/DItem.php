<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DItem extends Model
{
  protected $table = 'salesrepsum';

  public $fillable = ['adminName', 'receiptNumber', 'action',  'dailyTotalQuantity',  'dailyTotalPrice', 'itemName', 'itemQuantity', 'itemSrp', 'total',  'taxrate', 'subtotal', 'tax'];




}
