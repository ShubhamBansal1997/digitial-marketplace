<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use App\Customizations;
use Session;
use Redirect;
use Storage;




class ProductController extends Controller
{
    public function addeditcategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
            'category_menu' => 'required',
                    ]);
        $category_name = $request->input('category_name');
        
        if($request->input('id')==NULL)
            $category = new Category;
        else
        {
            $id = $request->input('id');
            $category = Category::where('id',$id)->first(); 
        }
        $category->category_name = $category_name;
        $category->category_slug = str_replace(' ', '-', $category_name);
        $category->category_menu = $request->input('category_menu');
        $category->category_location = $request->input('category_location');
        $category->category_active = TRUE;
        $category->category_delete = FALSE;
        $category->category_meta_title = $request->input('category_meta_title');
        $category->category_meta_descrption = $request->input('category_meta_descrption');
        $category->category_keywords = $request->input('category_keywords');
        $category->save();
        return redirect('admin/category');

    }
    public function viewaddeditcategory($id=NULL)
    {
        if($id!=NULL)
        {
            $cat = Category::where('id',$id)->first();
            return view('admin.pages.addeditcategory',compact('cat'));
        }
        else
        {
            return view('admin.pages.addeditcategory'); 
        }
        
    }
    public function deletecategory($id)
    {
        $category = Category::where('id',$id)->first();
        $category->category_active = FALSE;
        $category->category_delete = TRUE;
        $category->save();
        $msg = array(
                  'status' => 'success',
                  'msg' => 'Category Deleted successfully',
              );
        return response()->json($msg,200);;

    }
    public function activeinactivecategory($id)
    {
        $category = Category::where('id',$id)->first();
        //dd($category);
        if($category->category_active==FALSE)
            $category->category_active=TRUE;
        else
            $category->category_active=FALSE;
        $category->save();
        $msg = array(
                  'status' => 'success',
                  'msg' => 'Active status changed successfully',
              );
        return response()->json($msg,200);;
    }
    public function uploadfile($file)
    {
        
        if($file!=NULL)
        {
            if ($file->isValid()) {
                $name = time() .'_' . $file->getClientOriginalName();
                $key = 'images/' . $name;
                Storage::disk('s3')->put($key, file_get_contents($file));
                return $key;
            }
        }
    }
    public function addeditproduct(Request $request)
    {
        //dd($request);
        //dd($key);
        $this->validate($request, [
            'prod_name' => 'required',
            'prod_slug' => 'required',
            'prod_meta_title' => 'required',
            'prod_meta_descrption' => 'required',
            'prod_image' => 'image',
            'prod_image_alt' =>'required',
            'prod_tags' => 'required',
            'prod_descrption' => 'required',
            'prod_categories' => 'required',
            'prod_price' => 'required',
            'prod_vendor_id' => 'required',
            'prod_featured' => 'required',
            'prod_file' => 'file'

                    ]);
        
        
        if($request->input('id')==NULL)
        {
            $prod = new Products;
        }
        else
        {
            $prod = Products::where('id',$request->input('id'))->first();
        }
            $prod->prod_name = $request->input('prod_name');

            $prod->prod_slug = str_replace(' ', '-', $request->input('prod_slug'));
            $prod->prod_meta_descrption = $request->input('prod_meta_descrption');
            $prod->prod_meta_title = $request->input('prod_meta_title');
            $prod->prod_completion_time = $request->input('prod_completion_time');
            $prod->prod_prev_price = $request->input('prod_prev_price');
            //$prod->prod_image = $this->uploadfile($request->file('prod_image'));
            $prod->prod_image_alt = $request->input('prod_image_alt');
            if($request->file('prod_image')!=NULL)
            {
                $prod->prod_image = $this->uploadfile($request->file('prod_image'));
                //$prod->prod_image_alt1 = $request->input('prod_image_alt1'); 
            }
            if($request->file('prod_image1')!=NULL&&$request->input('prod_image_alt1')!=NULL)
            {
                $prod->prod_image1 = $this->uploadfile($request->file('prod_image1'));
                $prod->prod_image_alt1 = $request->input('prod_image_alt1'); 
            }
            if($request->file('prod_image2')!=NULL&&$request->input('prod_image_alt2')!=NULL)
            {
                $prod->prod_image2 = $this->uploadfile($request->file('prod_image2'));
                $prod->prod_image_alt2 = $request->input('prod_image_alt2'); 
            }
            if($request->file('prod_image3')!=NULL&&$request->input('prod_image_alt3')!=NULL)
            {
                $prod->prod_image3 = $this->uploadfile($request->file('prod_image3'));
                $prod->prod_image_alt3 = $request->input('prod_image_alt3'); 
            }
            if($request->file('prod_image4')!=NULL&&$request->input('prod_image_alt4')!=NULL)
            {
                $prod->prod_image4 = $this->uploadfile($request->file('prod_image4'));
                $prod->prod_image_alt4 = $request->input('prod_image_alt4'); 
            }
            if($request->file('prod_image5')!=NULL&&$request->input('prod_image_alt5')!=NULL)
            {
                $prod->prod_image5 = $this->uploadfile($request->file('prod_image5'));
                $prod->prod_image_alt5 = $request->input('prod_image_alt5'); 
            }
            if($request->file('prod_image6')!=NULL&&$request->input('prod_image_alt6')!=NULL)
            {
                $prod->prod_image6 = $this->uploadfile($request->file('prod_image6'));
                $prod->prod_image_alt6 = $request->input('prod_image_alt6'); 
            }
            $prod->prod_tags = $request->input('prod_tags');
            $prod->prod_descrption = $request->input('prod_descrption');
            $prod->prod_demourl = $request->input('prod_demourl');
            //$comma_separated = implode(",", $array);
            $prod->prod_categories = implode(",", $request->input('prod_categories'));
            $prod->prod_customizations = implode(",",$request->input('prod_customizations'));
            $prod->prod_price = $request->input('prod_price');
            $prod->prod_files_included = $request->input('prod_files_included');
            $prod->prod_vendor_id = $request->input('prod_vendor_id');
            $prod->prod_featured = $request->input('prod_featured');
            $prod->is_service = $request->input('is_service');
            
            $file = $request->file('prod_file');
            if($file!=NULL)
            {
                if ($file->isValid()) {
                    $name = time() .'_' . $file->getClientOriginalName();
                    $key = $name;
                    Storage::disk('s3')->put($key, file_get_contents($file));
                    $prod->prod_file= $key;
                }
            }
            $prod->save();
            return redirect('admin/product');
        
        

    }
    public function viewaddeditproduct($id=NULL)
    {
        if($id!=NULL)
        {
            $prod = Products::where('id',$id)->first();
            $selectcat = explode(",", $prod->prod_categories);
            $selectcustomizations = explode(",", $prod->prod_customizations);
            //dd($selectcustomizations);
            return view('admin.pages.addeditproduct',compact('prod','selectcat','selectcustomizations'));
        }
        else
        {
            return view('admin.pages.addeditproduct'); 
        }
        
    }
    public function deleteproduct($id)
    {
        $product = Products::where('id',$id)->first();
        $product->prod_status = FALSE;
        $product->prod_delete = TRUE;
        $product->save();
        $msg = array(
                  'status' => 'success',
                  'msg' => 'Product deleted successfully',
              );
        return response()->json($msg,200);
    }
    public function activeinactiveproduct($id)
    {
        $product = Products::where('id',$id)->first();
        //dd($category);
        if($product->prod_status==FALSE)
            $product->prod_status=TRUE;
        else
            $product->prod_status=FALSE;
        $product->save();

        $msg = array(
                  'status' => 'success',
                  'msg' => 'Active status changes successfully',
              );
        return response()->json($msg,200);
    }
    public function activeinactivefeaturedproduct($id)
    {
        $product = Products::where('id',$id)->first();
        //dd($category);
        if($product->prod_featured==FALSE)
            $product->prod_featured=TRUE;
        else
            $product->prod_featured=FALSE;
        $product->save();
        $msg = array(
                  'status' => 'success',
                  'msg' => 'Featured status changes successfully',
              );
        return response()->json($msg,200);;
    }
    public function addeditcustomization(Request $request)
    {
        $this->validate($request, [
            'customization_name' => 'required',
            'customization_price' => 'required',
                    ]);
        $customization_name = $request->input('customization_name');
        
        if($request->input('id')==NULL)
            $customization = new Customizations;
        else
        {
            $id = $request->input('id');
            $customization = Customizations::where('id',$id)->first(); 
        }
        $customization->customization_name = $customization_name;
        $customization->customization_price = $request->input('customization_price');
        $customization->customizations_time = $request->input('customizations_time');
        $customization->customization_active = TRUE;
        $customization->customization_delete = FALSE;
        $customization->save();
        return redirect('admin/customization');
    }
    public function viewaddeditcustomization($id=NULL)
    {
        if($id!=NULL)
        {
            $customization = Customizations::where('id',$id)->first();
            return view('admin.pages.addeditcustomization',compact('customization'));
        }
        else
        {
            return view('admin.pages.addeditcustomization'); 
        }
    }
    public function deletecustomization($id)
    {
        $customization = Customizations::where('id',$id)->first();
        $customization->customization_active = FALSE;
        $customization->customization_delete = TRUE;
        $customization->save();
        return Redirect::back();
    }
    public function activeinactivecustomization($id)
    {
        $customization = Customizations::where('id',$id)->first();
        $customization->customization_active = FALSE;
        $customization->save();
        return Redirect::back();
    }
}
