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
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  
                </button>
              </ul>
             
          </div>
      @endif
            <form name= "cmsForm" id= "cmsForm" @if(empty($cmspage['id'])) action="{{ url('admin/add-edit-cms-pages') }}" @else action="{{ url('admin/add-edit-cms-pages/'.$cmspage['id']) }}" @endif method="post">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="title">Title*</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" @if(!empty($cmspage['title'])) value="{{ $cmspage['title'] }}" @endif>
                </div>
                <div class="form-group">
                  <label for="url">URL*</label>
                  <input type="text" class="form-control" id="url" name="url" placeholder="Enter url" @if(!empty($cmspage['url'])) value="{{ $cmspage['url'] }}" @endif>
                </div>
                <div class="form-group">
                    <label for="url">Description</label>
                    <input type="description" class="form-control" id="description" name="description" placeholder="Enter Description" @if(!empty($cmspage['description'])) value="{{ $cmspage['description'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_title">meta_title*</label>
                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title" @if(!empty($cmspage['meta_title'])) value="{{ $cmspage['meta_title'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="meta_description">meta description*</label>
                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter meta description" @if(!empty($cmspage['meta_description'])) value="{{ $cmspage['meta_description'] }}" @endif>
                  </div>
                  <div class="form-group">
                    <label for="url">Meta Keywords*</label>
                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta keywords" @if(!empty($cmspage['meta_keywords'])) value="{{ $cmspage['meta_keywords'] }}" @endif>
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