<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IRemove extends Model
{
  protected $table = "removeditems";

  protected $fillable = ['itemName', 'itemSrp', 'itemQuantity', 'totalPrice', 'totalQuantity', 'totalItems', 'itemDiscount', 'itemTotalDiscount', 'itemImagePath', 'itemCategory', 'action', 'itemClientName', 'adminName'];

}
