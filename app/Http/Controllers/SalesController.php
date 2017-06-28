<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Session;
use App\Item;
use App\Cart;
use App\Sale;
use App\SaleR;
use App\itemR;
use App\Account;
use Carbon\Carbon;
use App\DItem;
use App\Weekly;
use Stripe\Charge;
use Stripe\Stripe;


class SalesController extends Controller
{

public function postCheckOut(Request $request){
$items = Item::all();
  if (!Session::has('cart')) {
              return redirect()->route('shop.shoppingCart');
          }
          $oldCart = Session::get('cart');
          $cart = new Cart($oldCart);
          Stripe::setApiKey('sk_test_VziRmTI8hyK4YdNkruK9mYiV');
          try {
              $charge = Charge::create(array(
                  "amount" => $cart->onlineCartTotal * 100,
                  "currency" => "php",
                  "source" => $request->input('stripeToken'), // obtained with Stripe.js
                  "description" => "RivTest Charge"
              ));

          } catch (\Exception $e) {
              return redirect()->route('admin.CheckOut')->with('error', $e->getMessage());
          }
          Session::forget('cart');
          foreach ($items as $item) {

            $item->itemTempQ = 1;
            $item->save();
          }
          return redirect()->route('user.index')->with('success', 'Successfully purchased products!');
      }



public function getCheckOut(){

if(!Session::has('cart')){

  return redirect()->route('admin.ShoppingCart');
}

$oldcart = Session::get('cart');

$cart = new Cart($oldcart);

return view('riv-admin/CheckOut', ['CartTotalPrice' => $cart->onlineCartTotal]);
}

  public function getShoppingCart(){


    return view('riv-admin/ShoppingCart');
  }

public function getTesttable(){

  return view('riv-admin/testtable');
}

  public function getWeeklyrep(Request $request){


$test = DItem::all();
    $enddate = Carbon::now()->endOfDay();
$startdate = Carbon::now()->startOfDay();
$weekly = DItem::where('created_at', '<', $enddate)->get();

$getitems = $weekly[0];
$zodiac = $getitems::count();

$me  = Carbon::now();
if($me < $enddate){
for($i=0; $i<$zodiac; $i++ ){

$items = $weekly[0+$i];

$getweekly = new Weekly;
$getweekly->dailyTotalSales += $items->total;

$getweekly->save();


  }



    return response()->json($items);
}
}

public function getSaleReportsSum(){


$get = Carbon::now()->startOfDay();


$getcart = Session::get('cartsum');

foreach($getcart->items as $cart){
$id = $cart['item']['id'];
$cartdata = new DItem;

$cartdata->adminName = Session::get('user');
$cartdata->itemName =  $cart['item']['itemName'];
$cartdata->itemQuantity = $cart['qty'];
$cartdata->itemSrp = $cart['price'];
$cartdata->taxrate = $getcart->taxrate;
$cartdata->subtotal = $getcart->finaltotal;
$cartdata->tax = $getcart->salestax;
$cartdata->total = $getcart->totalPrice;
$cartdata->receiptNumber = $getcart->receiptNumber;
$cartdata->action = "SOLD";



$cartdata->save();


}






return response()->json($cartdata);

}

public function getSaleReports(){

  $sale = SaleR::all();




  return response()->json($sale);
}

public function getSaleReportsCount(){

$getitemRCounts =  itemR::count();
$getsaleRCounts = Saler::count();
$getAccountR = Account::count();
$gettotalI = Item::count();

$me = itemR::all();


$zodiac = $getitemRCounts + $getsaleRCounts + $getAccountR + $gettotalI;

  return response()->json($zodiac);
}

  public function newTransaction(){

    $items = Item::all();

    return view('riv-admin/Transaction', ['items' => $items]);
  }


  public function clientTransaction(){

    $items = Item::all();




    return view('riv-admin/ClientTransaction', ['items' => $items]);
  }

