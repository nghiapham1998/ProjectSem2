<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//fontend
Route::get('/', [\App\Http\Controllers\HomeController::class , 'index'] );
Route::get('/trang-chu', [\App\Http\Controllers\HomeController::class , 'index'] );
Route::get('/shop', [\App\Http\Controllers\HomeController::class , 'index']);
Route::get('/tim-kiem', [\App\Http\Controllers\HomeController::class , 'search_product']);

Route::get('/danhmucsanpham/{category_id}', [\App\Http\Controllers\CategoryProduct::class,'show_category_home']);
Route::get('/thuonghieusanpham/{brand_id}', [\App\Http\Controllers\BrandProduct::class,'show_brand_home']);
Route::get('/chitietsanpham/{product_id}', [\App\Http\Controllers\ProductController::class,'detail_product']);
Route::get('/detail', [\App\Http\Controllers\HomeController::class , 'detail']);
Route::get('/about-us', [\App\Http\Controllers\HomeController::class , 'about_us']);
Route::get('/contact-us', [\App\Http\Controllers\HomeController::class , 'contact_us']);
Route::get('/cart', [\App\Http\Controllers\HomeController::class , 'cart']);
Route::get('/check-out', [\App\Http\Controllers\HomeController::class , 'check_out']);
Route::get('/register',[\App\Http\Controllers\HomeController::class,'register']);

//cart
Route::post('/save-cart',[\App\Http\Controllers\CartController::class,'save_cart']);
Route::get('/show-cart',[\App\Http\Controllers\CartController::class,'show_cart']);
Route::get('/delete-to-cart/{rowId}',[\App\Http\Controllers\CartController::class,'delete_cart']);
Route::post('/update-to-cart',[\App\Http\Controllers\CartController::class,'update_cart']);

//check out
Route::get('/login-checkout',[\App\Http\Controllers\CheckOutController::class,'login_checkout']);
Route::post('/login-customer',[\App\Http\Controllers\CheckOutController::class,'login_customer']);
Route::post('/add-customer',[\App\Http\Controllers\CheckOutController::class,'add_customer']);

Route::prefix('/')->middleware('checklogin')->group(function (){
    Route::get('/checkout',[\App\Http\Controllers\CheckOutController::class,'checkout']);
    Route::post('/save-checkout-customer',[\App\Http\Controllers\CheckOutController::class,'save_checkout_customer']);
    Route::get('/logout-checkout',[\App\Http\Controllers\CheckOutController::class,'logout_checkout']);
    Route::get('/payment',[\App\Http\Controllers\CheckOutController::class,'payment']);
    Route::get('/order-place',[\App\Http\Controllers\CheckOutController::class,'order_place']);
});

Route::prefix('/')->middleware('checkshipping',)->group(function (){
    Route::get('/order-place',[\App\Http\Controllers\CheckOutController::class,'order_place']);
});





//Order-admin
Route::get('/manager-order',[\App\Http\Controllers\CheckOutController::class,'manager_order']);
Route::get('view-order/{order_id}',[\App\Http\Controllers\CheckOutController::class,'view_order']);




//backend
Route::get('/admin',   [\App\Http\Controllers\AdminController::class , 'index']);
Route::get('/dashbord',[\App\Http\Controllers\AdminController::class , 'show_dashbord']);
Route::get('/log-out',[\App\Http\Controllers\AdminController::class , 'log_out']);
Route::post('/admin-dashbord',[\App\Http\Controllers\AdminController::class , 'dashbord']);


// Category Product (Danh mục sãn phẩm)
Route::get('/add-categoryProduct',[\App\Http\Controllers\CategoryProduct::class , 'add_category_product']);
Route::get('/all-categoryProduct',[\App\Http\Controllers\CategoryProduct::class , 'all_category_product']);
Route::post('/save-category' ,[\App\Http\Controllers\CategoryProduct::class , 'save_category_product']);
Route::get('/edit-category/{category_product_id}',[\App\Http\Controllers\CategoryProduct::class , 'edit_category']);
Route::get('/delete-category/{category_product_id}',[\App\Http\Controllers\CategoryProduct::class , 'delete_category']);
Route::post('/update-category/{category_product_id}',[\App\Http\Controllers\CategoryProduct::class , 'update_category']);
Route::get('/active-category/{category_product_id}',[\App\Http\Controllers\CategoryProduct::class , 'active_category_product']);
Route::get('/un_active-category/{category_product_id}',[\App\Http\Controllers\CategoryProduct::class , 'un_active_category_product']);


// Brand Product (Thương hiệu sản phẩm)
Route::get('/add-brandProduct',[\App\Http\Controllers\BrandProduct::class , 'add_brand_product']);
Route::get('/all-brandProduct',[\App\Http\Controllers\BrandProduct::class , 'all_brand_product']);
Route::post('/save-brand' ,[\App\Http\Controllers\BrandProduct::class , 'save_brand_product']);
Route::get('/edit-brand/{brand_product_id}',[\App\Http\Controllers\BrandProduct::class , 'edit_brand']);
Route::get('/delete-brand/{brand_product_id}',[\App\Http\Controllers\BrandProduct::class , 'delete_brand']);
Route::post('/update-brand/{brand_product_id}',[\App\Http\Controllers\BrandProduct::class , 'update_brand']);
Route::get('/active-brand/{brand_product_id}',[\App\Http\Controllers\BrandProduct::class , 'active_brand_product']);
Route::get('/un_active-brand/{brand_product_id}',[\App\Http\Controllers\BrandProduct::class , 'un_active_brand_product']);


// Product ( sản phẩm )
Route::get('/add-Product',[\App\Http\Controllers\ProductController::class , 'add_product']);
Route::get('/all-Product',[\App\Http\Controllers\ProductController::class , 'all_product']);
Route::post('/save-Product' ,[\App\Http\Controllers\ProductController::class , 'save_product']);
Route::get('/edit-product/{product_id}',[\App\Http\Controllers\ProductController::class , 'edit_product']);
Route::get('/delete-Product/{product_id}',[\App\Http\Controllers\ProductController::class , 'delete_product']);
Route::post('/update-Product/{product_id}',[\App\Http\Controllers\ProductController::class , 'update_product']);
Route::get('/active-product/{product_id}',[\App\Http\Controllers\ProductController::class , 'active_product']);
Route::get('/un_active-product/{product_id}',[\App\Http\Controllers\ProductController::class , 'un_active_product']);



