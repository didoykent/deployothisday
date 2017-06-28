<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class ViewController extends Controller
{


    public function index(){

return view('index');
    }

    public function About(){

  return view('About');
}


public function Services(){

  return view('Services');
}
}
