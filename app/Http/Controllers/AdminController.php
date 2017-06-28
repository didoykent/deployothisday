<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;

use App\Item;
use Session;


class AdminController extends Controller
{





public function getChat(){

  $user = "Zodiac";

return view('riv-admin/Chat', ['user' => $user]);

}







public function clientLists(){

  return view('riv-admin/Clientlists');
}


public function clientManagement(){

  return view('riv-admin/clientManagement');

}













public function getCount(){

  $users = User::count();
  $clients = Client::count();
  $items = Item::count();


  return response()->json(['users' => $users, 'clients' => $clients, 'items' => $items]);
}


public function itemLists(){

return view('riv-admin/Inventorylists');

}


    public function index()
    {

      $zodiac = Session::get('user');


      $client = Client::where('clientAdmin', '=', $zodiac )->get();
      return response()->json($client);

    }


    public function store(Request $request)
    {


      $this->validate($request,[

        'clientName' => 'required',
        'clientType' => 'required',
        'clientAge' => 'required',
        'clientBday' => 'required',
        'clientCN' => 'required',
        'clientSpouse' => 'required',
        'clientJob' => 'required'



      ]);

      $client = new Client;

      $client->clientName = $request->clientName;
      $client->clientType = $request->clientType;
      $client->clientAge = $request->clientAge;
      $client->clientBday = $request->clientBday;
      $client->clientCN = $request->clientCN;
      $client->clientSpouse = $request->clientSpouse;
      $client->clientJob = $request->clientJob;
      $client->clientAdmin = Session::get('user');

    $client->save();



      return response()->json($client);
    }





    public function update(Request $request, $id)
    {
      $this->validate($request,[

        'clientName' => 'required',
        'clientType' => 'required',
        'clientAge' => 'required',
        'clientBday' => 'required',
        'clientCN' => 'required',
        'clientSpouse' => 'required',
        'clientJob' => 'required'


      ]);

      $client = Client::find($id)->update($request->all());

      return response()->json($client);
    }


    public function destroy($id)
    {
        Client::find($id)->delete();
    }
}
