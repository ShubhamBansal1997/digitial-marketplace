@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Service Orders
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Order_id</th>
                  <th>Customer Name</th>
                  <th>Customer Email</th>
                  <th>Product Name</th>
                  <th>Vendor Name</th>
                  <th>Price</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Order Instruction</th>
                  <th>Further Messages</th>
                  <th>Sample File</th>
                  <th>Customer Copy</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payments::where('payment_status',TRUE)->where('payment_order_type',2)->get() as $i => $order)
                @foreach(\App\Service_Order::where('service_payment_id',$payment->payment_trid)->get() as $service_order)
                <tr>
                  
                  <td>{{ $order->payment_trid }}</td>
                  <td>{{ \App\Users::username($order->payment_user_id) }}</td>
                  <td>{{ $order->payment_email }}</td>
                  <td>{{ \App\Products::product_name($order->payment_prod_id) }}</td>
                  <td>{{ \App\Users::username($order->payment_vendor_id) }}</td>
                  <td>{{ $order->payment_amount }}</td>
                  <td> {{ \App\Products::get_time($order->payment_vendor_id) }}</td>
                  @if($service_order->service_completed==true)
                  <td>  <small class="label label-success"> Completed </small>< /td>
                  @else
                  <td> <small class="label label-danger"> Working</small>
                  @endif
      
                  <td> {{ isset($service_order->service_message1)?$service_order->service_message1: null }}</td>
                  <td> {{ isset($service_order->service_message2)?$service_order->service_message2: null }}</td>
                  <td>
                  <a href="{{ \App\Products::getFileUrl($service_order->service_sample_file) }}"><i class="fa fa-fw  fa-cloud-download"></i></a>
                  </td>
                  <td>
                  <a href="{{ \App\Products::getFileUrl($service_order->service_file) }}"><i class="fa fa-fw  fa-cloud-download"></i></a>
                  </td>
                  <td><a href="{{ URL::to('admin/editserviceorder') }}/{{ $service_order->id }}" class="btn btn-block btn-primary">Edit</a></td>

                  
                </tr>
                @endforeach
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