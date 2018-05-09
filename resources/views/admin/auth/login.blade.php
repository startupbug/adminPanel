@extends('admin.admin-app')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="login-content-wrapper content-wrapper f_wrapper login">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Login Panel
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content login-content">
     <div class="row">
        <div class="col-md-6 f_login">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              @include('admin.partials.error_section')            
              <h3 class="box-title">Login</h3>
            </div>
            <!-- /.box-header -->
              <!-- form start -->
              <form role="form" action="{{route('login_post')}}" method="post">
                <div class="box-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input type="text" class="form-control" name="email" id="" placeholder="Enter Admin Email">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" class="form-control" name="password" id="" placeholder="Enter Password">
                  </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <input type="hidden" name="_token" value="{{Session::token()}}">
                  <div class="f_loginbtn"><button type="submit" class="btn btn-primary">Login</button></div>
                </div>
              </form>
          </div>
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->

@endsection