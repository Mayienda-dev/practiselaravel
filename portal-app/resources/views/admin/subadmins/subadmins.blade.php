@extends('admin.layouts.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sub admins</h3>
              @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{  Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          @endif

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <a style = "max-width:150px; float:right; display: inline-block"href="{{ url('admin/add-edit-subadmins') }}" class="btn btn-block btn-primary">Add Subadmins</a>
          
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
               
                    
               
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>name</th>
                    <th>type</th>
                    <th>mobile</th>
                    <th>email</th>
                    <th>created on</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($subadmins as $subadmin)
                  <tr>
                    <td>{{ $subadmin->id }}</td>
                    <td>{{ $subadmin->name }}</td>
                    <td>{{ $subadmin->type }}</td>
                    <td>{{ $subadmin->mobile }}</td>
                    <td>{{ $subadmin->email }}</td>
                   
                    <td>{{ date("F j, Y, g:i a", strtotime($subadmin->created_at)); }}</td>
                    <td>
                     @if($subadmin->status==1)
                        <a class="updateSubAdminStatus" href="javascript:void(0)" id="subadmin-{{ $subadmin->id }}" subadmin_id= "{{ $subadmin->id }}"><i class="fas fa-toggle-on" status="Active" style="font-size: 26px;"></i></a>
                      @else
                        <a class= "updateSubAdminStatus" href="javascript:void(0)" id="subadmin-{{ $subadmin->id }}" subadmin_id= "
                        {{ $subadmin->id }}"><i class="fas fa-toggle-off" status="Inactive" style="font-size:26px; color:grey"></i></a>
                      @endif                     

                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
@endsection