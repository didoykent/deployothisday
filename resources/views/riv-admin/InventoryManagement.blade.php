@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Inventory Management</h3>
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

          <button type="button" @click.prevent = "unSaleItems" class = "btn btn-danger" name="button">Remove Sale</button>
          <div class="col-md-4">
<button type="button" @click.prevent = "saleItems" class = "btn btn-success" name="button" :disabled="ifSale">Sale</button>

<select class="selectpicker" data-live-search="true" v-model = "sale"class="form-control">
<option data-tokens="Select Sales Discount">Select Sales Discount</option>
<option data-tokens="5">5</option>
<option data-tokens="10">10</option>
<option data-tokens="15">15</option>
<option data-tokens="20">20</option>
<option data-tokens="25">25</option>
<option data-tokens="30">30</option>
<option data-tokens="35">35</option>
<option data-tokens="40">40</option>
<option data-tokens="45">45</option>
<option data-tokens="50">50</option>
<option data-tokens="55">55</option>
<option data-tokens="60">60</option>
  <option data-tokens="65">65</option>
    <option data-tokens="70">70</option>
      <option data-tokens="75">75</option>
        <option data-tokens="80">80</option>
      <option data-tokens="85">85</option>
        <option data-tokens="90">90</option>
        <option data-tokens="95">95</option>
          <option data-tokens="100">100</option>

</select>



  <button class="btn btn-primary " data-toggle="modal" data-target="#new-item">Add Item</button>












          </div>

        </div>



      </div>
    
      <table class="table table-striped table-bordered">
        <tr>

<th>ID</th>
<th>Item Name</th>
<th>SRP</th>
<th>Original Price</th>
<th>Discount</th>
<th>Total Discount</th>
<th>Item's Left</th>
<th>Sale</th>
<th>Date Registered</th>
<th>Date Updated</th>

<th>Action</th>



        </tr>



<tr v-for ="item in items | filterBy globalSearch">

<td>@{{item.id}}</td>
<td>@{{item.itemName}}</td>
<td>₱@{{item.itemSrp}}</td>
<td>₱@{{item.itemOriginalPrice}}</td>
<td>@{{item.itemDiscount}}%</td>
<td>₱@{{item.itemTotalDiscount}}</td>
<td>@{{item.itemQuantity}}</td>
<td>







  <button type = "button" class = "btn btn-success btn-xs" @click.prevent = "iSale(item)">
  Sale</button>

    <button type = "button" class = "btn btn-danger btn-xs" @click.prevent = "rSale(item)">
      Remove Sale</button>

</td>
<td>@{{item.created_at}}</td>
<td>@{{item.updated_at}}</td>


<td>

  <button type = "button" class = "btn btn-warning btn-xs" @click.prevent = "ShowItem(item)">
    <span class = "glyphicon glyphicon-edit"></span></button>


          <button type = "button" class = "btn btn-danger btn-xs" @click.prevent = "DeleteItem(item.id)" >
          <span class = "glyphicon glyphicon-trash"></span></button>

</td>

</tr>




          </table>
    </div>
    </div>

</div>



