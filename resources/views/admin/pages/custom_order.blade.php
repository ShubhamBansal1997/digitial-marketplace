@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Custom Orders
        <small>View | Contact</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Custom Ordes</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <!-- <h3 class="box-title"><a href="{{ URL::to('admin/addeditcoupon')}}" class="btn btn-block btn-primary" >Add Coupon</a></h3> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Order Work</th>
                  <th>Order Price</th>
                  <th>Order Sample File</th>
                  <th>Order Completed</th>
                  <th>Order Date</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Custom_Order::get() as $i => $order)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ \App\Users::username($order->user_id) }}</td>
                  <td>{{ \App\Users::get_email($order->user_id) }}</td>
                  <td>{{ $order->order_work }}</td>
                  <td>{{ $order->order_price }}</td>
                  <td><a href="{{ \App\Custom_Order::getFileUrl($order->order_sample_file) }}"><small class="label label-success"></small>Download</small></a></td>
                  <td>
                  <a href="{{ URL::to('admin/completeincompleteorder')}}/{{ $order->id }}">
                  @if($order->order_completed==TRUE)
                    <small class="label label-success">Completed</small>
                  @else
                  
                    <small class="label label-danger">Not Completed</small>
                  
                  @endif
                  </a>
                  </td>
                  <td>{{ $order->created_at }}
                  
                  
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