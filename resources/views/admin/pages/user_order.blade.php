@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Orders
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

              <h3 class="box-title">Total Orders {{ \App\Users::username($id) }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Trid</th>
                  <th>Product Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payments::where('payment_user_id',$id)->get() as $i => $pay)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $pay->payment_trid }}
                  </td>
                  <td>{{ \App\Products::product_name($pay->payout_prod_id) }}</td>
                  <td>{{ $pay->payment_amount }}</td>
                  <td>{{ $pay->created_at }}</td>
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