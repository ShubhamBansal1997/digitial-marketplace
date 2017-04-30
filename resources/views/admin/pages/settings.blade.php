@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Settings
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Setting</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Information</h3>
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

              <form role="form" action="{{ URL::to('admin/settings') }}" method="post"  enctype="multipart/form-data"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                
                <div class="form-group">
                  <label>HomePage Meta Title</label>
                  <input type="text" class="form-control" name="homepage_meta_title" value="{{ isset($set->homepage_meta_title)?$set->homepage_meta_title: null }}" placeholder="Enter HomePage Meta Title">
                </div>
                <div class="form-group">
                  <label>HomePage Meta Descrption</label>
                  <input type="text" class="form-control" name="homepage_meta_descrption" value="{{ isset($set->homepage_meta_descrption)?$set->homepage_meta_descrption: null }}" placeholder="Enter HomePage Meta Descrption">
                </div>
                <div class="form-group">
                  <label>HomePage Keywords</label>
                  <input type="text" class="form-control" name="homepage_keywords" value="{{ isset($set->homepage_keywords)?$set->homepage_keywords: null }}" placeholder="Enter HomePage Keywords">
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