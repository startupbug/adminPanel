  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('public/dist/img/user2-160x160.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>@if(Auth::check()){{Auth::user()->name}}@endif</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Permissions -->

      @if(Auth::user()->can('can-see-permission') || Auth::user()->can('can-all-permission') || Auth::user()->can('access-all') || Auth::user()->can('can-del-permission') || Auth::user()->can('can-edit-permission'))

        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Permissions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          @if(Auth::user()->can('can-add-permission') || Auth::user()->can('can-all-permission') || Auth::user()->can('access-all'))
            <li><a href="{{route('permissions.create')}}"><i class="fa fa-circle-o"></i> Add Permission</a></li>
          @endif

          @if(Auth::user()->can('can-see-permission') || Auth::user()->can('can-all-permission') || Auth::user()->can('access-all') || Auth::user()->can('can-del-permission') || Auth::user()->can('can-edit-permission'))
            <li><a href="{{route('permissions.index')}}"><i class="fa fa-circle-o"></i> Permission Management</a></li>
          @endif
          </ul>
        </li> 
      @endif
      
        <!-- Roles -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Roles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('roles.create')}}"><i class="fa fa-circle-o"></i> Add Role</a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-circle-o"></i> Role Management</a></li>
          </ul>
        </li>  

        <!-- Users -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('users.create')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
            <li><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> User Management</a></li>
          </ul>
        </li>        

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>