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
            <form name="subAdmin" id="subAdmin" action="{{ url('admin/update-role/'.$id) }}"  method="post">
                @csrf
                <input type="hidden" name="admin_id" value="{{ $id }}">
                @if(!empty($subadminRoles))
                  @foreach($subadminRoles as $role)
                  @if($role['module']=="cms_pages")
                    @if($role['view_access']==1)
                      @php $viewCmsPages = "checked"  @endphp
                    @else
                      @php $viewCmsPages = ""  @endphp

                    @endif

                    @if($role['edit_access']==1)
                      @php $editCmsPages = "checked"  @endphp
                    @else
                      @php $editCmsPages = ""  @endphp

                    @endif

                    @if($role['full_access']==1)
                      @php $fullCmsPages = "checked"  @endphp
                    @else
                      @php $fullCmsPages = ""  @endphp

                    @endif
                    @endif
                  
                  @endforeach



                @endif
                
              <div class="card-body">
                
                
               
                  <div class="form-group">
                    <label for="cms_pages">CMS PAGES:</label>
                    <input type="checkbox" name="cms_pages[view]" value="1" @if(isset($viewCmsPages)) {{ $viewCmsPages }} @endif>View Access
                    <input type="checkbox" name="cms_pages[edit]" value="1" @if(isset($editCmsPages)) {{ $editCmsPages }} @endif>Edit Access
                    <input type="checkbox" name="cms_pages[full]" value="1" @if(isset($fullCmsPages)) {{ $fullCmsPages }} @endif>Full Access
                   
                 
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