<div class="modal fade" id="new-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create Item</h4>
        </div>
        <div class="modal-body">
          <form method="post"  @submit.prevent = "createItem">
            <div class="form-group">
              <label for="itemName">Item Name:</label>
              <input type="text" name= "itemName" class="form-control" v-model="newItem.itemName"  placeholder="Enter Item Name here"/>
              <span v-if="formErrorsItem['itemName']" class="error text-danger">
                @{{ formErrorsItem['itemName'] }}
              </span>
            </div>


            <div class="form-group">
              <label for="itemSrp">SRP:</label>
              <input type="text" name= "itemSrp" class="form-control" v-model="newItem.itemSrp"  placeholder="Enter Item SRP here"/>
              <span v-if="formErrorsItem['itemSrp']" class="error text-danger">
                @{{ formErrorsItem['itemSrp'] }}
              </span>
            </div>


            <div class="form-group">
              <label for="itemQuantity">Item Quantity:</label>
              <input type="text" name= "itemQuantity" class="form-control" v-model="newItem.itemQuantity"  placeholder="Enter Item Quantity here"/>
              <span v-if="formErrorsItem['itemQuantity']" class="error text-danger">
                @{{ formErrorsItem['itemQuantity'] }}
              </span>
            </div>


            <div class="form-group">
              <label for="itemImagePath">Item Image:</label>
              <input type="text" name= "itemImagePath" class="form-control" v-model="newItem.itemImagePath"  placeholder="Optional"/>
              <span v-if="formErrorsItem['itemImagePath']" class="error text-danger">
                @{{ formErrorsItem['itemImagePath'] }}
              </span>
            </div>



            <div class="form-group">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>






  <div class="modal fade" id="new-edititem" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Create Item</h4>
          </div>
          <div class="modal-body">
            <form method="post"  @submit.prevent = "patchItem(editItem.id)">
              <div class="form-group">
                <label for="itemName">Item Name:</label>
                <input type="text" name= "itemName" class="form-control" v-model="editItem.itemName"  placeholder="Enter Item Name here"/>
                <span v-if="formErrorsItemEdit['itemName']" class="error text-danger">
                  @{{ formErrorsItemEdit['itemName'] }}
                </span>
              </div>


              <div class="form-group">
                <label for="itemSrp">SRP:</label>
                <input type="text" name= "itemSrp" class="form-control" v-model="editItem.itemSrp"  placeholder="Enter Item SRP here"/>
                <span v-if="formErrorsItemEdit['itemSrp']" class="error text-danger">
                  @{{ formErrorsItemEdit['itemSrp'] }}
                </span>
              </div>


              <div class="form-group">
                <label for="itemQuantity">Item Quantity:</label>
                <input type="text" name= "itemQuantity" class="form-control" v-model="editItem.itemQuantity"  placeholder="Enter Item Quantity here"/>
                <span v-if="formErrorsItemEdit['itemQuantity']" class="error text-danger">
                  @{{ formErrorsItemEdit['itemQuantity'] }}
                </span>
              </div>


              <div class="form-group">
                <label for="itemImagePath">Item Image:</label>
                <input type="text" name= "itemImagePath" class="form-control" v-model="editItem.itemImagePath"  placeholder="Enter Item Image here"/>
                <span v-if="formErrorsItemEdit['itemImagePath']" class="error text-danger">
                  @{{ formErrorsItemEdit['itemImagePath'] }}
                </span>
              </div>


              <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>






    <div id="editSale" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@{{editSale.title}}</h4>
      </div>
      <div class="modal-body">
    <form method="post"  @submit.prevent = "newSale(editSale.id)">
      <div class="row">

<div class="col-md-4">



          <label for="previous">Current Discount : </label><label for="">@{{editSale.itemDiscount}}%</label>
</div>
      <div class="form-group row add">
        <label for="previous">Current Price : </label><label for="">₱@{{editSale.itemSrp}}</label>

      </div>



  </div>

  <div class="form-group">




    <label for="previous">Select Item Discount</label>


        <select class="selectpicker" data-live-search="true" v-model = "getdiscount" class="form-control">
      <option data-tokens="Select Here">Select Here</option>
        <option data-tokens="5">5</option>
        <option data-tokens="10">10</option>
        <option data-tokens="15">15</option>
        <option data-tokens="20">20</option>
        <option data-tokens="25">25</option>
        <option data-tokens="30">30</option>
        <option data-tokens="35">35</option>
        <option data-tokens="40">40</option>
        <option data-tokens="45">45</option>
        <option data-tokens="50">50</option>
        <option data-tokens="55">55</option>
        <option data-tokens="60">60</option>
          <option data-tokens="65">65</option>
            <option data-tokens="70">70</option>
              <option data-tokens="75">75</option>
                <option data-tokens="80">80</option>
              <option data-tokens="85">85</option>
                <option data-tokens="90">90</option>
                <option data-tokens="95">95</option>
                  <option data-tokens="100">100</option>

        </select>



    </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Sale Item</button>
      </div>
    </form>
    </div>

  </div>
</div>







@endsection
