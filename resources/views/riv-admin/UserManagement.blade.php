@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3 col-md-offset-2">
            <h1>Change Password</h1>
            @if(Session::has('success'))
            <div class="alert alert-success">
              <center>
                           {{ Session::get('success') }}
                         </center>
                       </div>
       @endif

       @if(Session::has('error'))
       <div class="alert alert-danger">
         <center>
                      {{ Session::get('error') }}
                    </center>
                  </div>
  @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('admin.manage') }}" method="post">
                <div class="form-group">
                    <label for="oldpassword">Current Password</label>
                    <input type="password" id="oldpass" name="oldpassword" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="newpassword" class="form-control">
                </div>


                <div class="form-group">
                    <label for="verifypassword">Verify New Password</label>
                    <input type="password" id="password" name="verifypassword" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                {{ csrf_field() }}
            </form>

        </div>
    </div>
@endsection
