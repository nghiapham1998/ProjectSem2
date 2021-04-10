<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
session_start();

class CheckOutController extends Controller
{
    public function login_checkout(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
         return view('pages.CheckOut.login')->with('category',$category)->with('brand',$brand);
    }
    public function add_customer(Request  $request){
          $data = array();
          $data['customer_name'] = $request->reg_lname;
          $data['customer_email'] = $request->reg_email;
          $data['customer_password'] = md5($request->reg_pass);
          $data['customer_phone'] = $request->reg_phone;
          $confrinpass = $request->reg_cfpass;
          if ($request->reg_pass != $confrinpass){
              Session::put('message','Mật khẩu không chính xác vui lòng kiểm tra lại !!!');
              return view('pages.register');
          }
          $customer_id = DB::table('tbl_customer')->insertGetId($data);
          Session::put('customer_id',$customer_id);
          Session::put('customer_name', $request->reg_lname);
          return Redirect::to('/checkout');

    }
    public function checkout(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $cart_session = \Illuminate\Support\Facades\Session::get('cart_id');
        if ($cart_session == null){
            return Redirect::to('/trang-chu');
        }
        return view('pages.check_out')->with('category',$category)->with('brand',$brand);
    }

    public function save_checkout_customer(Request  $request){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        $Latest_product = DB::table('tbl_product')->where('product_status','1')->orderBy('product_id','desc')->limit(4);
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_note'] = $request->shipping_note;


        $shipping_id = DB::table('tbl_shopping')->insertGetId($data);
        $cart_session = Session::get('cart_id');
        if ($cart_session == null){
            echo '<script>alert("Chưa có sản phẩm trong giỏ hàng , Vui lòng mua hàng để checkout !! ")</script>';
            return Redirect::to('/');
        }
        Session::put('shipping_id',$shipping_id);
        return Redirect::to('/payment');
    }

    public function payment(){
        $category = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();
        $brand = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();
        return view('pages.CheckOut.payment')->with('category',$category)->with('brand',$brand);
    }
    public function order_place(Request $request){
        $sesion = Session::get('shipping_id');
        print_r($sesion);

      //   insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_detail
        $content = Cart::content();
//        echo  $content;
        foreach ($content as $value){
            $order_details_data = array();
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $value->id;
            $order_details_data['product_name'] = $value->name;
            $order_details_data['product_price'] = $value->price;
            $order_details_data['product_sales_quantity'] = $value->qty;
             DB::table('tbl_order_details')->insert($order_details_data);
        }
        if ( $data['payment_method'] == 1){
             echo 'Thanh toán bằng thẻ ATM';
        }elseif ($data['payment_method'] == 2){
            Cart::destroy();
            Session::forget('shipping_id');
            Session::forget('cart_id');
             return view('pages.CheckOut.thankyou');
        }else{
            echo 'Thanh toán bằng thẻ ghi nợ';
        }

//        return Redirect::to('/payment');
    }

    public function logout_checkout(){
        Session::flush();
        return Redirect::to('/login-checkout');
}

    public function login_customer(Request $request){
         $email = $request->login_email;
         $pass = md5($request->login_pass);
         $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$pass)->first();

         if ($result){
             Session::put('customer_id',$result->customer_id);
             return Redirect::to('/checkout');
         }else{
             Session::put('message_login','Tài khoản hoặc mật khẩu không chính xác vui lòng kiểm trả lại !!!');
             return Redirect::to('/login-checkout');

         }


    }


    // function backend
    public function  AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashbord');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function manager_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id' , '=','tbl_customer.customer_id')
            ->select('tbl_order.*','tbl_customer.customer_name')
            ->orderBy('tbl_order.order_id','desc')->get();
        $manager_order = view('admin.manager_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manager_order',$manager_order);

    }

    public function view_order($order_id){
        $this->AuthLogin();
        $view_order_by_id = DB::table('tbl_order')
            ->join('tbl_customer','tbl_order.customer_id' , '=','tbl_customer.customer_id')
            ->join('tbl_shopping','tbl_order.shipping_id' , '=','tbl_shopping.shipping_id')
            ->join('tbl_order_details','tbl_order.order_id' , '=','tbl_order_details.order_id')
            ->select('tbl_order.*','tbl_customer.*','tbl_shopping.*','tbl_order_details.*')->where('tbl_order.order_id', $order_id)
            ->first();
        $manager_order_by_id = view('admin.view_order')->with('view_order_by_id',$view_order_by_id);
        return view('admin_layout')->with('admin.view_order',$manager_order_by_id);

    }
}
