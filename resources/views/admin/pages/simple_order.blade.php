@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Simple Orders
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
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payments::where('payment_status',TRUE)->where('payment_order_type',1)->get() as $i => $order)
                <tr>
                  <td>{{ $order->payment_trid }}</td>
                  <td>{{ \App\Users::username($order->payment_user_id) }}</td>
                  <td>{{ $order->payment_email }}</td>
                  <td>{{ \App\Products::product_name($order->payment_prod_id) }}</td>
                  <td>{{ \App\Users::username($order->payment_vendor_id) }}</td>
                  <td>{{ $order->payment_amount }}</td>
                  
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