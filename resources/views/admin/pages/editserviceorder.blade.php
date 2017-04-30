@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Service Order
        <small>{{ isset($prod->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Service Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Service Information</h3>
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

              <form role="form" action="{{ URL::to('admin/editserviceorder') }}" method="post" enctype= multipart/form-data> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($service_order->id)?$service_order->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label for="exampleInputFile">Service Order File</label>
                  <input type="file" id="exampleInputFile" name="service_file">
                </div>
                
                <div class="form-group">
                  <label>Service Status</label>
                  <select class="form-control select2" style="width: 100%;" name="service_completed">
                    @if($service_order->service_completed==false)
                    <option selected="selected" value="0">Working</option>
                    @else
                    <option selected="selected" value="1">Completed</option>
                    @endif
                  </select>
                  
                </div>
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ "SAVE" }}</button>
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