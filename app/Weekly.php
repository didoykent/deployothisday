<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekly extends Model
{
    protected $table = 'weeklyrep';

    public $fillable = ['dailyTotalSales', 'dailyTotalSoldItems', 'itemName', 'action', 'best', 'profit', 'returns', 'revenue'];
}
