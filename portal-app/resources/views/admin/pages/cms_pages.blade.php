@extends('admin.layouts.layout')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">CMS Pages</h3>
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
            @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
              <a style = "max-width:150px; float:right; display: inline-block"href="{{ url('admin/add-edit-cms-pages') }}" class="btn btn-block btn-primary">Add CMS page</a>
            @endif
          
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
               
                    
               
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Description</th>
                    <th>meta_title</th>
                    <th>meta_description</th>
                    <th>meta_keywords</th>
                    <th>created on</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cmsPages as $page)
                  <tr>
                    <td>{{ $page['id'] }}</td>
                    <td>{{ $page['title'] }}</td>
                    <td>{{ $page['url'] }}</td>
                    <td>{{ $page['description'] }}</td>
                    <td>{{ $page['meta_title'] }}</td>
                    <td>{{ $page['meta_description'] }}</td>
                    <td>{{ $page['meta_keywords'] }}</td>
                    <td>{{ date("F j, Y, g:i a", strtotime($page['created_at'])); }}</td>
                    <td>
                        @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                          @if($page['status']==1)
                            <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id= "{{ $page['id'] }}" href="javascript:void(0)"><i class="fa fa-toggle-on" status = "Active" style="font-size:26px"> </i></a>
                          @else
                          <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id= "{{ $page['id'] }}" href="javascript:void(0)"><i class="fa fa-toggle-off" status = "Inactive" style="color: grey; font-size:26px"></i></a>
                          @endif
                        @endif
                    &nbsp; &nbsp;
                  @if($pagesModule['edit_access']==1 || $pagesModule['full_access']==1)
                    <a href="{{ url('admin/add-edit-cms-pages/'.$page['id']) }}"><i class="fa fa-edit" style="font-size:26px"></i></a>
                  @endif
                    &nbsp;&nbsp;
                  @if($pagesModule['full_access']==1)
                    <a  class= "confirmDelete" name= "Delete CMS Page" title="Delete CMS Page" href="javascript:void(0)" record = "cms-page" recordid="{{ $page['id'] }}"   <?php /*href="{{ url('admin/delete-cms-page/'.$page['id']) }}" */ ?>><i class="fa fa-trash" style="font-size:26px"></i></a>
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