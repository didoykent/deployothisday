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

<br>

<center>
<h2>ITEM REPORTS</h2>
</center>
<h2>Created Items</h2>
          <table class="table table-striped table-bordered">
            <tr>

    <th>Admin Name</th>
    <th>Action</th>
    <th>Item Name</th>
    <th>Item ID</th>
    <th>Item Price</th>
    <th>Item Quantity</th>
    <th>Date Registered</th>


            </tr>



    <tr v-for ="item in items | filterBy globalSearch">

<td>@{{item.itemClientName}}</td>
<td>@{{item.action}}</td>
<td>@{{item.itemName}}</td>
<td>@{{item.id}}</td>
<td>₱@{{item.itemSrp}}</td>
<td>@{{item.itemQuantity}}</td>
<td>@{{item.created_at}}</td>

    </tr>




              </table>






                <h2>Items Update</h2>
                        <table class="table table-striped table-bordered">
                          <tr>

                  <th>Admin Name</th>
                  <th>Action</th>
                  <th>itemName</th>
                  <th>Item Price</th>
                  <th>Current Price</th>
                  <th>Previous Quantity</th>
                  <th>Current Quantity</th>
                  <th>Previous Name</th>
                  <th>Current Name</th>

                  <th>Date Updated</th>









                          </tr>



                  <tr v-for ="item in updates | filterBy globalSearch">

            <td>@{{item.adminName}}</td>
            <td>@{{item.action}}</td>
            <td>@{{item.itemName}}</td>
            <td>₱@{{item.previousPrice}}</td>
            <td>₱@{{item.currentPrice}}</td>
            <td>@{{item.previousQuantity}}</td>
            <td>@{{item.currentQuantity}}</td>
            <td>@{{item.previousName}}</td>
            <td>@{{item.currentName}}</td>

            <td>@{{item.created_at}}</td>
                  </tr>




                            </table>






                                            <h2>Removed Items</h2>
                                                    <table class="table table-striped table-bordered">
                                                      <tr>

                                            <th>Admin Name</th>
                                            <th>Action</th>
                                            <th>Item Name</th>
                                            <th>Item Price</th>
                                            <th>Item Quantity</th>
                                            <th>Date Removed</th>








                                                      </tr>



                                              <tr v-for ="item in removed | filterBy globalSearch">

                                      <td>@{{item.adminName}}</td>
                                      <td>@{{item.action}}</td>
                                      <td>@{{item.itemName}}</td>
                                      <td>₱@{{item.itemSrp}}</td>
                                      <td>@{{item.itemQuantity}}</td>
                                      <td>@{{item.created_at}}</td>
                                              </tr>




                                                        </table>




                                                        <h2>Sale Item Reports</h2>
                                                                  <table class="table table-striped table-bordered">
                                                                    <tr>

                                                          <th>Admin Name</th>
                                                          <th>Action</th>
                                                          <th>Product Name</th>
                                                            <th>SRP Price</th>
                                                          <th>Current Sale</th>

                                                          <th>Current Price</th>

                                                          <th>Current Total Discount</th>
                                                          <th>Previous Sale</th>

                                                          <th>Previous Total Discount</th>
                                                          <th>Item's Left</th>
                                                          <th>Sale Date</th>


                                                                    </tr>



                                                            <tr v-for ="item in saleR | filterBy globsalSearch">

                                                        <td>@{{item.adminName}}</td>
                                                        <td>@{{item.action}}</td>
                                                        <td>@{{item.itemName}}</td>
                                                        <td>₱@{{item.previousPrice}}</td>
                                                        <td>@{{item.currentSale}}%</td>

                                                        <td>₱@{{item.currentPrice}}</td>

                                                        <td>₱@{{item.currentTotalDiscount}}</td>
                                                        <td>@{{item.previousSale}}%</td>

                                                        <td>₱@{{item.previousTotalDiscount}}</td>
                                                        <td>@{{item.itemQuantity}}</td>
                                                        <td>@{{item.created_at}}</td>

                                                            </tr>




                                                                      </table>


    </div>
    </div>

</div>





@endsection
