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
      <h2>User Reports</h2>
    </center>

    <h2>Registered Users</h2>
      <table class="table table-striped table-bordered">
        <tr>

<th>Admin Name</th>
<th>Registered</th>
<th>Position</th>
<th>Date Registered</th>


        </tr>



<tr v-for ="admin in admins | filterBy globalSearch">
<td>@{{admin.adminName}}</td>
<td>@{{admin.accountName}}</td>
<td>@{{admin.position}}</td>
<td>@{{admin.created_at}}</td>

</tr>




          </table>
<br>



    </div>
    </div>

</div>





@endsection
