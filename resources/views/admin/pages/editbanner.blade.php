@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Banner
        <small>EDIT</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Banner</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Banner Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <form role="form" action="{{ URL::to('admin/editbanner') }}" method="post" enctype= multipart/form-data> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($banner->id)?$banner->id:NULL }}" name="id">
                  
                
                <div class="form-group">
                  <label>Banner Name</label>
                  <input type="text" class="form-control" name="banner_name" value="{{ isset($banner->banner_name)?$banner->banner_name: null }}" disabled>
                </div>
                <div class="form-group">
                  <label>Banner URL</label>
                  <input type="text" class="form-control" name="banner_url" value="{{ isset($banner->banner_url)?$banner->banner_url: null }}" placeholder="Enter Banner URL" required>
                </div>
                <div class="form-group">
                  <label>Banner Size</label>
                  <input type="text" class="form-control" name="banner_size" value="{{ isset($banner->banner_size)?$banner->banner_size: null }}" placeholder="Enter Banner Size" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Banner Image</label>
                  <input type="file" id="exampleInputFile" name="banner_image" required>
                  <input type="text" class="form-control" name="banner_alt" value="{{ isset($banner->banner_alt)?$banner->banner_alt: null }}">
                </div>
                
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">SAVE</button>
              </div>
                
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection