<?php

 namespace App;

 class Cart{



public $items = null;
public $totalQuantity = 0;
public $totalPrice = 0;
public $totalCash = 0;
public $finaltotal = null;
public $salestax = null;
public $totalChange = null;
public $geterror  = false;
public $casherror = false;
public $taxrate = 12;
public $receiptNumber = "34522677W";
public $gettemp = 0;
public $gettempPrice = 0;
public $shippingFee = 99;
public $onlineCartTotal = 0;





public function __construct($previousitem){
if($previousitem){
$this->items = $previousitem->items;
$this->totalQuantity = $previousitem->totalQuantity;
$this->totalPrice = $previousitem->totalPrice;
$this->totalCash = $previousitem->totalCash;
$this->totalChange = $previousitem->totalChange;
$this->onlineCartTotal = $previousitem->onlineCartTotal;
}
}


public function addCart($item, $id){


$storedItem = ['qty' => 0, 'price' => $item->itemSrp, 'item' => $item, 'discount' => 0];

if($this->items){

if(array_key_exists($id, $this->items)){

$storedItem = $this->items[$id];

}

}



if($storedItem['qty']<= 0){

$storedItem['qty']++;

$this->totalQuantity++;



}

else{


$this->gettemp += $storedItem['qty'];
if($item->itemTempQ<99999){
$storedItem['qty'] = $item->itemTempQ;
}
$this->totalQuantity+= $storedItem['qty'] - $this->gettemp;
}

$storedItem['price'] = $item->itemSrp * $storedItem['qty'];



$this->items[$id] = $storedItem;


$this->gettempPrice += $this->gettemp * $item->itemSrp;

$this->totalPrice  += $storedItem['price'] - $this->gettempPrice;


$this->onlineCartTotal = $this->totalPrice + $this->shippingFee;
}








public function clientCart($item, $id, $client){

$storedItem = ['qty' => 0, 'price' => $item->itemSrp, 'item' => $item, 'discount' => 0];

if($this->items){

if(array_key_exists($id, $this->items)){

$storedItem = $this->items[$id];

}

}


$zodiac = $client->clientType /100;
if($item->itemOriginalPrice != null){
  $item->itemSrp = $item->itemOriginalPrice;
}

$getnew = $item->itemSrp  * $zodiac;

$getdis = $item->itemSrp - $getnew;

$item->itemSrp = $getdis;

if($storedItem['qty']<= 0){

$storedItem['qty']++;
$this->totalQuantity++;
}

else{


$this->gettemp += $storedItem['qty'];
if($item->itemTempQ<99999){
$storedItem['qty'] = $item->itemTempQ;
}
$this->totalQuantity+= $storedItem['qty'] - $this->gettemp;
}

$storedItem['price'] = $item->itemSrp * $storedItem['qty'];



$this->items[$id] = $storedItem;


$this->gettempPrice += $this->gettemp * $item->itemSrp;

$this->totalPrice  += $storedItem['price'] - $this->gettempPrice;



}



public function reduceByOne($id){

  $this->items[$id]['qty']--;
  $this->items[$id]['price'] -= $this->items[$id]['item']['itemSrp'];
  $this->totalQuantity--;
  $this->totalPrice -= $this->items[$id]['item']['itemSrp'];



  if($this->items[$id]['qty'] <=0){

unset($this->items[$id]);

  }

}





public function increaseByOne($id){

  $this->items[$id]['qty']++;
  $this->items[$id]['price'] += $this->items[$id]['item']['itemSrp'];
  $this->totalQuantity++;
  $this->totalPrice += $this->items[$id]['item']['itemSrp'];





}




public function removeItem($id) {
       $this->totalQuantity -= $this->items[$id]['qty'];
       $this->totalPrice -= $this->items[$id]['price'];

       $this->onlineCartTotal -= $this->items[$id]['price'];
       unset($this->items[$id]);
   }


   public function payCash($cash){

$this->totalCash = $cash;

if($this->totalCash >= $this->totalPrice){

$tax = 12 / 100;

$this->salestax = $this->totalPrice * $tax;

$this->finaltotal = $this->totalPrice - $this->salestax;



  $this->totalChange = $this->totalCash  - $this->totalPrice;


}

else{

  $this->totalChange = "Insufficient funds";
$this->geterror = true;
$this->casherror = true;

}


   }





}
