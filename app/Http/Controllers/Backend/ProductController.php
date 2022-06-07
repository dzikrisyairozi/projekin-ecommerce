<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\MultiImg;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function addProduct(){
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		return view('backend.product.product-add',compact('categories','brands'));
	}

    public function storeProduct(Request $request){
        // $request->validate([
        //     'file' => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048',
        // ]);
    
        // if ($files = $request->file('file')) {
        //     $destinationPath = 'upload/pdf'; // upload path
        //     $digitalItem = date('YmdHis') . "." . $files->getClientOriginalExtension();
        //     $files->move($destinationPath,$digitalItem);
        // }

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917,1000)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;
    
        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_ind' => $request->product_name_ind,
            'product_slug_en' =>  strtolower(str_replace(' ', '-', $request->product_name_en)),
            'product_slug_ind' => str_replace(' ', '-', $request->product_name_ind),
            'product_code' => $request->product_code,
    
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_ind' => $request->product_tags_ind,
            'product_size_en' => $request->product_size_en,
            'product_size_ind' => $request->product_size_ind,
            'product_color_en' => $request->product_color_en,
            'product_color_ind' => $request->product_color_ind,
    
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_descp_ind' => $request->short_descp_ind,
            'long_descp_en' => $request->long_descp_en,
            'long_descp_ind' => $request->long_descp_ind,
    
            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,
    
            'product_thumbnail' => $save_url,
    
            // 'digital_file' => $digitalItem,
            'status' => 1,
            'created_at' => Carbon::now(),   
        ]);
    
    
        ////////// Multiple Image Upload Start ///////////
    
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917,1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;
    
            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(), 
            ]);
        }
    
        ////////// Een Multiple Image Upload Start ///////////
    
    
        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    } // end method

    public function manageProduct(){
		$products = Product::latest()->get();
		return view('backend.product.product-view',compact('products'));
	}

    public function EditProduct($id){
		$multiImgs = MultiImg::where('product_id',$id)->get();
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategory = SubCategory::latest()->get();
		$subsubcategory = SubSubCategory::latest()->get();
		$products = Product::findOrFail($id);
		return view('backend.product.product-edit',compact('categories','brands','subcategory','subsubcategory','products','multiImgs'));
	}
}