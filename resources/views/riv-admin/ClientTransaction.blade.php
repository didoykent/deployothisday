@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Client Transaction</h3>
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


        <div class="form-group row add">


            <div class="form-group">


<div class="col-md-3">



              <select   class  = "form-control" v-model="city"   name = "client"placeholder = "test">
                  <option value = "" selected>Select Client</option>
                        <option v-for="myclient in newclients"
                                value="@{{myclient.id}}">

                            @{{myclient.clientName}} - @{{myclient.clientType}}
                        </option>
                  Choose  </select>



  </select>


</div>


<a href="{{route('cart.items')}}" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Buy now</a


              </div>




</div>


          </div>




      </div>

      <table class="table table-striped table-bordered">
        <tr>

<th>ID</th>
<th>Item Name</th>
<th>Item's Left</th>
<th>SRP</th>
<th>Agent Price</th>
<th>Dealer Price</th>

<th>Transaction</th>


        </tr>





<tr v-for ="item in items | filterBy globalSearch" >


<td>@{{item.id}}</td>
<td>@{{item.itemName}}</td>
<td>@{{item.itemQuantity}}</td>
<td>₱@{{item.itemSrp}}</td>
<td>₱@{{item.itemAgentPrice}}</td>
<td>₱@{{item.itemDealerPrice}}</td>







<td width = "100">

<button type="button" class = "btn btn-success"name="button" @click.prevent = "clientCart(item)">Add to Cart</button>

</td>



</tr>




          </table>
    </div>
    </div>

</div>






@endsection
