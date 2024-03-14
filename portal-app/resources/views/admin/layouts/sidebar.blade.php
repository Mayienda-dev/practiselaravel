<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(Auth::guard('admin')->user()->image))
          <img src="{{ url('admin/dist/img/photos/'.Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
       
          @else
          <img src="{{ url('admin/dist/img/photos/no-image.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
           
          <li class="nav-item">
          
              <a  href="{{ url('admin/dashboard') }}" class="nav-link @if(Session::get('page')=='dashboard') active  @endif ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      Dashboard
                     
                      
                    </p>
              </a>
          </li>
          @if(Auth::guard('admin')->user()->type=="admin" || Auth::guard('admin')->user()->type=="subadmin")
          <li class="nav-item menu-open">
            <a  href="#" class="nav-link @if(Session::get('page') == 'update_password' || Session::get('page') == 'update_details') active @endif ">
              <i class="bi bi-gear-fill"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                
                <a href="{{ url('admin/update-password') }}" class="nav-link @if(Session::get('page')== 'update_password') active @endif " >
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
            
              
              <li class="nav-item">
             
                <a  href="{{ url('admin/update-details') }}" class="nav-link @if(Session::get('page') == 'update_details') active  @endif ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
              
            </ul>
          </li>
        @endif
          
          

         

      @if(Auth::guard('admin')->user()->type=="admin" || Auth::guard('admin')->user()->type=="subadmin")
      <li class="nav-item">
     
         <a  href="{{ url('admin/cms-pages') }}" class="nav-link @if(Session::get('page') =='cms_pages') active @endif">
             <i class="nav-icon fas fa-file-alt"></i>
               <p>
                 CMS Pages
                
                 
               </p>
         </a>
     </li>
    @endif

     @if(Auth::guard('admin')->user()->type=="admin")
      <li class="nav-item">

        <a  href="{{ url('admin/subadmins') }}" class="nav-link @if(Session::get('page') == 'subadmins') active  @endif">
            <i class="nav-icon fas fa-user"></i>
              <p>Sub Admins</p>
        </a>
      </li>
    @endif

    @if(Auth::guard('admin')->user()->type=="instructor")
    <li class="nav-item menu-open">
      <a  href="#" class="nav-link @if(Session::get('page') == 'update_instructors') active @endif ">
        <i class="nav-icon bi bi-person-badge"></i>
        <p>
          Instructors
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
       
        <li class="nav-item">
          
          <a href="{{ url('admin/update-instructors/personal') }}" class="nav-link @if(Session::get('page')== 'update_instructors') active @endif " >
            <i class="far fa-circle nav-icon"></i>
            <p>Personal details</p>
          </a>
        </li>
      
        
        <li class="nav-item">
       
          <a  href="{{ url('admin/update-instructors/course') }}" class="nav-link @if(Session::get('page') == 'update_instructors') active  @endif ">
            <i class="far fa-circle nav-icon"></i>
            <p>Course Details</p>
          </a>
        </li>
        
      </ul>
    </li>

    <li class="nav-item">
       
      <a  href="{{ url('admin/update-instructors/payment') }}" class="nav-link @if(Session::get('page') == 'update_instructors') active  @endif ">
        <i class="far fa-circle nav-icon"></i>
        <p>Payment Details</p>
      </a>
    </li>
    
  </ul>
</li>

    @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>