  public function sortBy(){
$zodiac = Session::get('user');


$client = Client::where('clientAdmin', '=', $zodiac )->get();
return response()->json($client);



  }

public function SalesCart(Request $request, $id){






  $items = Item::find($id);

  $previousitems = Session::has('cart') ? Session::get('cart') : null;



  $cart = new Cart($previousitems);


  $cart->addCart($items, $items->id);


  $request->session()->put('cart', $cart);

  $zodiac = Session::get('cart');

$tr = "transaction";
$request->session()->put('gethandles', $tr);
return response()->json($zodiac);

}


public function getICart(Request $request, $id, $quantity){

$client = Session::get('client');
$newclients = Client::find($client);

$handles = Session::get('gethandles');

if($newclients!=null){
 if($newclients->clientType == "DEALER"){

  $newclients->clientType = 40;
}


if($newclients->clientType == "AGENT"){

 $newclients->clientType = 30;
}

}

  $getitems = Item::where('id' ,'>' ,0)->pluck('id')->toArray();



    $get = Item::count();


    $previousitems = Session::has('cart') ? Session::get('cart') : null;


    $tempnum = 0;

    $pieces = explode(',', $quantity);

    foreach ($previousitems->items as $mycart) {
      $awe = Item::find($mycart['item']['id']);

      $low = intval($pieces[$tempnum]);
      $awe->itemTempQ = ($low);
      if($awe->itemTempQ ==null){
        $awe->itemTempQ = 1;
      }
      $awe->save();
      $tempnum++;

    }



    $items = Item::find($id);
    $cart = new Cart($previousitems);

if($handles == "client"){
  $cart->clientCart($items, $items->id,$newclients);
}
 if($handles == "transaction"){
$cart->addCart($items, $items->id);
}




    $request->session()->put('cart', $cart);

    $zodiac = Session::get('cart');


  return response()->json($zodiac);

}


public function ClientCart(Request $request, $id, $client){

 $newclients = Client::find($client);





  $items = Item::find($id);

  $previousitems = Session::has('cart') ? Session::get('cart') : null;


 if($newclients->clientType == "DEALER"){

  $newclients->clientType = 40;
}


if($newclients->clientType == "AGENT"){

 $newclients->clientType = 30;
}






  $cart = new Cart($previousitems);


  $cart->clientCart($items, $items->id,$newclients);


  $request->session()->put('cart', $cart);

  $zodiac = Session::get('cart');

 $request->session()->put('client', $client);
 $gethandles = "client";

 $request->session()->put('gethandles', $gethandles);
return response()->json($newclients->clientType);

}


public function SalesCartItems(){

  $items = Session::get('cart');


  return response()->json($items);

}

public function getReduceByOne($id){
$forget = false;
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->reduceByOne($id);
         if (count($cart->items) > 0) {
             Session::put('cart', $cart);
         } else {
           $forget = true;
             Session::forget('cart');


         }

return response()->json($forget);
}


public function getIncreaseItem($id){

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
         $cart = new Cart($oldCart);
         $cart->increaseByOne($id);

             Session::put('cart', $cart);
}

public function removeItem($id){
  $items = Item::all();
  $forget = false;
  $oldCart = Session::has('cart') ? Session::get('cart') : null;
   $cart = new Cart($oldCart);
   $cart->removeItem($id);


       if (count($cart->items) > 0) {
           Session::put('cart', $cart);
       } else {
         $forget = true;
           Session::forget('cart');

foreach ($items as $item) {

  $item->itemTempQ = 1;
  $item->save();
}
       }

return response()->json($forget);
}





public function fetchCart(){

$cartTotal = 0;
  if(Session::has('cart')){
$fetch = Session::get('cart');
$cartTotal = $fetch->totalQuantity;

  }





return response()->json($cartTotal);

}


public function cartItems(){

$oldcart = Session::has('cart') ? Session::get('cart'): null;

$cart = new Cart($oldcart);



  return view('riv-admin/CartItems', ['items' => $cart->items, 'totalPrice' => $cart->totalPrice, 'onlineCartTotal' => $cart->onlineCartTotal, 'shippingFee' => $cart->shippingFee]);
}


public function getCash($cash, Request $request){
$casherror = false;
$quantityerror = false;
$error = false;
  $oldCart = Session::has('cart') ? Session::get('cart') : null;
   $cart = new Cart($oldCart);
   if(is_numeric($cash)){
   $cart->payCash($cash);
$error = $cart->geterror;
$casherror = $cart->casherror;
$request->session()->put('cartdata', $cart);

$zodiac = Session::get('cartdata');
foreach($zodiac->items as $me){

  $lol = $me['item']['id'];
  $quantity = $me['qty'];
  $sales = Item::find($lol);

if($sales->itemQuantity < $quantity &&  $casherror == true){

  $cart->totalChange = $sales->itemName." Out of Stock And Insufficient funds";
  $error = true;
  $quantityerror = true;
}

  else if($sales->itemQuantity < $quantity){

    $cart->totalChange = $sales->itemName." Out of Stock";
    $error = true;
    $quantityerror = true;
  }



      $getdata = Session::get('cartdata');



}
}

  return response()->json(['totalCash' => $cart->totalCash, 'totalChange' => $cart->totalChange, 'error' => $error, 'solditems' => $getdata, 'salestax' => $cart->salestax, 'finaltotal' => $cart->finaltotal, 'casherror' => $casherror, 'quantityerror' => $quantityerror]);

}

public function getCartreports(Request $request){

$items = Item::all();
  $zodiac = Session::get('cartdata');

foreach($zodiac->items as $me){

  $lol = $me['item']['id'];
  $quantity = $me['qty'];
  $sales = Item::find($lol);

$getq = $sales->itemQuantity - $quantity;

$sales->itemQuantity  = $getq;
$sales->save();
$request->session()->put('cartsum', $zodiac);
Session::forget('cart');
foreach ($items as $item) {

  $item->itemTempQ = 1;
  $item->save();
}
$getcart = Session::get('cartsum');

foreach($getcart->items as $cart){
$id = $cart['item']['id'];
$cartdata = new DItem;

$cartdata->adminName = Session::get('user');
$cartdata->itemName =  $cart['item']['itemName'];
$cartdata->itemQuantity = $cart['qty'];
$cartdata->itemSrp = $cart['item']['itemSrp'];
$cartdata->taxrate = $getcart->taxrate;
$cartdata->subtotal = $getcart->finaltotal;
$cartdata->tax = $getcart->salestax;
$cartdata->total = $cart['price'];
$cartdata->receiptNumber = $getcart->receiptNumber;
$cartdata->action = "SOLD";



$cartdata->save();


}
  return response()->json($cartdata);
}
}

public function getSaleReportsRec(){

return view('riv-admin/SalesRep');
}

public function getSummDailyData(){

  $zodiac = DItem::all();

  return response()->json($zodiac);
}


public function getSales($sale){
  $getitems = Item::where('id' ,'>' ,0)->pluck('id')->toArray();

  $data = $getitems[0];


  $newitems = Item::count();
$value = intval($sale);
  $new = array();


  for($i=0; $i<$newitems; $i++ ){

$items = Item::find($getitems[0+$i]);
$saleR = new SaleR;
$items->itemDiscount = $value;



$items->save();

$zodiac = $items->itemDiscount / 100;


$getform = $items->itemSrp * $zodiac;

$getdiscountedprice = $items->itemSrp - $getform;

$items->itemOriginalPrice = $items->itemSrp;
$saleR->previousPrice = $items->itemSrp;
$items->itemSrp = $getdiscountedprice;

$items->itemTotalDiscount = $items->itemOriginalPrice - $items->itemSrp;
$items->save();

$getprice = $items->itemSrp;



$saleR->itemName = $items->itemName;
$saleR->action = "SALE";
$saleR->currentSale =  $items->itemDiscount;
$saleR->currentTotalDiscount = $items->itemTotalDiscount;
$saleR->currentPrice = $items->itemSrp;
$saleR->currentQuantity = $items->currentQuantity;
$saleR->adminName = Session::get('user');

$saleR->save();

}
return response($getprice);


}


public function removeSale(){

  $getitems = Item::where('id' ,'>' ,0)->pluck('id')->toArray();

  $data = $getitems[0];


  $newitems = Item::count();



  for($i=0; $i<$newitems; $i++ ){

$items = Item::find($getitems[0+$i]);

$rSale = new SaleR;

$rSale->adminName = Session::get('user');
$rSale->action = "REMOVED SALE";
$rSale->itemName = $items->itemName;
$rSale->previousPrice = $items->itemSrp;
$rSale->previousSale = $items->itemDiscount;
$rSale->previousTotalDiscount = $items->itemTotalDiscount;



$zodiac = $items->itemSrp  + $items->itemTotalDiscount;

$items->itemSrp = $zodiac;

$items->itemOriginalPrice = null;
$items->itemDiscount = null;
$items->itemTotalDiscount = null;


$rSale->currentQuantity = $items->itemQuantity;
$rSale->currentPrice = $items->itemSrp;
$rSale->currentSale = $items->itemDiscount;
$rSale->currentTotalDiscount = $items->itemTotalDiscount;
$rSale->save();
$items->save();


}
return response()->json($items->itemSrp);
}


public function ISaleItems(Request $request, $id, $getdiscount){


$value = intval($getdiscount);

if($getdiscount > 1){


  $items = Item::find($id);
  $saleR = new SaleR;
  $saleR->adminName = Session::get('user');
  $saleR->previousSale  = $items->itemDiscount;
  $saleR->previousPrice = $items->itemSrp;
  $saleR->previousTotalDiscount = $items->itemTotalDiscount;
  $saleR->action = "SALE";
  $saleR->itemName = $items->itemName;
  $zodiac = $items->itemSrp  + $items->itemTotalDiscount;

  $items->itemSrp = $zodiac;

  $items->itemOriginalPrice = null;
  $items->itemDiscount = null;
  $items->itemTotalDiscount = null;

  $items->save();


  $items->itemDiscount = $value;

  $saleR->currentSale  = $items->itemDiscount;

  $items->save();

  $zodiac = $items->itemDiscount / 100;

  $getform = $items->itemSrp * $zodiac;

  $getdiscountedprice = $items->itemSrp - $getform;

  $items->itemOriginalPrice = $items->itemSrp;
  $items->itemSrp = $getdiscountedprice;

  $items->itemTotalDiscount = $items->itemOriginalPrice - $items->itemSrp;

$saleR->currentPrice = $items->itemSrp;
$saleR->currentTotalDiscount = $items->itemTotalDiscount;
$saleR->currentQuantity = $items->itemQuantity;

  $saleR->save();
  $items->save();

  $getprice = $items->itemSrp;
}

return response()->json($getdiscount);
}



public function IRSaleItems($id){


  $items = Item::find($id);

  $saleR = new SaleR;
  $saleR->adminName = Session::get('user');
  $saleR->itemName = $items->itemName;
  $saleR->previousPrice = $items->itemSrp;
  $saleR->previousSale = $items->itemDiscount;
  $saleR->previousTotalDiscount = $items->itemTotalDiscount;
  $saleR->action = "REMOVED SALE";
  $saleR->currentQuantity = $items->itemQuantity;

  $zodiac = $items->itemSrp  + $items->itemTotalDiscount;

  $items->itemSrp = $zodiac;

  $items->itemOriginalPrice = null;
  $items->itemDiscount = null;
  $items->itemTotalDiscount = null;


  $saleR->currentPrice = $items->itemSrp;
  $saleR->currentSale = $items->itemDiscount;
  $saleR->currentTotalDiscount = $items->itemTotalDiscount;

    $saleR->save();
  $items->save();


}







    public function index()
    {

    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
