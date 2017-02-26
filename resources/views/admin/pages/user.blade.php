@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>Active | Inactive | Block </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Profile Picture</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Active</th>
                  <th>Status</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Users::where('user_accesslevel','1')->get() as $i => $user)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td><img src="{{ \App\Users::profile_image($user->user_profile_image) }}" height="30px" width="30px" /></td>
                  <td>{{ $user->user_fname }} {{ $user->user_lname }}
                  </td>
                  <td>{{ $user->user_email }}</td>
                  <td>
                  <a href="{{ URL::to('admin/activeinactiveuser')}}/{{ $user->id }}">
                  @if($user->user_state==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </a>
                  <a href="{{ URL::to('admin/blockunblockeduser')}}/{{ $user->id }}">
                  @if($user->user_delete==FALSE)
                    <small class="label label-success">UNBLOCKED</small>
                  @else
                  
                    <small class="label label-danger">BLOCKED</small>
                  
                  @endif
                  </a>
                  
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection