<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Carbon\Carbon;
use App\Account;
use Validator;
use Hash;

class UserController extends Controller

{
public function handleApi(){

$apidata = null;
if(Auth::check()){

  $user = Auth::user();
    $apidata = $user->thisUserRole;
  }

  return response()->json($apidata);
}









  public function adminLists(){





    return view('riv-admin/AdminLists');
  }



  public function getUsersData(){


  $user = User::all();

  return response()->json($user);

  }

  public function getRemoveUser(Request $request, $id){


    $user = User::find($id)->delete();
  }

public function getBanUser(Request $request, $id){

$user = User::find($id);

$user->status = "banned";

$user->save();

}


public function getUnBanUser(Request $request, $id){

  $user = User::find($id);

  $user->status = "active";

  $user->save();
}


  public function getuserchangepass(Request $request, $id){

    $this->validate($request,[


      'newpassword' => 'required|min:4|Between:4,12|AlphaNum',
      'confirmpassword' => 'required|same:newpassword'


    ]);

$user = User::find($id);

$user->password = bcrypt($request->input('newpassword'));

$user->save();
  return response()->json($id);

  }

public function getmanageusersdata(){

  $usersdata  = User::where('thisUserRole', '=', 'user')->get();


  return response()->json($usersdata);
}


  public function getmanageusers(){

    return view('riv-admin/ManageUsers');
  }

    public function getSignUp(){

return view('user/signup');

    }


    public function postSignUp(Request $request){

$this->validate($request,[

'username' => 'required|min:4|max:12|alpha|unique:users',
'password' => 'required|min:4|Between:4,12|AlphaNum',
'verifypassword' => 'required|same:password'

]);

$user = new User([

'username' => $request->input('username'),
'password' => bcrypt($request->input('password')),
'position' => ($request->input('position'))


]);

$user->save();

Auth::login($user);

Auth::user()->login_time = Carbon::now();
      Auth::user()->save();

      $account = new Account;
      $account->position = $request->input('position');
      $account->accountName = $request->input('username');
      $account->adminName = Session::get('user');

      $account->save();

      $user = $request->input('username');

      $request->session()->put('user', $user);

      if (Session::has('oldUrl')) {
                $oldUrl = Session::get('oldUrl');
                Session::forget('oldUrl');
                return redirect()->to($oldUrl);
            }

      return redirect()->route('user.index');



    }


    public function getSignIn(){

      return view('user.signin');
    }

    public function postSignIn(Request $request){
      $this->validate($request,[

      'username' => 'required|min:4|max:12|alpha',
      'password' => 'required|min:4|Between:4,12|AlphaNum'

      ]);

      if(Auth::attempt([

        'username' => $request->input('username'),
        'password' => $request->input('password')

      ])){


        Auth::user()->login_time = Carbon::now();
              Auth::user()->save();




$user = $request->input('username');

$request->session()->put('user', $user);

if (Session::has('oldUrl')) {
          $oldUrl = Session::get('oldUrl');
          Session::forget('oldUrl');
          return redirect()->to($oldUrl);
      }

        return redirect()->route('user.index');






      }

  return redirect()->back();



    }

    public function adminPanel(){



  return view('riv-admin/profile');

    }

    public function getLogOut(){
      Auth::user()->logout_time = Carbon::now();
            Auth::user()->save();

      Auth::logout();





      return redirect()->route('user.index');
    }


    public function changePassword(){
return view('riv-admin/UserManagement');

    }


    public function getnewPassword(Request $request){
  $user = Auth::user();




$this->validate($request,[

'oldpassword' => 'required',
'newpassword' => 'required|different:oldpassword|min:4|Between:4,12|AlphaNum',
'verifypassword' => 'required|same:newpassword'


]);

$currentpass = $request->input('oldpassword');

if(Hash::check($currentpass, $user->password)){


$user->password = bcrypt($request->input('newpassword'));

$user->save();

  return redirect()->back()->with('success', 'Password successfully changed!');

}
else{

    return redirect()->back()->with('error', 'Current password is incorrect!');
}

}

}
