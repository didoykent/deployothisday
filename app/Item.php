<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "items";

    protected $fillable = ['itemName', 'itemSrp', 'itemQuantity', 'totalPrice', 'totalQuantity', 'totalItems', 'itemDiscount', 'itemTotalDiscount', 'itemImagePath', 'itemCategory', 'action', 'itemClientName'];

}
