@extends('admin.layouts.layout')

@section('content')
 <!-- Main content -->
 <div class="content-wrapper">
 <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">{{ $title }}</h3>
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
            @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> {{  Session::get('error_message') }}
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
                    </ul>
                </div>
            @endif
            <form name="subAdmin" id="subAdmin" @if(empty($subadmindata['id'])) action="{{ url('admin/add-edit-subadmins') }}" @else action="{{ url('admin/add-edit-subadmins/'.$subadmindata['id']) }}" @endif method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name*</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" @if(!empty($subadmindata['name'])) value="{{ $subadmindata['name']}}" @endif>
                </div>
                <div class="form-group">
                  <label for="mobile">Mobile</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile" @if(!empty($subadmindata['mobile'])) value="{{ $subadmindata['mobile'] }}" @endif>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" @if(!empty($subadmindata['email'])) value="{{ $subadmindata['email'] }}" readonly @endif>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" @if(!empty($subadmindata['password'])) value="{{ $subadmindata['password'] }}" @endif>
                  </div>
                  <div class="form-group">
                   <label for="image">Photo</label>
                   <input type="file" class="form-control" name="image" id="image">
                   @if(!empty($subadmindata['image']))
                   <a target="_blank" href="{{ url('admin/dist/img/photos/'.$subadmindata['image']) }}">View Photo</a>
                   @else
                   <input type="hidden" name="current_image" value="{{ $subadmindata['image'] }}">
                   @endif
                  </div>
                </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <!-- /.card -->

          <!-- general form elements -->
          
          <!-- /.card -->

          <!-- Input addon -->
         
            <!-- /.card-header -->
            <!-- form start -->
            
          <!-- /.card -->

        </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  </div>

@endsection
