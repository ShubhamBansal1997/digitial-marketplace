@extends('admin.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Product
        <small>{{ isset($prod->id)?"EDIT":"ADD" }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ URL::to('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Product</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      
      <!-- SELECT2 EXAMPLE -->
       <!-- general form elements disabled -->
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Product Information</h3>
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

              <form role="form" action="{{ URL::to('admin/addeditproduct') }}" method="post" enctype= multipart/form-data> 
                <!-- text input -->
                {{ csrf_field() }}
                
                  <input type="hidden" class="form-control" value="{{ isset($prod->id)?$prod->id:NULL }}" name="id">
                
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="prod_name" value="{{ isset($prod->id)?$prod->prod_name: null }}" placeholder="Enter Product Name" required>
                </div>
                <div class="form-group">
                  <label>Slug</label>
                  <input type="text" class="form-control" name="prod_slug" value="{{ isset($prod->id)?$prod->prod_slug: null }}" placeholder="Enter Product Slug" required>
                </div>
                <div class="form-group">
                  <label>Meta Title</label>
                  <input type="text" class="form-control" name="prod_meta_title" value="{{ isset($prod->id)?$prod->prod_meta_title: null }}" placeholder="Enter Meta Title" required>
                </div>
                <div class="form-group">
                  <label>Meta Descrption</label>
                  <input type="text" class="form-control" name="prod_meta_descrption" value="{{ isset($prod->id)?$prod->prod_meta_descrption: null }}" placeholder="Enter Meta Descrption" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Product Image 1</label>
                  <input type="file" id="exampleInputFile" name="prod_image">
                  <input type="text" class="form-control" name="prod_image_alt" value="{{ isset($prod->id)?$prod->prod_image_alt: null }}" required>
                </div>
                 <div class="form-group">
                  <label for="exampleInputFile1">Image 2</label>
                  <input type="file" id="exampleInputFile1" name="prod_image1">
                  <input type="text" class="form-control" name="prod_image_alt1" value="{{ isset($prod->id)?$prod->prod_image_alt1: null }}">
                </div> 
                <div class="form-group">
                  <label for="exampleInputFile2">Image 3</label>
                  <input type="file" id="exampleInputFile2" name="prod_image2">
                  <input type="text" class="form-control" name="prod_image_alt2" value="{{ isset($prod->prod_image_alt2)?$prod->prod_image_alt2: null }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile3">Image 4</label>
                  <input type="file" id="exampleInputFile3" name="prod_image3">
                  <input type="text" class="form-control" name="prod_image_alt3" value="{{ isset($prod->prod_image_alt3)?$prod->prod_image_alt3: null }}">
                </div> 
                <div class="form-group">
                  <label for="exampleInputFile4">Image 5</label>
                  <input type="file" id="exampleInputFile4" name="prod_image4">
                  <input type="text" class="form-control" name="prod_image_alt4" value="{{ isset($prod->prod_image_alt4)?$prod->prod_image_alt4: null }}">
                </div> 
                <div class="form-group">
                  <label for="exampleInputFile5">Image 6</label>
                  <input type="file" id="exampleInputFile5" name="prod_image5">
                  <input type="text" class="form-control" name="prod_image_alt5" value="{{ isset($prod->prod_image_alt5)?$prod->prod_image_alt5: null }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile6">Image 7</label>
                  <input type="file" id="exampleInputFile6" name="prod_image6">
                  <input type="text" class="form-control" name="prod_image_alt6" value="{{ isset($prod->prod_image_alt6)?$prod->prod_image_alt6: null }}">
                </div>
                <div class="form-group">
                
                  <label>Tags (seperated by commas...)</label>
                  <input class="form-control" name="prod_tags" value="{{ isset($prod->id)?$prod->prod_tags: null }}" required>
                </div>
                <div class="form-group">
                  <label>Descrption</label>
                  <textarea id="editor" class="form-control" rows="4" name="prod_descrption" required>{{ isset($prod->id)?$prod->prod_descrption: null }}</textarea>
                </div>
                <div class="form-group">
                  <label>Demo Url</label>
                  <input type="text" class="form-control" name="prod_demourl" value="{{ isset($prod->id)?$prod->prod_demourl: null }}" placeholder="Enter Demo Url" >
                </div>

                <div class="form-group">
                  <label>Completion Time(in Case of Service)</label>
                  <input type="text" class="form-control" name="prod_completion_time" value="{{ isset($prod->prod_completion_time)?$prod->prod_completion_time: null }}" placeholder="Enter Completion Time" >
                </div>
                <div class="form-group">
                  <label>Product Previous Price</label>
                  <input type="text" class="form-control" name="prod_prev_price" value="{{ isset($prod->prod_prev_price)?$prod->prod_prev_price: null }}" placeholder="Enter Product Previous Price" >
                </div>
                <div class="form-group">
                  <label>Current Price (Enter Zero in Case of free product)</label>
                  <input type="text" class="form-control" name="prod_price" placeholder="Enter Price" value="{{ isset($prod->id)?$prod->prod_price: null}}" required>
                </div>


                <div class="form-group">
                  <label>Files Included</label>
                  <input type="text" class="form-control" name="prod_files_included" value="{{ isset($prod->prod_files_included)?$prod->prod_files_included: null }}" placeholder="Enter Files Included" >
                </div>
                <div class="form-group">
                <label>Categories</label>
                  <select class="form-control select2" name="prod_categories[]" multiple="multiple" data-placeholder="Select Categories" style="width: 100%;" type="checkbox" required>
                    @foreach(\App\Category::where('category_active',TRUE)->where('category_delete',FALSE)->get() as $cat)
                    <option value="{{ $cat->id }}" @if(isset($selectcat)!=NULL) @if(in_array($cat->id, $selectcat)) {{ "selected "}} @endif @endif > {{ $cat->category_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                <label>Customizations</label>
                  <select class="form-control select2" name="prod_customizations[]" multiple="multiple" data-placeholder="Select Customizations" style="width: 100%;" type="checkbox" required>
                    @foreach(\App\Customizations::where('customization_active',TRUE)->where('customization_delete',FALSE)->get() as $customization)
                    <option value="{{ $customization->id }}" 
                    @if(isset($selectcustomizations)!=NULL) 
                      @if(in_array($customization->id, $selectcustomizations)) {{ "selected "}} 
                      @endif 
                      @endif > {{ $customization->customization_name }}</option>
                    @endforeach
                  </select>
                </div>              
                <div class="form-group">
                  <label>Current Price</label>
                  <input type="text" class="form-control" name="prod_price" placeholder="Enter Price" value="{{ isset($prod->id)?$prod->prod_price: null}}" required>
                </div>
                <div class="form-group">
                  <label>Vendor</label>
                  <select class="form-control select2" style="width: 100%;" name="prod_vendor_id" required>
                    @if(isset($prod->id))
                    
                      <option selected="selected" value="{{ $prod->prod_vendor_id}}">{{ \App\Users::username($prod->prod_vendor_id) }}</option>
                    
                    @endif
                    @foreach(\App\Users::where('user_delete',FALSE)->where('user_accesslevel','2')->get() as $i => $vendor)
                    <option value="{{ $vendor->id }}">{{ \App\Users::username($vendor->id) }}</option>
                    @endforeach
                  </select>
                  
                </div>
                <div class="form-group">
                  <label>Featured</label>
                  <select class="form-control select2" style="width: 100%;" name="prod_featured">
                    @if(isset($prod->id))
                    {
                      <option selected="selected" value="{{ $prod->prod_featured}}">
                      @if($prod->prod_featured==TRUE)
                      
                        {{"YES"}}
                      
                      @else
                      
                        {{"NO"}}
                      
                      @endif
                      </option>
                    }
                    @endif
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                    
                  </select>
                  
                </div>
                <div class="form-group">
                  <label>Service</label>
                  <select class="form-control select2" style="width: 100%;" name="is_service">
                    @if(isset($prod->id))
                    
                      <option selected="selected" value="{{ $prod->is_service}}">
                      @if($prod->is_service==TRUE)
                      
                        {{"YES"}}
                      
                      @else
                      
                        {{"NO"}}
                      
                      @endif
                      </option>
                    
                    @endif
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                    
                  </select>
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputFile12">Upload Product</label>
                  <input type="file" id="exampleInputFile12" name="prod_file">
                </div>
                
              <div class="box-footer">
                <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                <button type="submit" class="btn btn-info pull-right">{{ isset($prod->id)?"EDIT":"ADD" }}</button>
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