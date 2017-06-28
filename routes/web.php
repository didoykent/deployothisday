<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[

  'uses' => 'ViewController@index',
  'as' => 'user.index'
]);






Route::group(['prefix' => 'riv-admin'],function(){


  Route::get('/handleApi',[


    'uses' => 'UserController@handleApi',
    'as' => 'api.handle'
  ]);

  Route::get('/About',[

      'uses' => 'ViewController@About',
      'as' => 'index.about'
    ]);


    Route::get('/Services',[

      'uses' => 'ViewController@Services',
      'as' => 'index.services'
    ]);


  Route::get('/signup',[

  'uses' => 'UserController@getSignUp',
  'as' => 'user.signup'

  ]);


  Route::post('/signup', [

    'uses' => 'UserController@postSignUp',
    'as' => 'user.signup'
  ]);

  Route::get('/signin',[

  'uses' => 'UserController@getSignIn',
  'as' => 'user.signin'

  ]);


  Route::post('/signin', [

    'uses' => 'UserController@postSignIn',
    'as' => 'user.signin',

  ]);


  Route::get('/addcart/{id}',[

    'uses' => 'SalesController@SalesCart',
    'as' => 'cart.add'
  ]);

  Route::resource('/getitems', 'ItemController');

  Route::get('/ShoppingCart',[

  'uses' => 'SalesController@getShoppingCart',
  'as' => 'admin.ShoppingCart'


  ]);


  Route::get('/getcart',[

    'uses' => 'SalesController@cartItems',
    'as' => 'cart.items'
  ]);


  Route::get('/fetchCart',[

    'uses' => 'SalesController@fetchCart',
    'as' => 'cart.fetch'
  ]);


  Route::get('/ICart/{id}/{quantity}',[

    'uses' => 'SalesController@getICart',
    'as' => 'sales.ICart'
  ]);



  Route::get('/CartItems',[

    'uses' => 'SalesController@SalesCartItems',
    'as' => 'cart.cartitems'
  ]);


  Route::get('/reduceItem/{id}',[

    'uses' => 'SalesController@getReduceByOne',
    'as' => 'cart.reduce'
  ]);


  Route::get('/removeItem/{id}',[

    'uses' => 'SalesController@removeItem',
    'as' => 'cart.remove'
  ]);



  Route::get('/increaseItem/{id}',[

    'uses' => 'SalesController@getIncreaseItem',
    'as' => 'cart.increase'
  ]);





  });





