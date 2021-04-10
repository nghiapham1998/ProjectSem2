<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    public function detail(){
        return view('pages.detail');
    }
    public function  index(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $Latest_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(4)->get();
        $for_export_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','asc')->limit(4)->get();
        return view('pages.home')->with('category_product',$category)->with('brand_product',$brand)->with('latest_product',$Latest_product)->with('export_product',$for_export_product);
    }
    public function  about_us(){
        return view('pages.about');
    }

    public function  contact_us(){
        return view('pages.contact');
    }
    public function  cart(){
        return view('pages.cart');
    }
    public function  check_out(){
        return view('pages.check_out');
    }


    public function register(){
        return view('pages.register');
    }

    public function search_product(Request $request){
        $keywords = $request->search;
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
//        print_r($search_product);
        return view('pages.sanpham.search')->with('category_product',$category)->with('brand_product',$brand)->with('search_product',$search_product);
    }
}
