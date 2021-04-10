<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\File;

class ProductController extends Controller
{
    public function  AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashbord');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
         return view('admin.add_product')->with('category_product',$category)->with('brand_product',$brand);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_product.category_id' , '=','tbl_category_product.category_id')
            ->join('tbl_brand','tbl_product.brand_id' , '=','tbl_brand.brand_id')
            ->orderBy('tbl_product.product_id')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['inventory'] = $request->product_inventory;
        $data['product_color'] = $request->product_color;
        $data['product_status'] = $request->product_status;


        $get_image = $request->file('product_image');
        if($get_image){
             $get_image_name = $get_image->getClientOriginalName();
             $name_image = current(explode('.',$get_image_name));
             $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
             $get_image->move('public/upload/product',$new_image);
             $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('all-Product');

        }

        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all-Product');

    }

    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 0]);
        Session::put('message','Không kích hoạt sản phẩm thành công');
        return Redirect::to('all-Product');
    }
    public function un_active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status' => 1]);
        Session::put('message','Kích hoạt  sản phẩm thành công');
        return Redirect::to('all-Product');
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $category = DB::table('tbl_category_product')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->orderBy('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)
            ->with('category_product',$category)->with('brand_product',$brand);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }

    public function update_product($product_id, Request $request){
        $this->AuthLogin();
        $data = array();

        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->product_category;
        $data['brand_id'] = $request->product_brand;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['product_status'] = $request->product_status;
        $data['inventory'] = $request->product_inventory;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_image_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_image_name));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all-Product');

        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công');
        return Redirect::to('all-Product');
    }


    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa  sản phẩm thành công');
        return Redirect::to('all-Product');
    }
    // end function page admin

    //start function fontend
    public function detail_product($product_id){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product','tbl_product.category_id' , '=','tbl_category_product.category_id')
            ->join('tbl_brand','tbl_product.brand_id' , '=','tbl_brand.brand_id')
            ->where('tbl_product.product_id',$product_id)->get();

           foreach ($details_product as $key => $value){
               $category_id = $value->category_id;
               $brand_id = $value->brand_id;

           }

     $related_product = DB::table('tbl_product')
         ->join('tbl_category_product','tbl_product.category_id' , '=','tbl_category_product.category_id')
         ->join('tbl_brand','tbl_product.brand_id' , '=','tbl_brand.brand_id')
         ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

        return view('pages.detail')
            ->with('category_product',$category)
            ->with('brand_product',$brand)
            ->with('product_details',$details_product)
            ->with('related',$related_product);
    }
}
