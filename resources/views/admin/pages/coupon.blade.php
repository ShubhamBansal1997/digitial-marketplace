@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Coupons
        <small>Add | Delete | Active </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Coupons</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditcoupon')}}" class="btn btn-block btn-primary" >Add Coupon</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Coupon Name</th>
                  <th>Coupon Code</th>
                  <th>Coupon Discount</th>
                  <th>Active</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Coupons::where('coupon_delete',FALSE)->get() as $i => $coupon)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $coupon->coupon_name }}
                  </td>
                  <td>{{ $coupon->coupon_code }}</td>
                  <td>{{ $coupon->coupon_amount }} {{ $coupon->coupon_type }}</td>
                  <td>
                  <a href="{{ URL::to('admin/activeinactivecoupon')}}/{{ $coupon->id }}">
                  @if($coupon->coupon_active==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </a>
                  <td> <a href="{{ URL::to('admin/addeditcoupon')}}/{{ $coupon->id }}"><i class="fa fa-fw fa-edit"></i><a href="{{ URL::to('admin/deletecoupon')}}/{{ $coupon->id }}"><i class="fa fa-fw fa-remove"></i></a><i class="fa fa-fw fa-eye"></i></td>
                  
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