@extends('admin.layouts.layout')

@section('content')
<div class="content-wrapper">
    <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Update Admin Details</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{  Session::get('success_message') }}
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
        <form action="{{ url('admin/update-details') }}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="card-body">
            <div class="form-group">
                <label for="admin_name">Name</label>
                <input type="text" class="form-control" name="admin_name" id="admin_name" placeholder="Enter Name" value="{{ Auth::guard('admin')->user()->name }}">
              </div>
            <div class="form-group">
              <label for="admin_email">Email address</label>
              <input type="email" class="form-control" name="admin_email" id="admin_email" placeholder="Enter email" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
            </div>
            <div class="form-group">
              <label for="admin_mobile">Mobile</label>
              <input type="text" class="form-control" name="admin_mobile" id="admin_mobile" placeholder="Enter Phone number" value="{{ Auth::guard('admin')->user()->mobile }}">
            </div>
            <div class="form-group">
              <label for="admin_image">Image</label>
              <input type="file" class="form-control" name="admin_image" id="admin_image">
              @if(!empty(Auth::guard('admin')->user()->image))
            <a target="_blank"href="{{ url('admin/dist/img/photos/'. Auth::guard('admin')->user()->image) }}">View Image</a>
            <input type="hidden" name="current_image" value="{{ Auth::guard('admin')->user()->image }}">
          @endif
            </div>
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