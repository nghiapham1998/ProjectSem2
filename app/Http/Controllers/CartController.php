<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request)
    {
       $product_id = $request->product_id_hidden;
       $quantity = $request->product_quatity;

        $product_info = DB::table('tbl_product')->where('product_id',$product_id)->first();


        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_id;
        $data['options']['image'] = $product_info->product_image;

        Cart::add($data);
        Session::put('cart_id' ,$data['id']); // lấy kết quả từ csdl vào sesion
        return Redirect::to('/show-cart');



    }
    public function show_cart(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.cart')->with('category',$category)->with('brand',$brand);
    }

    public function  delete_cart($rowId,Request  $request){
        Cart::update($rowId,0);

       $request->session()->forget('cart_id');
        return Redirect::to('/show-cart');
    }
    public function update_cart(Request $request){
          $rowId = $request->rowId_cart;
          $quantity = $request->product_quatity;
        Cart::update($rowId,$quantity);
        return Redirect::to('/show-cart');
    }
}
