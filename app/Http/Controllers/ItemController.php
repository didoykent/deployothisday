<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\ItemR;
use Session;
use Carbon\Carbon;
use App\IRemove;
class ItemController extends Controller
{


public function itemUpdate(){

  $items = ItemR::all();

  return response()->json($items);
}

public function itemRemoved(){

  $removeditems = IRemove::all();

  return response()->json($removeditems);
}

public function itemManagement(){

  return view('riv-admin/InventoryManagement');
}



    public function index()
    {
        $items  = Item::all();



        return response()->json($items);
    }


    public function store(Request $request)
    {
        $this->validate($request,[

'itemName' => 'required',
'itemSrp' => 'required',
'itemQuantity' => 'required',
'itemImagePath',
'itemClientPrice',
'itemDealerPrice',
'itemAgentPrice',
'itemClientName',
'action'


        ]);




          $items = new Item;
        $items->itemClientName = Session::get('user');
        $items->action = "CREATED";
        $items->itemName = $request->itemName;
        $items->itemSrp  = $request->itemSrp;
        $items->itemClientPrice = $request->itemSrp;
        $items->itemQuantity = $request->itemQuantity;
        $items->itemImagePath = $request->itemImagePath;
        $dealer = 40 / 100;

        $newdeal = $items->itemSrp * $dealer;

        $items->itemDealerPrice = $items->itemSrp - $newdeal;

        $agent = 30 / 100;

        $newagent = $items->itemSrp * $agent;

        $items->itemAgentPrice = $items->itemSrp - $newagent;



        $items->save();




        return response()->json($items);




    }




    public function update(Request $request, $id)
    {
  $this->validate($request,[

'itemName' => 'required',
'itemSrp' => 'required',
'itemQuantity' => 'required',
'itemImagePath',


      ]);


      $items = Item::find($id);
    $itemR = new ItemR;

    $itemR->adminName = Session::get('user');
    $itemR->action = "UPDATED";
    $itemR->itemName = $items->itemName;
    $itemR->previousQuantity = $items->itemQuantity;
    $itemR->previousPrice = $items->itemSrp;
    $itemR->previousName = $items->itemName;
    $itemR->previousSale = $items->itemDiscount;
    $itemR->previousImagePath = $items->itemImagePath;



      $items->itemName = $request->itemName;

      $items->itemSrp = $request->itemSrp;

      $items->itemQuantity = $request->itemQuantity;
      $items->itemImagePath = $request->itemImagePath;

$zodiac = Session::get('newitems', $items);


      $items->save();


$itemR->currentQuantity = $zodiac->itemQuantity;
$itemR->currentPrice  = $zodiac->itemSrp;
$itemR->currentName = $zodiac->itemName;
$itemR->currentImagePath = $zodiac->itemImagePath;
$itemR->currentSale = $zodiac->itemDiscount;

  $itemR->save();

    }


public function destroy($id)
    {
      $items = Item::find($id);
      $removeItems = new IRemove;
      $date = Carbon::now();
      $removeItems->adminName = Session::get('user');
      $removeItems->itemName = $items->itemName;
      $removeItems->itemSrp = $items->itemSrp;
      $removeItems->itemQuantity = $items->itemQuantity;
      $removeItems->itemDiscount = $items->itemDiscount;
      $removeItems->itemTotalDiscount = $items->itemTotalDiscount;
      $removeItems->itemImagePath = $items->itemImagePath;
      $removeItems->action = "REMOVED";
      $removeItems->created_at = $date;
      $removeItems->save();


Item::find($id)->delete();

return response($date);
    }



}
