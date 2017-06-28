@extends('layouts.master')











@section('content')





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

  <div v-for ="user in users">
    <option value=@{{user.username}}></option>
  </div>
</datalist>



            </div>
      </div>
      <br>
      <table class="table table-striped table-hover">
        <tr>
          <th>ID</th>
          <th>Admin Name</th>
          <th>Position</th>
          <th>Date Registered</th>
          <th>Last Login</th>
          <th>Last Logout</th>


        </tr>

<tr v-for ="user in users  | filterBy globalSearch">
  <td>@{{user.id}}</td>
  <td>@{{user.username}}</td>
  <td>@{{user.position}}</td>
  <td>@{{user.created_at}}</td>
  <td>@{{user.login_time}}</td>
  <td>@{{user.logout_time}}</td>
</tr>


          </table>
    </div>
    </div>

</div>


@endsection
