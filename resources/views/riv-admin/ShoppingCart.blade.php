@extends('layouts.mainpage')











@section('content')


 @if(Session::has('cart'))

<div class="container">
   <div class="row">
<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Cart Items</h3>
    </div>
    <div class="panel-body">
        <div class="row">
<div class="col-sm-12 col-md-10 col-md-offset-1">
        <div class="col-md-4">






</div>





</div>

      </div>

      <table class="table table-hover">
                 <thead>
                     <tr>
                         <th>Product</th>
                         <th>Quantity</th>
                         <th class="text-center">Price</th>
                         <th class="text-center">Total</th>
                         <th> </th>
                     </tr>
                 </thead>
                 <tbody>
                    <tr v-for = "carts in cartitems.items">
                         <td class="col-sm-8 col-md-6">
                         <div class="media">
                             <a class="pull-left" href="#"> <img class="media-object" src="@{{carts['item']['itemImagePath']}}" style="width: 72px; height: 72px;"> </a>
                             <div class="media-body">
                                 <h4 class="media-heading"><a href="#">@{{carts['item']['itemName']}}</a></h4>
                                 <h5 class="media-heading"> by <a href="#">Rivecowe</a></h5>
                                 <span>Stocks: </span><span class="text-success"><strong>@{{carts['item']['itemQuantity']}}</strong></span>
                             </div>
                         </div></td>
                         <td class="col-sm-1 col-md-1" style="text-align: center">
                  <input type="text" min="1"   class = "form-control"id = "insms" class = "text-center"name="" value="@{{carts['qty']}}" v-model = "list[$index].value" @input = "getdata(carts['item']['id'])" onkeypress="return isNumber(event)">
                         </td>
                         <td class="col-sm-1 col-md-1 text-center"><strong>₱@{{carts['item']['itemSrp']}}</strong></td>
                         <td class="col-sm-1 col-md-1 text-center"><strong>₱@{{carts['price']}}</strong></td>
                         <td class="col-sm-1 col-md-1">
                         <button type="button"   @click.prevent = "removeAll(carts)" class="btn btn-danger">
                             <span class="glyphicon glyphicon-remove"></span> Remove
                         </button></td>
                     </tr>

                 </tbody>
                 <tfoot>
                     <tr>
                         <td>   </td>
                         <td>   </td>
                         <td>   </td>
                         <td><h5>Subtotal<br>Estimated shipping</h5><h3>Total</h3></td>
                         <td class="text-right"><h5><strong>₱@{{cartotalPrice}}<br>₱@{{shippingFee}}</strong></h5><h3>₱@{{onlineCartTotal}}</h3></td>
                     </tr>
                     <tr>
                         <td>   </td>
                         <td>   </td>
                         <td>   </td>
                         <td>
                         <button type="button" class="btn btn-default">
                             <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                         </button></td>
                         <td>
                         <a href = "{{route('admin.CheckOut')}}" role = "button" class="btn btn-success">
                             Checkout <span class="glyphicon glyphicon-play"></span>
                         </button></td>
                     </tr>
                 </tfoot>
             </table>











</div>
</div>
</div>
</div>



</div>

@else

<div class="row">

        <h2>Way unod</h2>
    </div>
</div>

      </div>


@endif


<script type="text/javascript">
function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}
</script>


@endsection
