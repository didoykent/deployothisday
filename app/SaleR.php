<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleR extends Model
{

    protected $table = 'salerep';
    public $fillable = ['adminName', 'action', 'itemName', 'previousQuantity', 'currentQuantity', 'currentPrice', 'previousPrice', 'currentName', 'previousName', 'currentSale', 'previousSale', 'currentImagePath', 'previousImagePath', 'previousTotalDiscount', 'currentTotalDiscount'];
}
