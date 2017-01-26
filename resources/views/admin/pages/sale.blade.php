@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales
        <small>View</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transactions</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title">Sales Statements ( Total Earnings : $ {{ \App\Payments::sum('payment_amount') }})</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Product Name</th>
                  <th>Vendor Name</th>
                  <th>Purchase Date</th>
                  <th>Tr id</th>
                  <th>Sale Cost</th>
                  <th>Vendor Commission</th>
                  <th>Admin Commission</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payments::where('payment_status',TRUE)->get() as $i => $pay)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ \App\Products::product_name($pay->payment_prod_id) }}
                  </td>
                  <td>{{ \App\Users::username($pay->payment_vendor_id) }}</td>
                  <td>{{ $pay->created_at }}</td>
                  <td>{{ $pay->payment_trid }}</td>
                  <td>{{ $pay->payment_amount }}</td>
                  <td>{{ $pay->payment_vendor_commission }}</td>
                  <td>{{ $pay->payment_admin_commission }}</td>
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