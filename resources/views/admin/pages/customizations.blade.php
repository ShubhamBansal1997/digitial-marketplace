@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customizations
        <small>Add | Delete | Active </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customizations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditcustomization')}}" class="btn btn-block btn-primary" >Add Customization</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customization Name</th>
                  <th>Customization Price</th>
                  <th>Customization Time</th>
                  <th>Active</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Customizations::where('customization_delete',FALSE)->get() as $i => $customization)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $customization->customization_name }}
                  </td>
                  <td>{{ $customization->customization_price }}</td>
                  <td>{{ $customization->customizations_time }}</td>
                  <td>
                  <a href="{{ URL::to('admin/activeinactivecustomization')}}/{{ $customization->id }}">
                  @if($customization->customization_active==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </a>
                  <td> <a href="{{ URL::to('admin/addeditcustomization')}}/{{ $customization->id }}"><i class="fa fa-fw fa-edit"></i><a href="{{ URL::to('admin/deletecustomization')}}/{{ $customization->id }}"><i class="fa fa-fw fa-remove"></i></a><i class="fa fa-fw fa-eye"></i></td>
                  
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