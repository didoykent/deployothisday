
@extends('layouts.mainpage')
@section('content')
<div class="container">


<div class="row">
       <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
           <h1>Payment</h1>
           <h4>Your Total: ₱{{$CartTotalPrice}}</h4>
           <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
               {{ Session::get('error') }}
           </div>
           <form action="{{route('admin.CheckOut')}}" method="post" id="checkout-form">
               <div class="row">
                 <div class="col-xs-12">
                     <div class="row">
                   <div class="col-xs-6">
                       <div class="form-group">
                           <label for="name">First Name</label>
                           <input type="text" id="name" class="form-control" required name="name">
                       </div>
                   </div>

                   <div class="col-xs-6">
                       <div class="form-group">
                           <label for="lastname">Last Name</label>
                           <input type="text" id="lastname" class="form-control" required name="lastname">
                       </div>
                   </div>
                   <div class="col-xs-12">
                       <div class="row">
                   <div class="col-xs-6">
                       <div class="form-group">
                           <label for="address">Billing Address 1</label>
                           <input type="text" id="address" class="form-control" required name="address">
                       </div>
                   </div>

                   <div class="col-xs-6">
                       <div class="form-group">
                           <label for="address2">Billing Address 2</label>
                           <input type="text" id="address2" class="form-control" required name="address2">
                       </div>
                   </div>
                   <hr>
                   <div class="col-xs-12">
                       <div class="form-group">
                           <label for="card-name">Card Holder Name</label>
                           <input type="text" id="card-name" class="form-control" required>
                       </div>
                   </div>
                   <div class="col-xs-12">
                       <div class="form-group">
                           <label for="card-number">Credit Card Number</label>
                           <input type="text" id="card-number" class="form-control" required>
                       </div>
                   </div>
                   <div class="col-xs-12">
                       <div class="row">
                           <div class="col-xs-6">
                               <div class="form-group">
                                   <label for="card-expiry-month">Expiration Month</label>

                                            <input type="text" id="card-expiry-month" class="form-control" required>

                           </div>
                         </div>
                           <div class="col-xs-6">
                               <div class="form-group">
                                   <label for="card-expiry-year">Expiration Year</label>
                                  <input type="text" id="card-expiry-year" class="form-control" required>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-xs-12">
                       <div class="form-group">
                           <label for="card-cvc">CVC</label>
                           <input type="text" id="card-cvc" class="form-control" required>
                       </div>
                   </div>
               </div>
               {{ csrf_field() }}
               <button type="submit" class="btn btn-success">Buy now</button>
           </form>
       </div>
   </div>
   </div>

  @section('scripts')

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{URL::to('js/stripe.js')}}"></script>

<link rel="stylesheet" href="/css/pay.css">
  @endsection
@endsection
