<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; // giống return trả về 1 kết quả về 1 trang gì đó
use Illuminate\Support\Facades\Session; // thư viện session
session_start();
use Illuminate\Http\Request;

class CategoryProduct extends Controller
{
    public function  AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashbord');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category');
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category = view('admin.all_category')->with('all_category',$all_category_product);
        return view('admin_layout')->with('admin.all_category',$manager_category);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
          $data = array();
          $data['category_name'] = $request->category_name_product;
          $data['category_desc'] = $request->category_desc_product;
          $data['category_status'] = $request->category_status_product;
          DB::table('tbl_category_product')->insert($data);
          Session::put('message','Thêm danh mục thành công');
          return Redirect::to('add-categoryProduct');

    }

    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 0]);
        Session::put('alert_status','Không kích hoạt danh mục sản phẩm thành công');
         return Redirect::to('all-categoryProduct');
     }
     public function un_active_category_product($category_product_id){
         $this->AuthLogin();
         DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status' => 1]);
         Session::put('alert_status','Kích hoạt danh mục sản phẩm thành công');
         return Redirect::to('all-categoryProduct');
     }

     public function edit_category($category_product_id){
         $this->AuthLogin();
         $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
         $manager_category = view('admin.edit_category')->with('edit_category',$edit_category_product);
         return view('admin_layout')->with('admin.edit_category',$manager_category);
     }

    public function update_category($category_product_id, Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name_product;
        $data['category_desc'] = $request->category_desc_product;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('alert_status','Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-categoryProduct');
    }
     public function delete_category($category_product_id){
         $this->AuthLogin();
         DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
         Session::put('alert_status','Xóa danh mục sản phẩm thành công');
         return Redirect::to('all-categoryProduct');
     }
     // end function admin page

    //start function fontend pages
    public function show_category_home($category_id){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.category_id',$category_id)->where('tbl_product.product_status','1')->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id',$category_id)->limit(1)->get();
        $for_export_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','asc')->limit(4)->get();
         return view('pages.category.show_category')
             ->with('category_product',$category)
             ->with('brand_product',$brand)
             ->with('category_by_id',$category_by_id)
             ->with('category_name',$category_name)
             ->with('export_product',$for_export_product);

    }
}
