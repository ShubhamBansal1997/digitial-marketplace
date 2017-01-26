@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Payments
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

              <h3 class="box-title">Payments ( Total Payments : $ {{ \App\Payouts::sum('payout_amount') }})</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Payout Trid</th>
                  <th>Vendor Name</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Note</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payouts::where('payout_status',TRUE)->get() as $i => $pay)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $pay->payout_trid }}
                  </td>
                  <td>{{ \App\Users::username($pay->payout_vendor_id) }}</td>
                  <td>{{ $pay->payout_amount }}</td>
                  <td>{{ $pay->created_at }}</td>
                  <td>{{ $pay->payout_note }}</td>
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