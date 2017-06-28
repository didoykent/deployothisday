@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Summary of Reports</h3>
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
      <center>
      <h2>Sales Report</h2>
    </center>

    <h2>Daily Sales Report</h2>
      <table class="table table-striped table-bordered">
        <tr>

<th>Admin Name</th>
<th>Product Name</th>

<th> Quantity</th>
<th>SRP Price</th>
<th>Action</th>


<th>Tax Rate</th>



<th>Total</th>
<th>Receipt Number</th>
<th>Transaction Date</th>




  </tr>



<tr v-for = "item in dailyrep">

<td>@{{item.adminName}}</td>
<td>@{{item.itemName}}</td>
<td>@{{item.itemQuantity}}</td>
<td>₱@{{item.itemSrp}}</td>
<td>@{{item.action}}</td>
<td>@{{item.taxrate}}%</td>

<td>₱@{{item.total}}</td>
<td>@{{item.receiptNumber}}</td>
<td>@{{item.created_at}}</td>





</tr>




          </table>
<br>





<br>



    </div>
    </div>

</div>





@endsection
