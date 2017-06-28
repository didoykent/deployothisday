@extends('layouts.mainpage')


@section('content')



<div class="container">

  @if(Session::has('success'))

  <div class="row">
      <div class="col-md-4 col-md-offset-4">


  <div class="alert alert-success">




  <center>
                 {{ Session::get('success') }}
  </center>
             </div>
          </div>
  </div>

  @endif

          <div class="row">

<div v-for = "item in items">

    <div class="col-xs-6 col-md-3">

    <div class = "apple">

<img src = "@{{item.itemImagePath}}" alt = "">

    </div>

    <div class="caption">
  <div class="row">
             <h2 class="group inner list-group-item-heading">
                @{{item.itemName}}</h2>
                 <div class = "stocks">
                  <small>Stocks: @{{item.itemQuantity}}</small>
                  </div>
                 <hr>

              <div class="clearfix">
             <div class="row">

                 <div class="col-xs-12 col-md-6">
                <div class="price pull-left">

                     <p>₱@{{item.itemSrp}}</p>


                     <a class="btn btn-sm btn-success  pull-right"  @click.prevent = "AddCart(item)">Buy Now!</a>
            </div>

                 </div>


               </div>
             </div>

    </div>
    </div>



  </div>

</div>

</div>
</div>



<div id="footer">
  <div class="container">
    <div class="col-sm-4">

            <img src="http://200.27.156.170/ean_default/img/cocha/RapidSSL_SEAL-90x50.gif">
          </div>
          <div class="col-sm-4 text-center" style="color:#efefef;">
            Copyright © 2017 Kent Adrian. All Rights Reserved
        Secret Secret Secret 4444, Secret, Sa - Balay mo
          </div>
          <div class="col-sm-4 text-right">
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle text-primary fa-stack-2x"></i>
                <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
              </span>
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle text-info fa-stack-2x"></i>
                <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
              </span>
            <span class="fa-stack fa-lg">
                <i class="fa fa-circle text-danger fa-stack-2x"></i>
                <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
              </span>
          </div>
        </div>
  </div>


@endsection
