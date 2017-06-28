<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
  protected $table = "AdminRep";

  public $fillable = ['position', 'accountName', 'adminName'];
}
