@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Inventory</h3>
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
      <br>
      <table class="table table-striped table-bordered">
        <tr>

<th>ID</th>
<th>Item Name</th>
<th>SRP</th>
<th>Item's Left</th>
<th>Date Registered</th>
<th>Date Updated</th>


        </tr>



<tr v-for ="item in items | filterBy globalSearch">

<td>@{{item.id}}</td>
<td>@{{item.itemName}}</td>
<td>₱@{{item.itemSrp}}</td>
<td>@{{item.itemQuantity}}</td>
<td>@{{item.created_at}}</td>
<td>@{{item.updated_at}}</td>

</tr>




          </table>
    </div>
    </div>

</div>





@endsection
