<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/shop', function () {
  
    return view('shopping_cart');
});

Route::get('/signup',[HomeController::class,'getSignUp'])->name('getsignup');
Route::post('/signup',[HomeController::class,'postSignup'])->name('postsignup');

Route::get('/signin',[HomeController::class,'getLogin'])->name('getlogin');
Route::post('/signin',[HomeController::class,'postLogin'])->name('postlogin');

Route::get('/signout',[HomeController::class,'getLogout'])->name('getlogout');
// Route::resource('/shop',ProductController::class);

Route::get('/shop/{id}',[ProductController::class,'show'])-> name('product.detail');

Route::get('/',[ProductController::class,'index'])-> name('homepage');

// Route::get('/signup', [UserController::class, 'signup'])->name('signup');

// Route::get('/login', [UserController::class, 'login'])->name('login');



Route::get('/pricing',[ProductController::class,'showPricing'])-> name('pricing');

Route::get('/checkout',[HomeController::class,'checkout'])-> name('checkout');
Route::post('/checkout',[HomeController::class,'postCheckout'])->name('postcheckout');

//để liên kết với nút hình Giỏ hàng để thêm sản phẩm vào giỏ hàng
Route::get('/add-to-cart/{id}',[HomeController::class,'addToCart'])->name('banhang.addtocart');
Route::get('/del-cart/{id}',[HomeController::class,'delCartItem'])->name('banhang.xoagiohang');
// routes/web.php
// Route::post('update-to-cart', 'HomeController@updatetocart')->name('cart.update');
Route::post('update-to-cart', [HomeController::class, 'updateToCart'])->name('update-to-cart');
// Route::put('/cart/{id}', [HomeController::class, 'update2'])->name('cart.update');

Route::get('/dathang',[HomeController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('/dathang',[HomeController::class,'postCheckout'])->name('banhang.postdathang');
Route::get('/history',[HomeController::class,'getHistory'])->name('banhang.gethistory');

Route::get('/producttype/{id}',[HomeController::class,'getProductType'])-> name('getProductType');

Route::post('/input-email',[HomeController::class,'postInputEmail'])->name('postInputEmail');
Route::get('/forgot-password',[HomeController::class,'getInputEmail'])->name('forgotPassword');









// -----------------đăng nhập admin--------------------------
/*------ phần quản trị ----------*/
Route::get('admin/signin',[HomeController::class,'getLoginAdmin'])->name('admin.getLoginAdmin');
Route::post('admin/signin',[HomeController::class,'postLoginAdmin'])->name('admin.postLoginAdmin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
	
		Route::group(['prefix'=>'category'],function(){
	
			//Route::get('danhsach',[ProductController::class,'getCateList'])->name('admin.getCateList');
            Route::get('/danhsach', function () {
  
                return view('admin_product_list');
            });
			// Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
			// Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
			// Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
			// Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
			// Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
		});

		
});