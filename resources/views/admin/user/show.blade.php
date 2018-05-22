@extends('admin.admin-app')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Panel
      </h1>
    </section>

    <!-- Main content -->
        <section class="content">
           <div class="row">
              <div class="col-md-6">
                <!-- general form elements -->
                  <div class="box box-primary">
                    <ul>
                      <li><b>Name:</b> {{ $user->name}}</li>
                      <li><b>Email:</b> {{ $user->email}}</li>
                      <li><b>Role:</b> {{ $user->display_name}}</li>
                      <li><b>Status:</b> {{ $user->status}}</li>
                    </ul> 
                  </div>
                <!-- /.box -->

              </div>

            </div>
        </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection