<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; // giống return trả về 1 kết quả về 1 trang gì đó
use Illuminate\Support\Facades\Session; // thư viện session
session_start();
use Illuminate\Http\Request;


class BrandProduct extends Controller
{
    public function  AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashbord');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand');
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand = view('admin.all_brand')->with('all_brand',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand',$manager_brand);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name_product;
        $data['brand_desc'] = $request->brand_desc_product;
        $data['brand_status'] = $request->brand_status_product;
        DB::table('tbl_brand')->insert($data);
        Session::put('message','Thêm danh mục thành công');
        return Redirect::to('add-brandProduct');

    }

    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' => 0]);
        Session::put('alert_status','Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-brandProduct');
    }
    public function un_active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update(['brand_status' => 1]);
        Session::put('alert_status','Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-categoryProduct');
    }

    public function edit_brand($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $manager_brand = view('admin.edit_brand')->with('edit_brand',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand',$manager_brand);
    }

    public function update_brand($brand_product_id, Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_name_product;
        $data['brand_desc'] = $request->brand_desc_product;
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        Session::put('alert_status','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-brandProduct');
    }
    public function delete_brand($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('alert_status','Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-brandProduct');
    }

    // end function admin page

    //start function fontend pages
    public function show_brand_home($brand_id){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->where('tbl_product.product_status','1')->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();
        $for_export_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','asc')->limit(4)->get();
        return view('pages.brand.show_brand')
            ->with('category_product',$category)
            ->with('brand_product',$brand)
            ->with('brand_by_id',$brand_by_id)
            ->with('get_name_brand',$brand_name)
            ->with('export_product',$for_export_product);
    }
}
