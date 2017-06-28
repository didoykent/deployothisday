@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Clients</h3>
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
<th>Client Name</th>
<th>Client Type</th>
<th>Age</th>
<th>Birthday</th>
<th>Contact Number</th>
<th>Spouse</th>
<th>Job</th>
<th>Date Registered</th>
<th>Date Updated</th>
<th>Admin</th>


        </tr>



<tr v-for ="client in clients | filterBy globalSearch">

  <td>@{{client.id}}</td>
  <td>@{{client.clientName}}</td>
  <td>@{{client.clientType}}</td>
  <td>@{{client.clientAge}}</td>
  <td>@{{client.clientBday}}</td>
  <td>@{{client.clientCN}}</td>
  <td>@{{client.clientSpouse}}</td>
  <td>@{{client.clientJob}}</td>
  <td>@{{client.created_at}}</td>
  <td>@{{client.updated_at}}</td>
  <td>@{{client.clientAdmin}}</td>


</tr>




          </table>
    </div>
    </div>

</div>





@endsection
