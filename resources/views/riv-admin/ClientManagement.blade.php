@extends('layouts.master')











@section('content')




<div class="col-md-9">
  <!-- Website Overview -->
  <div class="panel panel-default">
    <div class="panel-heading main-color-bg">
      <h3 class="panel-title">Client Management</h3>
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
          <div class="col-md-4">

  <button class="btn btn-primary " data-toggle="modal" data-target="#create-item">Add Client</button>
          </div>

        </div>

      </div>
  
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
<th>Action</th>


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
  <td>

    <button type = "button" class = "btn btn-warning btn-xs" @click.prevent = "ShowClient(client)">
      <span class = "glyphicon glyphicon-edit"></span></button>


            <button type = "button" class = "btn btn-danger btn-xs" @click.prevent = "DeleteClient(client.id)" >
            <span class = "glyphicon glyphicon-trash"></span></button>


  </td>


</tr>




          </table>
    </div>
    </div>

</div>


<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create Client</h4>
        </div>
        <div class="modal-body">
          <form method="post"  @submit.prevent = "addItem">




            <div class="form-group">
              <label for="ClientName">ClientName:</label>
              <input type="text" name= "clientName" class="form-control" v-model="newClient.clientName"  placeholder="Enter Client Name here"/>
              <span v-if="formErrors['clientName']" class="error text-danger">
                @{{ formErrors['clientName'] }}
              </span>
            </div>

            <div class="form-group">
              <label for="ClientType">ClientType:</label>

<?php $store = "STORE"; ?>
<?php $agent = "AGENT"; ?>
<?php $dealer = "DEALER"; ?>
              <select class="form-control" name = "clientType" placeholder= "Enter Client Type here" v-model = "newClient.clientType" />
                    <option>{{$store}}</option>
                    <option>{{$agent}}</option>
                    <option>{{$dealer}}</option>

                  </select>

                  <span v-if="formErrors['clientType']" class="error text-danger">
                    @{{ formErrors['clientType'] }}
                  </span>
            </div>

            <div class="form-group">
              <label for="Age">Age:</label>
              <input type="text" name="clientAge" class="form-control" v-model="newClient.clientAge"  placeholder="Enter Age here"/>
              <span v-if="formErrors['clientAge']" class="error text-danger">
                @{{ formErrors['clientAge'] }}
              </span>
            </div>







            <div class="form-group">
              <label for="Birth Date">Birth Date:</label>
              <input type="date" name ="clientBday" placeholder="Enter Birth Date here" class="form-control" v-model="newClient.clientBday">
              </textarea>
              <span v-if="formErrors['clientBday']" class="error text-danger">
                @{{ formErrors['clientBday'] }}
              </span>
            </div>

            <div class="form-group">
              <label for="Contact Number">Contact Number:</label>
              <input type="text" name="clientCN" placeholder="Contact Number" class="form-control" v-model="newClient.clientCN" />
              <span v-if="formErrors['clientCN']" class="error text-danger">
                @{{ formErrors['clientCN'] }}
              </span>
            </div>

            <div class="form-group">
              <label for="Spouse">Spouse:</label>
              <textarea name="clientSpouse"  placeholder="Spouse" class="form-control" v-model="newClient.clientSpouse">
              </textarea>
              <span v-if="formErrors['clientSpouse']" class="error text-danger">
                @{{ formErrors['clientSpouse'] }}
              </span>
            </div>

            <div class="form-group">
              <label for="Job">Job:</label>
              <textarea name="clientJob" class="form-control" placeholder="Job" v-model="newClient.clientJob">
              </textarea>
              <span v-if="formErrors['clientJob']" class="error text-danger">
                @{{ formErrors['clientJob'] }}
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










  <div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Update Client</h4>
          </div>
          <div class="modal-body">
            <form method="post"  @submit.prevent = "updateItem(editClient.id)">
              <div class="form-group">
                <label for="ClientName">ClientName:</label>
                <input type="text" name= "clientName" class="form-control" v-model="editClient.clientName"  placeholder="Enter Client Name here"/>
                <span v-if="formErrorsEdit['clientName']" class="error text-danger">
                  @{{ formErrorsEdit['clientName'] }}
                </span>
              </div>

              <div class="form-group">
                <label for="ClientType">ClientType:</label>

  <?php $store = "STORE"; ?>
  <?php $agent = "AGENT"; ?>
  <?php $dealer = "DEALER"; ?>
                <select class="form-control" name = "clientType" placeholder= "Enter Client Type here" v-model = "editClient.clientType" />
                      <option>{{$store}}</option>
                      <option>{{$agent}}</option>
                      <option>{{$dealer}}</option>

                    </select>

                    <span v-if="formErrorsEdit['clientType']" class="error text-danger">
                      @{{ formErrorsEdit['clientType'] }}
                    </span>
              </div>

              <div class="form-group">
                <label for="Age">Age:</label>
                <input type="text" name="clientAge" class="form-control" v-model="editClient.clientAge"  placeholder="Enter Age here"/>
                <span v-if="formErrorsEdit['clientAge']" class="error text-danger">
                  @{{ formErrorsEdit['clientAge'] }}
                </span>
              </div>







              <div class="form-group">
                <label for="Birth Date">Birth Date:</label>
                <input type="date" name ="clientBday" placeholder="Enter Birth Date here" class="form-control" v-model="editClient.clientBday">
                </textarea>
                <span v-if="formErrorsEdit['clientBday']" class="error text-danger">
                  @{{ formErrorsEdit['clientBday'] }}
                </span>
              </div>

              <div class="form-group">
                <label for="Contact Number">Contact Number:</label>
                <input type="text" name="clientCN" placeholder="Contact Number" class="form-control" v-model="editClient.clientCN" />
                <span v-if="formErrorsEdit['clientCN']" class="error text-danger">
                  @{{ formErrorsEdit['clientCN'] }}
                </span>
              </div>

              <div class="form-group">
                <label for="Spouse">Spouse:</label>
                <textarea name="clientSpouse"  placeholder="Spouse" class="form-control" v-model="editClient.clientSpouse">
                </textarea>
                <span v-if="formErrorsEdit['clientSpouse']" class="error text-danger">
                  @{{ formErrorsEdit['clientSpouse'] }}
                </span>
              </div>

              <div class="form-group">
                <label for="Job">Job:</label>
                <textarea name="clientJob" class="form-control" placeholder="Job" v-model="editClient.clientJob">
                </textarea>
                <span v-if="formErrorsEdit['clientJob']" class="error text-danger">
                  @{{ formErrorsEdit['clientJob'] }}
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







@endsection
