@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category
        <small>Add | Edit | Delete</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditcategory')}}" class="btn btn-block btn-primary" >Add Category</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Category Meta Title</th>
                  <th>Category Meta Descrption</th>
                  <th>Category Keywords</th>
                  <th>Active</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Category::where('category_delete',FALSE)->get() as $i => $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->category_name}}</td>
                  <td>{{ isset($category->category_meta_title)?$category->category_meta_title: null }}</td>
                  <td>{{ isset($category->category_meta_descrption)?$category->category_meta_descrption: null }}</td>
                  <td>{{ isset($category->category_keywords)?$category->category_keywords: null }}</td>
                  <td>
                  <a href="{{ URL::to('admin/activeinactivecategory')}}/{{ $category->id }}">
                  @if($category->category_active==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </a>
                  <td> <a href="{{ URL::to('admin/addeditcategory')}}/{{ $category->id }}"><i class="fa fa-fw fa-edit"></i><a href="{{ URL::to('admin/deletecategory')}}/{{ $category->id }}"><i class="fa fa-fw fa-remove"></i></a></td>
                  
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