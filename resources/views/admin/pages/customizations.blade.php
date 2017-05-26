@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customizations
        <small>Add | Delete | Active </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Customizations</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditcustomization')}}" class="btn btn-block btn-primary" >Add Customization</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customization Name</th>
                  <th>Customization Price</th>
                  <th>Customization Time</th>
                  <th>Active</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Customizations::where('customization_delete',FALSE)->get() as $i => $customization)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $customization->customization_name }}
                  </td>
                  <td>{{ $customization->customization_price }}</td>
                  <td>{{ $customization->customizations_time }}</td>
                  <td>
                  @if($customization->customization_active==TRUE)
                    <small id="activeinactivestatus" data-id="{{ $customization->id }}" class="label label-success">ACTIVE</small>
                  @else
                  
                    <small id="activeinactivestatus" data-id="{{ $customization->id }}" class="label label-danger">INACTIVE</small>
                  
                  @endif
                  <td> <a href="{{ URL::to('admin/addeditcustomization')}}/{{ $customization->id }}"><i class="fa fa-fw fa-edit"></i></a>
                  <i id="deletecategory" data-id="{{ $customization->id }}" class="fa fa-fw fa-remove"></i>
                  <i class="fa fa-fw fa-eye"></i></td>
                  
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
  $('small#activeinactivestatus').click(function(e){
    e.preventDefault();
    var arg = $(this).attr("data-id");
    var classname = $(this).attr("class");
    //arg = arg+'&sessionid='+SSID;
    $.ajax({
      url: '{{ URL::to('admin/activeinactivecustomization/')}}'+'/'+arg,
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
          $.notify("Customization Inactive","error");
        }
        else{
          $(this).removeClass('label label-danger').addClass('label label-success').text('ACTIVE');
          $.notify("Customization Active","success");
        }
      }
    });
    
    return false;
  });
  
         
});
  $(function(){
  //upload to knowledge center
  $('i#deletecategory').click(function(e){
    e.preventDefault();
    var arg = $(this).attr("data-id");
    var classname = $(this).attr("class");
    var parent = $(this).parent();
    //arg = arg+'&sessionid='+SSID;
    $.ajax({
      url: '{{ URL::to('admin/deletecustomization')}}'+'/'+arg,
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