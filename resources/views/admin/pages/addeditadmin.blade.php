@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>{{ isset($ved->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admin</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Admin Information</h3>
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

              <form role="form" action="{{ URL::to('admin/addeditvendor') }}" method="post"  enctype="multipart/form-data"> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($ved->id)?$ved->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="f_name" value="{{ isset($ved->id)?$ved->user_fname: null }}" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="l_name" value="{{ isset($ved->id)?$ved->user_lname: null }}" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Vendor Image</label>
                  <input type="file" id="exampleInputFile" name="profile_image">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="user_email" value="{{ isset($ved->id)?$ved->user_email: null }}" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label>Mobile</label>
                  <input type="text" class="form-control" name="mobile" value="{{ isset($ved->id)?$ved->user_mobile: null }}" placeholder="Enter Mobile" >
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="pwd" placeholder="Enter Password">
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="address" value="{{ isset($ved->id)?$ved->user_address: null }}" placeholder="Enter Address">
                </div>
                <div class="form-group">
                  <label>Country</label>
                  <input type="text" class="form-control" name="country" value="{{ isset($ved->id)?$ved->user_country: null }}" placeholder="Enter Country">
                </div>
                <div class="form-group">
                  <label>State</label>
                  <input type="text" class="form-control" name="state" value="{{ isset($ved->id)?$ved->user_state: null }}" placeholder="Enter State">
                </div>
                <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control" name="city" value="{{ isset($ved->id)?$ved->user_city: null }}" placeholder="Enter City">
                </div><div class="form-group">
                  <label>Zip</label>
                  <input type="text" class="form-control" name="zip" value="{{ isset($ved->id)?$ved->user_zip: null }}" placeholder="Enter Zipcode">
                </div>
                <input value="1" name="admin" hidden>
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ isset($ved->id)?"EDIT":"ADD" }}</button>
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