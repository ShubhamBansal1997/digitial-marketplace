@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Service
        <small>Add | Edit | Delete | Manage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Service</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditproduct')}}" class="btn btn-block btn-primary" >Add Service</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Uploaded By</th>
                  <th>Active</th>
                  <th>Sales Count</th>
                  <th>Featured</th>
                  <th>Created date</th>
                  <th>Last Update</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>

                @foreach(\App\Products::where('prod_delete',FALSE)->where('is_service',true)->get() as $i => $prod)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $prod->prod_name }}
                  </td>
                  <td>{{ \App\Users::username($prod->prod_vendor_id) }}</td>
                  <td>
                  @if($prod->prod_status==TRUE)
                    <small id="activeinactivestatus" data-id="{{ $prod->id }}" class="label label-success">ACTIVE</small>
                  @else

                    <small id="activeinactivestatus" data-id="{{ $prod->id }}" class="label label-danger">INACTIVE</small>

                  @endif
                  </td>
                  <td>{{ \App\Payments::where('payment_prod_id',$prod->id)->where('payment_status',true)->count() }}</td>
                  <td>
                  @if($prod->prod_featured==TRUE)
                    <small id="featurednonfeaturedstatus" class="label label-success" data-id="{{ $prod->id }}" >Yes</small>
                  @else
                    <small id="featurednonfeaturedstatus" class="label label-danger" data-id="{{ $prod->id }}">No</small>
                  @endif
                  </td>
                  <td>{{ $prod->created_at }}</td>
                  <td>{{ $prod->updated_at }}</td>
                  <td>
                  <a href="{{ URL::to('admin/addeditproduct')}}/{{ $prod->id }}"><i class="fa fa-fw fa-edit"></i></a>
                  <i id="deleteproduct" data-id="{{ $prod->id }}" class="fa fa-fw fa-remove"></i>
                  <a href="{{ URL::to('product') }}/{{$prod->prod_slug}}/{{$prod->id}}" ><i class="fa fa-fw fa-eye"></i></a>
                  <a href="{{ \App\Products::getFileUrl($prod->prod_file) }}"><i class="fa fa-fw  fa-cloud-download"></i></a></td>

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
  $(function(){
  //upload to knowledge center
  $('small#activeinactivestatus').click(function(e){
    e.preventDefault();
    var arg = $(this).attr("data-id");
    var classname = $(this).attr("class");
    //arg = arg+'&sessionid='+SSID;
    $.ajax({
      url: '{{ URL::to('admin/activeinactiveproduct/')}}'+'/'+arg,
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
          $.notify("Inactive","error");
        }
        else{
          $(this).removeClass('label label-danger').addClass('label label-success').text('ACTIVE');
          $.notify("Active","success");
        }
      }
    });

    return false;
  });


});
  $(document).ready(function(){
    //upload to knowledge center
    $('#example2').on('click','#featurednonfeaturedstatus',function(e){
      e.preventDefault();
      var arg = $(this).attr("data-id");
      var classname = $(this).attr("class");
      //arg = arg+'&sessionid='+SSID;
      $.ajax({
        url: '{{ URL::to('admin/activeinactivefeaturedproduct')}}'+'/'+arg,
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
          if(classname==='label label-success')
           $(this).removeClass('label label-success').addClass('label label-danger').text('NO');
          else
           $(this).removeClass('label label-danger').addClass('label label-success').text('YES');
        }
      });

      return false;
    });



    //upload to knowledge center
    $('#example2').on('click','#deleteproduct',function(e){
      e.preventDefault();
      var arg = $(this).attr("data-id");
      var classname = $(this).attr("class");
      var parent = $(this).parent();
      //arg = arg+'&sessionid='+SSID;
      $.ajax({
        url: '{{ URL::to('admin/deleteproduct')}}'+'/'+arg,
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
