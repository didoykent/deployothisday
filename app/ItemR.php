<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemR extends Model
{
    protected $table = "itemrep";


    public $fillable = ['adminName', 'action', 'itemName', 'previousQuantity', 'currentQuantity', 'currentPrice', 'previousPrice', 'currentName', 'previousName', 'currentSale', 'previousSale', 'currentImagePath', 'previousImagePath'];

}