Route::group(['middleware' => 'admin'],function(){
Route::group(['prefix' => 'riv-admin'],function(){





  Route::get('/testdata',[

  'uses' => 'UserController@changePassword',
  'as' => 'admin.manage'


  ]);


  Route::post('/testdata',[

  'uses' => 'UserController@getnewPassword',
  'as' => 'admin.manage'


  ]);

  Route::get('/manageusers',[

  'uses' => 'UserController@getmanageusers',

  'as' => 'admin.manageusers'


  ]);

  Route::get('/manageusersdata',[

  'uses' => 'UserController@getmanageusersdata',
  'as' => 'admin.manageusersdata'


  ]);



  Route::post('/userchangepass/{id}',[

  'uses' => 'UserController@getuserchangepass',
  'as' => 'admin.userchangepass'


  ]);


  Route::get('/BanUser/{id}',[

  'uses' => 'UserController@getBanUser',
  'as' => 'admin.BanUser'


  ]);


  Route::get('/UnBanUser/{id}',[

  'uses' => 'UserController@getUnBanUser',
  'as' => 'admin.UnBanUser'


  ]);

  Route::get('/RemoveUser/{id}',[

  'uses' => 'UserController@getRemoveUser',
  'as' => 'admin.RemoveUser'


  ]);





  Route::get('/chat',[

  'uses' => 'AdminController@getChat',
  'as' => 'admin.Chat'


  ]);

  Route::get('/clientcart/{id}/{client}',[

    'uses' => 'SalesController@ClientCart',
    'as' => 'cart.clientcart'
  ]);











    Route::get('/getCash/{cash}',[

      'uses' => 'SalesController@getCash',
      'as' => 'cart.cash'
    ]);







  Route::get('/saleItems/{sale}',[

    'uses' => 'SalesController@getSales',
    'as' => 'item.sale'
  ]);


  Route::get('/unSaleItems',[

    'uses' => 'SalesController@removeSale',
    'as' => 'item.removesale'
  ]);



  Route::post('/ISaleItems/{id}/{getdiscount}',[

    'uses' => 'SalesController@ISaleItems',
    'as' => 'item.ISaleItems'
  ]);



  Route::get('/IRSaleItems/{id}',[

    'uses' => 'SalesController@IRSaleItems',
    'as' => 'item.IRSaleItems'
  ]);

  Route::get('/getReports',[

    'uses' => 'ReportsController@getReports',
    'as' => 'view.getReports'
  ]);


  Route::get('/getusersReport',[

    'uses' => 'ReportsController@getusersReports',
      'as' => 'view.getusersReport'
  ]);



  Route::get('/AdminReports',[

    'uses' => 'ReportsController@getAdminReports',
    'as' => 'admin.getReports'
  ]);


  Route::get('/SaleReports',[

    'uses' => 'SalesController@getSaleReports',
    'as' => 'admin.SaleReports'
  ]);


  Route::get('/CartReports',[

    'uses' => 'SalesController@getCartreports',
    'as' => 'admin.CartReports'
  ]);


  Route::get('/SaleReportsCount',[

    'uses' => 'SalesController@getSaleReportsCount',
    'as' => 'admin.SaleReportsCount'
  ]);

  Route::get('/SaleReportsSum',[

    'uses' => 'SalesController@getSaleReportsSum',
    'as' => 'admin.SaleReportsSum'
  ]);

  Route::get('/SaleReportsRec',[

    'uses' => 'SalesController@getSaleReportsRec',
    'as' => 'admin.SaleReportsRec'
  ]);


  Route::get('/getSummDailyData',[

    'uses' => 'SalesController@getSummDailyData',
    'as' => 'admin.getSummDailyData'
  ]);





  Route::get('/Weeklyrep',[

    'uses' => 'SalesController@getWeeklyrep',
    'as' => 'sales.Weeklyrep'
  ]);


  Route::get('/Testtable',[

    'uses' => 'SalesController@getTesttable',
    'as' => 'sales.Testtable'
  ]);

  Route::get('/',[

  'uses' => 'UserController@adminPanel',
  'as' => 'admin.profile'

  ]);



  Route::get('/profile',[

  'uses' => 'UserController@adminPanel',
  'as' => 'admin.profile'

  ]);

  Route::get('/admin-lists',[

    'uses' => 'UserController@adminLists',
    'as' => 'admin.lists'
  ]);

  Route::get('/client-lists',[

    'uses' => 'AdminController@clientLists',
    'as' => 'client.lists'
  ]);

  Route::get('/client-management',[

    'uses' => 'AdminController@clientManagement',
    'as' => 'client.manage'
  ]);

  Route::get('/item-lists',[

    'uses' => 'AdminController@itemLists',
    'as' => 'item.lists'
  ]);


  Route::get('/item-management',[

    'uses' => 'ItemController@itemManagement',
    'as' => 'item.manage'
  ]);


  Route::get('/new-transaction',[

    'uses' => 'SalesController@newTransaction',
    'as' => 'new.transaction'
  ]);


  Route::get('/client-transaction',[

    'uses' => 'SalesController@clientTransaction',
    'as' => 'client.transaction'
  ]);


  Route::get('/getUserClients',[

    'uses' => 'SalesController@sortBy',
    'as' => 'test.new'
  ]);


    Route::get('/getusers', 'UserController@getUsersData');



    Route::get('/getcount', 'AdminController@getCount');

    Route::resource('/getclients', 'AdminController');



    Route::get('/getupdates', 'ItemController@itemUpdate');

      Route::get('/getremoved', 'ItemController@itemRemoved');

});

});



Route::group(['middleware' => ['auth', 'status']],function(){
Route::group(['prefix' => 'riv-admin'],function(){



  Route::get('/CheckOut',[

  'uses' => 'SalesController@getCheckOut',
  'as' => 'admin.CheckOut'


  ]);

  Route::post('/CheckOut',[

  'uses' => 'SalesController@postCheckOut',
  'as' => 'admin.CheckOut'


  ]);














  Route::get('/logout',[

    'uses' => 'UserController@getLogOut',
    'as' => 'user.logout',
    'middleware' => 'auth'
  ]);











});

});
