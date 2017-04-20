@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor
        <small>{{ isset($coup->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customizations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Customization Information</h3>
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

              <form role="form" action="{{ URL::to('admin/addeditcustomization') }}" method="post"  enctype="multipart/form-data"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($customization->id)?$customization->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label>Customization Name</label>
                  <input type="text" class="form-control" name="customization_name" value="{{ isset($customization->id)?$customization->customization_name: null }}" placeholder="Enter Customization Name">
                </div>
                <div class="form-group">
                  <label>Customization Price</label>
                  <input type="text" class="form-control" name="customization_price" value="{{ isset($customization->id)?$customization->customization_price: null }}" placeholder="Enter Customization Price">
                </div>
                <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ isset($coup->id)?"EDIT":"ADD" }}</button>
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