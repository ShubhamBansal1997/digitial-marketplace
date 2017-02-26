@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Vendor
        <small>{{ isset($coup->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Coupons</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Coupon Information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

              <form role="form" action="{{ URL::to('admin/addeditcoupon') }}" method="post"  enctype="multipart/form-data"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($coup->id)?$coup->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label>Coupon Name</label>
                  <input type="text" class="form-control" name="coupon_name" value="{{ isset($coup->id)?$coup->coupon_name: null }}" placeholder="Enter Coupon Name">
                </div>
                <div class="form-group">
                  <label>Coupon Code</label>
                  <input type="text" class="form-control" name="coupon_code" value="{{ isset($coup->id)?$coup->coupon_code: null }}" placeholder="Enter Coupon Code">
                </div>
                <div class="form-group">
                  <label>Coupon Amount(Less than 100 in case of the percentage)</label>
                  <input type="text" class="form-control" name="coupon_amount" value="{{ isset($coup->id)?$coup->coupon_amount: null }}" placeholder="Enter Coupon Amount">
                </div>
                <div class="form-group">
                  
                  <label>Coupon Type</label>
                  <select class="form-control select2" style="width: 100%;" name="coupon_type">
                    @if(isset($coup->id))
                    {
                      <option selected="selected" value="{{ $coup->coupon_type}}">{{ $coup->coupon_type }}</option>
                    }
                    @endif
                    <option value="flat">Flat</option>
                    <option value="percent">Percent</option>
                  </select>
                 
                </div>
                <div class="form-group">
                <label>Coupon Category</label>
                <select class="form-control select2" style="width: 100%" name="coupon_category">
                  @if(isset($coup->id))
                  {
                   <option selected="selected" value="{{ $coup->coupon_category }}">{{ \App\Category::cat_name($coup->id) }}
                  }
                  @endif
                  @foreach(\App\Category::where('category_active',TRUE)->where('category_delete',FALSE)->get() as $i => $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                <label>Coupon MinimumAmpount</label>
                <input class="form-control" name="coupon_minimumamount" placeholder="Enter the minimum Amount for coupon" value="{{ isset($coup->id)?$coup->coupon_minimumamount: null }}">
                </div>
                <div class="form-group">
                <label class="form-group">Coupon Valid Date</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" value="{{ isset($coup->id)?$coup->coupon_valid_date: null}}" name="coupon_valid_date" required>
                </div>
                
                </div>
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ isset($coup->id)?"EDIT":"ADD" }}</button>
              </div>
                
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->




    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection