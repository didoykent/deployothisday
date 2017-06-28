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
          <th>Status</th>
          <th>Action</th>


        </tr>

<tr v-for ="user in manageusers  | filterBy globalSearch">
  <td>@{{user.id}}</td>
  <td>@{{user.username}}</td>
  <td>@{{user.position}}</td>
  <td>@{{user.created_at}}</td>
  <td>@{{user.login_time}}</td>
  <td>@{{user.logout_time}}</td>
  <td>@{{user.status}}</td>
  <td>

    <button type = "button" class = "btn btn-info btn-xs" @click.prevent = "Changepassword(user)">
      <span class = "glyphicon glyphicon-edit"></span></button>

      <button type = "button" class = "btn btn-warning btn-xs" @click.prevent = "ChangeStatus(user)">
        <span class = "glyphicon glyphicon-warning-sign"></span></button>


            <button type = "button" class = "btn btn-danger btn-xs" @click.prevent = "RemoveUser(user.id)" >
            <span class = "glyphicon glyphicon-trash"></span></button>
  </td>

</tr>


          </table>
    </div>
    </div>

</div>




<div class="modal fade" id="user-changepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Change Password</h4>
        </div>
        <div class="modal-body">
          <form method="post"  @submit.prevent = "myPassword(editUser.id)">

            <div class="row">

            <div class="col-md-4">



                <label for="UserName">Username : </label><label for="">@{{editUser.name}}</label>
            </div>
            <div class="form-group row add">
              <label for="Position">Position : </label><label for="">@{{editUser.position}}</label>

            </div>



            </div>

            <div class="form-group">
              <label for="newpassword">New Password:</label>

              <input type="password" name= "newpassword" class="form-control" v-model="editUser.newpassword"  placeholder="Enter New Password Here"/>
              <span v-if="formErrorsUserEdit['newpassword']" class="error text-danger">
                @{{ formErrorsUserEdit['newpassword'] }}
              </span>
            </div>


            <div class="form-group">
              <label for="confirmpassword">Confirm Password:</label>
              <input type="password" name="confirmpassword" class="form-control" v-model="editUser.confirmpassword"  placeholder="Confirm Password"/>
              <span v-if="formErrorsUserEdit['confirmpassword']" class="error text-danger">
                @{{ formErrorsUserEdit['confirmpassword'] }}
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







  <div class="container">

  <!-- Modal -->
  <div class="modal fade" id="userStatus" role="dialog">
    <div class="modal-dialog">


      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Ban/Unban</h4>
        </div>
        <div class="modal-body">
          <div class="row">

          <div class="col-md-4">



              <label for="UserName">Username : </label><label for="">@{{editStatus.name}}</label>
          </div>
          <div class="form-group row add">
      <div class="col-md-4">

<label for="Position">Status : </label><label for="">@{{editStatus.status}}</label>

          </div>

</div>


<div class="col-md-4">



  <label for="Position">Position : </label><label for="">@{{editStatus.position}}</label>

    </div>







        </div>
        <div class="modal-footer">

          <div class="form-group">
            <div class="col-md-12">


                <button type="submit" @click.prevent = "banUser(editStatus.id)" class="btn btn-danger">Ban</button>
                <button type="submit" @click.prevent = "unBanUser(editStatus.id)" class="btn btn-success">Remove Ban</button>
                    </div>
          </div>
        </div>

      </div>

    </div>
  </div>

</div>


@endsection
