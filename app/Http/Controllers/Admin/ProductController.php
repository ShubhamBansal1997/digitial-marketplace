<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use Session;
use Redirect;
use Storage;




class ProductController extends Controller
{
    public function addeditcategory(Request $request)
    {
    	$this->validate($request, [
            'category_name' => 'required',
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
        $category->category_active = TRUE;
        $category->category_delete = FALSE;
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
    	return Redirect::back();
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
    	return Redirect::back();
    }
    public function uploadfile($file)
    {
        
        if ($file->isValid()) {
            $name = time() .'_' . $file->getClientOriginalName();
            $key = 'images/' . $name;
            Storage::disk('s3')->put($key, file_get_contents($file));
            return $key;
        }
    }
    public function addeditproduct(Request $request)
    {
        //dd($request);
        //dd($key);
        $this->validate($request, [
            'prod_name' => 'required',
            'prod_image' => 'required|image',
            'prod_image_alt' =>'required',
            'prod_tags' => 'required',
            'prod_descrption' => 'required',
            'prod_categories' => 'required',
            'prod_price' => 'required',
            'prod_customize_price' => 'required',
            'prod_vendor_id' => 'required',
            'prod_featured' => 'required',
            'prod_file' => 'required|file'

                    ]);
        
        
        if($request->input('id')==NULL)
        {
            $prod = new Products;
            $prod->prod_name = $request->input('prod_name');
            $prod->prod_slug = str_replace(' ', '-', $prod->prod_name);
            $prod->prod_image = $this->uploadfile($request->file('prod_image'));
            $prod->prod_image_alt = $request->input('prod_image_alt');
            if($prod->prod_image1!=NULL&&$prod->prod_image_alt1!=NULL)
            {
                $prod->prod_image1 = $this->uploadfile($request->file('prod_image'));
                $prod->prod_image_alt1 = $request->input('prod_image_alt1'); 
            }
            if($prod->prod_image2!=NULL&&$prod->prod_image_alt2!=NULL)
            {
                $prod->prod_image2 = $this->uploadfile($request->file('prod_image2'));
                $prod->prod_image_alt2 = $request->input('prod_image_alt2'); 
            }
            if($prod->prod_image3!=NULL&&$prod->prod_image_alt1!=NULL)
            {
                $prod->prod_image3 = $this->uploadfile($request->file('prod_image3'));
                $prod->prod_image_alt3 = $request->input('prod_image_alt3'); 
            }
            if($prod->prod_image4!=NULL&&$prod->prod_image_alt4!=NULL)
            {
                $prod->prod_image4 = $this->uploadfile($request->file('prod_image4'));
                $prod->prod_image_alt4 = $request->input('prod_image_alt4'); 
            }
            if($prod->prod_image5!=NULL&&$prod->prod_image_alt5!=NULL)
            {
                $prod->prod_image5 = $this->uploadfile($request->file('prod_image5'));
                $prod->prod_image_alt5 = $request->input('prod_image_alt5'); 
            }
            if($prod->prod_image6!=NULL&&$prod->prod_image_alt6!=NULL)
            {
                $prod->prod_image6 = $this->uploadfile($request->file('prod_image6'));
                $prod->prod_image_alt6 = $request->input('prod_image_alt6'); 
            }
            $prod->prod_tags = $request->input('prod_tags');
            $prod->prod_descrption = $request->input('prod_descrption');
            $prod->prod_demourl = $request->input('prod_demourl');
            //$comma_separated = implode(",", $array);
            $prod->prod_categories = implode(",", $request->input('prod_categories'));
            $prod->prod_price = $request->input('prod_price');
            $prod->prod_customize_price = $request->input('prod_customize_price');
            $prod->prod_vendor_id = $request->input('prod_vendor_id');
            $prod->prod_featured = $request->input('prod_featured');
            $file = $request->file('prod_file');
            if ($file->isValid()) {
                $name = time() .'_' . $file->getClientOriginalName();
                $key = $name;
                Storage::disk('s3')->put($key, file_get_contents($file));
                $prod->prod_file= $key;
            }
            
            $prod->save();
            return redirect('admin/product');
        }
        
        
        else
        {
            return Redirect::back(); 
        }
        

    }
    public function viewaddeditproduct($id=NULL)
    {
        if($id!=NULL)
        {
            $prod = Products::where('id',$id)->first();
            return view('admin.pages.addeditproduct',compact('prod'));
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
        return Redirect::back();
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
        return Redirect::back();
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
        return Redirect::back();
    }
}
