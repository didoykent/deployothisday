@extends('layouts.master')











@section('content')


 @if(Session::has('cart'))


<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Admins</h3>
    </div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-4">
          <input type="text" class="form-control" list="searchitem" v-model ="globalSearch" placeholder="Search for...">





<datalist id="searchitem">

<div v-for ="client in clients">
<option value=@{{client.clientName}}></option>
</div>
</datalist>







</div>





</div>

      </div>
      <br>
      <table class="table table-striped">
        <tr>

<th>Item Name</th>
<th>SRP</th>
<th>Item Quantity</th>

<th>Total</th>
<th>Transaction</th>


        </tr>




        <tr v-for = "carts in cartitems.items">

  <td>@{{carts['item']['itemName']}}</td>
  <td>₱@{{carts['item']['itemSrp']}}</td>



<td>

  <div class="col-md-4">

        <div class="input-group">
            <span class="input-group-btn">
                <button type="button" class="btn btn-default btn-number"   @click.prevent = "reduceByOne(carts)"data-type="minus" data-field="quant[1]">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
            </span>
            <div class="col-md-2">


  <input type="number" min="1"   id = "insms" class = "text-center"name="" value="@{{carts['qty']}}" v-model = "list[$index].value" @input = "getdata(carts['item']['id'])" onkeypress="return isNumber(event)">

        </div>
            <span class="input-group-btn">
                <button type="button" class="btn btn-default btn-number"  @click.prevent = "increaseByOne(carts)"data-type="plus" data-field="quant[1]">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </span>
        </div>


      </div>




</td>
<td>₱@{{carts['price']}}</td>
<td>


  <button type = "button" @click.prevent = "removeAll(carts)"class= "btn btn-danger">Remove All</button>

</td>










</tr>








          </table>



    </div>






<div class="row">


      <div class="col-md-3">
      <div class="input-group">




        <span class="input-group-addon">₱</span>
        <input type="number" class="form-control"  aria-label="Amount (to the nearest dollar)" <input @keyup.enter = "insertCash"name="" v-model = "cash" >
        <span class="input-group-addon">.00</span>
            </div>
      </div>
      </div>
  <h2>Total Price: ₱@{{cartotalPrice}}</h2>
  <h2>Total Cash: ₱@{{totalCash}}</h2>
    <h2>Total Change: ₱@{{totalChange}}</h2>


<div class="getprint">


    <div class="container" >
    <div class="row">
        <div class="well col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" >
          <div class="" id="div-id-name">


            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <address>
                        <strong>Rivecowe</strong>
                        <br>
                        Plazuela
                        <br>
                        Iloilo, Iloilo City 5000
                        <br>
                        <abbr title="Phone">P:</abbr> (213) 484-6829
                    </address>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                    <p>
                        <em>Date: 27th February, 2017</em>
                    </p>
                    <p>
                        <em>Receipt #: 34522677W</em>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="text-center">
                    <h1>Receipt</h1>
                </div>
                </span>
                <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>#</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr v-for = "carts in solditems.items">
                            <td class="col-md-9"><em>@{{carts['item']['itemName']}}</em></h4></td>
                            <td class="col-md-1" style="text-align: center"> @{{carts['qty']}} </td>
                            <td class="col-md-1 text-center">@{{carts['item']['itemSrp']}}</td>
                            <td class="col-md-1 text-center">@{{carts['price']}}</td>
                        </tr>



                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right">
                            <p>
                                <strong>Total: </strong>
                            </p>
                            <p>
                                <strong>Tax: </strong>
                            </p>
                            <p>
                                <strong>Subtotal: </strong>
                            </p>
                            <td class="text-center">
                            <p>
                                <strong>₱@{{cartotalPrice}}</strong>
                            </p>
                            <p>
                                <strong>₱@{{salestax}}</strong>
                            </p>

                            <p>
                                <strong>₱@{{finaltotal}}</strong>
                            </p></td>
                        </tr>
                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Cash: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>₱@{{totalCash}}</strong></h4></td>
                        </tr>

                        <tr>
                            <td>   </td>
                            <td>   </td>
                            <td class="text-right"><h4><strong>Change: </strong></h4></td>
                            <td class="text-center text-danger"><h4><strong>₱@{{totalChange}}</strong></h4></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <button type="button" class="btn btn-success btn-lg btn-block" id="print" :disabled="ifError" @click.prevent ="getSalesData" onclick="printlayer('div-id-name')">
            Pay Now   <span class="glyphicon glyphicon-chevron-right"></span>
        </button></td>
        </div>

    </div>

  </div>
  </div>

  <button type="button" @click.prevent = "insertCash"name="button">CheckOut</button>






@section('scripts')
<script type = "text/javascript">
function printlayer(Layer){

  var generator = window.open(", 'name,");
  var layertext = document.getElementById(Layer);
  generator.document.write(layertext.innerHTML.replace("Print Me"));

  generator.document.close();
  generator.print();
  generator.close();
}

</script>



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




</div>






@else

@if(Session::has('success'))

<div class="row">
    <div class="col-md-4 col-md-offset-2">


<div class="alert alert-success">




<center>
               {{ Session::get('success') }}
</center>
           </div>
        </div>
</div>
@else

<div class="row">

        <h2>No Items in Cart!</h2>
    </div>
</div>

      </div>

@endif
@endif

@endsection
