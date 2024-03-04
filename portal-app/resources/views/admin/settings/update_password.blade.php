@extends('admin.layouts.layout')

@section('content')
<div class="content-wrapper">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    @if(Session::has('success_message'))
      <div class="alert alert-success alert-dismissable fade show" role="alert">
        <Strong>Success</Strong> {{ Session::get('success_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      @endif
      @if(Session::has('error_message'))
      <div class="alert alert-danger alert-dismissable fade show" role="alert">
        <Strong>Error</Strong> {{ Session::get('error_message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      @endif
      @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </ul>
               
            </div>
        @endif
    <form action="{{ url('admin/update-password') }}" method="post">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="admin_email">Email address</label>
          <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Email address" value={{ Auth::guard('admin')->user()->email }} @readonly(true)>
        </div>
        <div class="form-group">
          <label for="current_pwd">Current Password</label>
          <input type="password" class="form-control" name="current_pwd" id="current_pwd" placeholder="Enter Current Password"><span id="verifyCurrentPwd"></span>
        </div>
        <div class="form-group">
            <label for="new_pwd">New Password</label>
            <input type="password" class="form-control" name="new_pwd" id="new_pwd" placeholder=" Enter New Password">
          </div>
          <div class="form-group">
            <label for="confirm_pwd">Confirm Password</label>
            <input type="password" class="form-control" name ="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
          </div>
           
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

@endsection

