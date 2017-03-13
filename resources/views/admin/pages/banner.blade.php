@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banner
        <small>Edit | Manage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banners</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Banner Image</th>
                  <th>Banner Name</th>
                  <th>Banner URL</th>
                  <th>Banner Alt Info</th>
                  <th>Banner Size</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Banners::all() as $i => $banner)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td><img src="{{ \App\Banners::getFileUrl($banner->banner_image) }}" height="30px" width="30px" /></td>
                  <td>{{ $banner->banner_name }}
                  </td>
                  <td><a href="{{ $banner->banner_url }}">{{  $banner->banner_url }}</a></td>
                  <td>{{ $banner->banner_alt }}</td>
                  <td>{{ $banner->banner_size }}</td>
                  <td> <a href="{{ URL::to('admin/editbanner')}}/{{ $banner->id }}"><i class="fa fa-fw fa-edit"></i></a></td>
                  
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