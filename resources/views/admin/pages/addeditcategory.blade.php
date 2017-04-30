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
                <div class="form-group">
                  <label>Category Meta Title</label>
                  <input type="text" class="form-control" name="category_meta_title" value="{{ isset($cat->category_meta_title)?$cat->category_meta_title: null }}" placeholder="Enter Category Meta Title">
                </div>
                <div class="form-group">
                  <label>Category Meta Descrption</label>
                  <input type="text" class="form-control" name="category_meta_descrption" value="{{ isset($cat->category_meta_descrption)?$cat->category_meta_descrption: null }}" placeholder="Enter Category Meta Descrption">
                </div>
                <div class="form-group">
                  <label>Category Keywords</label>
                  <input type="text" class="form-control" name="category_keywords" value="{{ isset($cat->category_keywords)?$cat->category_keywords: null }}" placeholder="Enter Category Keywords">
                </div>
                <div class="form-group">
                  <label>Category To Be Displayed in the menu or not </label>
                  <select class="form-control select2" style="width: 100%;" name="category_menu">
                    @if(isset($prod->id))
                    {
                      <option selected="selected" value="{{ $cat->category_menu}}">
                      @if($cat->category_menu==TRUE)
                      {
                        {{"YES"}}
                      }
                      @else
                      {
                        {{"NO"}}
                      }
                      @endif
                      </option>
                    }
                    @endif
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label>Category Location(Blank in case if you are not displaying</label>
                  <input type="text" class="form-control" name="category_location" value="{{ isset($cat->id)?$cat->category_location: null }}" placeholder="Enter Location of the Category (1,2,3)">
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