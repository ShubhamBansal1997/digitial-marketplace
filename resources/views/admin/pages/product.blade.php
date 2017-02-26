@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small>Add | Edit | Delete | Manage</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">

              <h3 class="box-title"><a href="{{ URL::to('admin/addeditproduct')}}" class="btn btn-block btn-primary" >Add Product</a></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Uploaded By</th>
                  <th>Active</th>
                  <th>Download Count</th>
                  <th>Service</th>
                  <th>Featured</th>
                  <th>Created date</th>
                  <th>Last Update</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tbody>
                
                @foreach(\App\Products::where('prod_delete',FALSE)->get() as $i => $prod)
                <tr>
                  <td>{{ ++$i }}</td>
                  <td>{{ $prod->prod_name }}
                  </td>
                  <td>{{ \App\Users::username($prod->prod_vendor_id) }}</td>
                  <td>
                  <a href="{{ URL::to('admin/activeinactiveproduct')}}/{{ $prod->id }}">
                  @if($prod->prod_status==TRUE)
                    <small class="label label-success">ACTIVE</small>
                  @else
                  
                    <small class="label label-danger">INACTIVE</small>
                  
                  @endif
                  </a>
                  </td>
                  <td>{{ $prod->prod_download }}</td>
                  <th>
                  @if($prod->is_service==TRUE)
                    <small class="label label-success">Yes</small>
                  @else
                    <small class="label label-success">No</small>
                  @endif
                  </th>
                  <td><a href="{{ URL::to('admin/activeinactivefeaturedproduct')}}/{{ $prod->id }}">
                  @if($prod->prod_featured==TRUE)
                    <small class="label label-success">Yes</small>
                  @else
                  
                    <small class="label label-danger">No</small>
                  
                  @endif
                  </a>
                  </td>
                  <td>{{ $prod->created_at }}</td>
                  <td>{{ $prod->updated_at }}</td>
                  <td> 
                  <a href="{{ URL::to('admin/addeditproduct')}}/{{ $prod->id }}"><i class="fa fa-fw fa-edit"></i>
                  <a href="{{ URL::to('admin/deleteproduct')}}/{{ $prod->id }}"><i class="fa fa-fw fa-remove"></i></a><i class="fa fa-fw fa-eye"></i>
                  <a href="{{ \App\Products::getFileUrl($prod->prod_file) }}"><i class="fa fa-fw  fa-cloud-download"></i></a></td>
                  
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