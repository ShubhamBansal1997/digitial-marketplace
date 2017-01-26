@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendors
        <small>Manage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Vendors</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title">{{ \App\Users::username($id) }}</h3>
                  @foreach(\App\Users::where('id',$id)->get() as $user )
                  <p>Registration Date: <span>{{ $user->created_at }}</span></p>
                  @endforeach
                  
                  <p> Total earnings from {{ \App\Users::username($id) }} : <b style="color:#6f5499;">$ <span id="totEarning">{{ \App\Payments::where('payment_vendor_id',$id)->sum('payment_amount') }}</span></b> </p>

                  <p> Total commission {{ \App\Users::username($id) }} received : <b style="color:#6f5499;">$ <span id="totCommission">{{ \App\Payouts::where('payout_vendor_id',$id)->sum('payout_amount') }}</span></b> </p>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Profile</a></li>
              <li><a href="#tab_2" data-toggle="tab">Products</a></li>
              <li><a href="#tab_3" data-toggle="tab">Earnings</a></li>
              <li><a href="#tab_4" data-toggle="tab">Make a Payment</a></li>
              <li><a href="#tab_5" data-toggle="tab">Payment History</a></li>
              
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
             
              <table class="table table-bordered">
                @foreach(\App\Users::where('id',$id)->get() as $user)
                <tr>
                  <td>Name</td>
                  <td>{{ \App\Users::username($id) }}</td>
                </tr>
                <tr>
                  
                  <td>Email</td>
                  <td>{{ $user->user_email }}</td>
                </tr>
                <tr>
                  
                  <td>Status</td>
                  <td>
                    @if($user->user_status==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </td>
                </tr>
                <tr>
                  
                  <td>Mobile Number</td>
                  <td>{{ $user->user_mobile }}</td>
                </tr>
                <tr>
                  
                  <td>Address</td>
                  <td>{{ $user->user_address }}</td>
                </tr>
                <tr>
                  
                  <td>Zip</td>
                  <td>{{ $user->user_zip }}</td>
                </tr>
                <tr>
                  
                  <td>City</td>
                  <td>{{ $user->user_city }}</td>
                </tr>
                <tr>
                  
                  <td>State</td>
                  <td>{{ $user->user_state }}</td>
                </tr>
                <tr>
                  
                  <td>Country</td>
                  <td>{{ $user->user_country }}</td>
                </tr>
                @endforeach
              </table>
            </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Product Name</th>
                  <th>Price</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Products::where('prod_delete',FALSE)->where('prod_vendor_id',$id)->get() as $i => $prod)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $prod->prod_name }}
                  </td>
                  <td>{{ $prod->prod_name }}</td>
                  <td>{{ $prod->prod_price}}</td>
                  <td><i class="fa fa-fw fa-eye"></i></td>
                </tr>
                @endforeach
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_3">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Trid</th>
                  <th>Product Name</th>
                  <th>Purchase Date</th>
                  <th>Sale Cost</th>
                  <th>Vendor Commission</th>
                  <th>Admin Commission</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payments::where('payment_status',TRUE)->get() as $i => $pay)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $pay->payment_trid }}
                  </td>
                  <td>{{ \App\Products::product_name($pay->payment_prod_id) }}</td>
                  <td>{{ $pay->created_at }}</td>
                  <td>{{ $pay->payment_amount }}</td>
                  <td>{{ $pay->payment_vendor_commission }}</td>
                  <td>{{ $pay->payment_admin_commission }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4">
                <form role="form" action="{{ URL::to('admin/makepayout') }}" method="post"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ $id }}" name="id">
                
                <div class="form-group">
                  <label>Payout Mode</label>
                  <input type="text" class="form-control" name="payout_payment_mode" placeholder="Enter Method of Payment" required>
                </div>
                <div class="form-group">
                  <label>Payee Account Number</label>
                  <input type="text" class="form-control" name="payout_acc_no" placeholder="Enter Payee Account Number" required>
                </div>
                <div class="form-group">
                  <label>Payee IFSC Code</label>
                  <input type="text" class="form-control" name="payout_acc_ifsc_code" placeholder="Enter Payee Ifsc Code" required>
                </div>
                <div class="form-group">
                  <label>Payout Amount</label>
                  $ <input type="text" class="form-control" name="payout_amount" placeholder="Enter Payout Amount" required>
                </div>
                <div class="form-group">
                  <label>Payout Note</label>
                  <input type="text" class="form-control" placeholder="Enter any narration" name="payout_note"></textarea>
                </div>
                <div class="form-group">
                  <label>Payout Email</label>
                  <input type="text" class="form-control" name="payout_email" placeholder="Enter Payee Email" required>
                </div>
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">Pay</button>
              </div>
                
              </form>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_5">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Amount</th>
                  <th>Note </th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Payouts::where('payout_status',TRUE)->where('payout_vendor_id',$id)->get() as $i => $pay)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $pay->payout_amount }}
                  </td>
                  <td>{{ $pay->payout_note }}</td>
                  <td>{{ $pay->payout_created_at }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
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