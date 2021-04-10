<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; // giống return trả về 1 kết quả về 1 trang gì đó
use Illuminate\Support\Facades\Session; // thư viện session
session_start();

class AdminController extends Controller
{

    public function  AuthLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id){
            return Redirect::to('dashbord');
        }else{
            return Redirect::to('admin')->send();
        }
    }
   public function index(){
       return view('admin_login');
   }
   public function  show_dashbord(){
        $this->AuthLogin();
       return view('admin.dashbord');
   }
   public function dashbord(Request $request){
       $admin_email = $request->admin_email;
       $admin_password = md5($request->admin_password);
       $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
//       echo "<pre>";
//       print_r($result);
       if ($result == true){
           Session::put('admin_name',$result->admin_name); // lấy kết quả từ bản csdl session
           Session::put('admin_id' ,$result->admin_id); // lấy kết quả từ csdl vào sesion
           return Redirect::to('/dashbord');

       }else{
           Session::put('message','Mật khẩu hoặc email không chính xác');
           return Redirect::to('/admin');
       }
   }
   public function log_out(){
       Session::put('admin_name',null);
       Session::put('admin_id' ,null);
       return Redirect::to('/admin');
   }
}
