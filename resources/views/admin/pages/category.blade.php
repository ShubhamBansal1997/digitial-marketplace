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

                  @if($category->category_active==TRUE)
                    <small id="activeinactivestatus" data-id="{{ $category->id }}" class="label label-success">ACTIVE</small>
                  @else

                    <small id="activeinactivestatus" data-id="{{ $category->id }}" class="label label-danger">INACTIVE</small>

                  @endif

                  <td>
                    <a href="{{ URL::to('admin/addeditcategory')}}/{{ $category->id }}">
                    <i class="fa fa-fw fa-edit"></i></a>
                    <i id="deletecategory" data-id="{{ $category->id }}" class="fa fa-fw fa-remove"></i>
                  </td>

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


@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    //upload to knowledge center
    $('#example2').on('click','#activeinactivestatus',function(e){
      e.preventDefault();
      var arg = $(this).attr("data-id");
      var classname = $(this).attr("class");
      //arg = arg+'&sessionid='+SSID;
      $.ajax({
        url: '{{ URL::to('admin/activeinactivecategory/')}}'+'/'+arg,
        data: null,
        type: "GET",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this,
        success: function(responce){
          if(classname==='label label-success')
          {
            $(this).removeClass('label label-success').addClass('label label-danger').text('INACTIVE');
            $.notify("Category Inactive","error");
          }
          else{
            $(this).removeClass('label label-danger').addClass('label label-success').text('ACTIVE');
            $.notify("Category Active","success");
          }
        }
      });

      return false;
    });


    $('#example2').on('click','#deletecategory',function(e){
      e.preventDefault();
      var arg = $(this).attr("data-id");
      var classname = $(this).attr("class");
      var parent = $(this).parent();
      //arg = arg+'&sessionid='+SSID;
      $.ajax({
        url: '{{ URL::to('admin/deletecategory')}}'+'/'+arg,
        data: null,
        type: "GET",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        context: this,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(responce){
          parent.slideUp(300, function () {
            parent.closest("tr").remove();
          });
        }
      });
      return false;
    });
  });
</script>
@endsection
