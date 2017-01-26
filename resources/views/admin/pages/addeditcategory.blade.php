@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
        <small>{{ isset($cat->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Category Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" action="{{ URL::to('admin/addeditcategory') }}" method="post"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($cat->id)?$cat->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" name="category_name" value="{{ isset($cat->id)?$cat->category_name: null }}" placeholder="Enter New Category">
                </div>
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ isset($cat->id)?"EDIT":"ADD" }}</button>
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