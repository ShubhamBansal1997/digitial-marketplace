@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product Order
        <small>{{ isset($prod->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Product Information</h3>
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

              <form role="form" action="{{ URL::to('admin/editproductorder') }}" method="post" enctype= multipart/form-data> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($product_order->id)?$product_order->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label for="exampleInputFile">Product Order File</label>
                  <input type="file" id="exampleInputFile" name="product_file">
                </div>
                
                <div class="form-group">
                  <label>Product Status</label>
                  <select class="form-control select2" style="width: 100%;" name="product_completed">
                    @if($product_order->product_completed==false)
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