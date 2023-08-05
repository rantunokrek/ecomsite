<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/','FontendController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin','Admin\LoginController@Login');
Route::get('/admin/logout','AdminController@Logout')->name('admin.logout');
// category section
Route::get('admin/categories','Admin\CategoryController@index')->name('admin.category');
Route::post('admin/categories-store','Admin\CategoryController@StoreCat')->name('store.category');
Route::get('admin/categories/edit/{cat_id}','Admin\CategoryController@edit');
Route::get('admin/categories/delete/{cat_id}','Admin\CategoryController@delete');
Route::post('admin/categories/update','Admin\CategoryController@update')->name('update.category');
Route::get('admin/categories/inactive/{cat_id}','Admin\CategoryController@inactive');
Route::get('admin/categories/active/{cat_id}','Admin\CategoryController@active');
//  ===========brand section==============
Route::get('admin/brand','Admin\BrandController@index')->name('admin.brand');
Route::post('admin/brand/store','Admin\BrandController@Store')->name('store.brand');
Route::get('admin/brand/edit/{brand_id}','Admin\BrandController@edit');
Route::get('admin/brand/delete/{brand_id}','Admin\BrandController@delete');
Route::post('admin/brand/update','Admin\BrandController@update')->name('update.brand');
Route::get('admin/brand/inactive/{brand_id}','Admin\BrandController@inactive');
Route::get('admin/brand/active/{brand_id}','Admin\BrandController@active');
//  ==================product section=====================
Route::get('admin/product/add','Admin\ProductController@addProduct')->name('admin.product');
Route::post('admin/product/store','Admin\ProductController@storeProduct')->name('store-products');
Route::get('admin/product/manage','Admin\ProductController@manageProduct')->name('manage-products');

Route::get('admin/product/edit/{proudct_id}','Admin\ProductController@editProduct');
Route::post('admin/product/update','Admin\ProductController@updateProduct')->name('update-products');
Route::post('admin/product/image','Admin\ProductController@updateImage')->name('update-image');
Route::get('admin/product/delete/{product_id}','Admin\ProductController@destroyProduct');
Route::get('admin/product/inactive/{product_id}','Admin\ProductController@inactive');
Route::get('admin/product/active/{product_id}','Admin\ProductController@active');
//  ========= coupon ===========
Route::get('admin/coupon','Admin\CouponController@index')->name('admin.coupon');
Route::post('admin/coupon-store','Admin\CouponController@Store')->name('store.coupon');
Route::get('admin/coupon/edit/{coupon_id}','Admin\CouponController@couponEdit');
Route::post('admin/coupon-update','Admin\CouponController@update')->name('update.coupon');
Route::get('admin/coupon/delete/{coupon_id}','Admin\CouponController@couponDelete');
Route::get('admin/coupon/inactive/{coupon_id}','Admin\CouponController@Inactive');
Route::get('admin/coupon/active/{coupon_id}','Admin\CouponController@Active');
// admin order show
Route::get('admin/ordershow','Admin\AdminOrderShowController@orderIndex')->name('admin.ordershow');
Route::get('admin/ordershow/{order_id}','Admin\AdminOrderShowController@viewOrder');

//  ======= frontend cart ==========
Route::post('cart/add_to_cart/{product_id}','CartController@addToCart');
Route::get('cart','CartController@cartPage');
Route::get('cart/destroy/{cart_id}','CartController@destroy');
Route::post('cart/quantity/update/{cart_id}','CartController@quantityUpdate');

// coupon apply 
Route::post('coupon/apply','CartController@couponApply');
Route::get('coupon/destroy','CartController@coupon_destroy');
// wishList
Route::get('add/to-wishlist/{product_id}','WishListController@addToWishList');
Route::get('wishlist','WishListController@wishPage');
Route::get('wishlist/delete/{wishlist_id}','WishListController@wish_destroy');
// ========= product details =========

Route::get('proudct/details/{product_id}','FontendController@product_details'); 
// shop page show
Route::get('shop','FontendController@shopPage')->name('pages.shop');
// category wise product show
Route::get('category/product-show/{id}','FontendController@catWiseProduct');
//  =======    check out =======
Route::get('checkout','CheckoutController@index');
Route::post('place/order','OrderController@storeOrder')->name('place-order');
Route::get('order/success','OrderController@ordeSuccess');

Route::get('user/order','UserController@order')->name('user.order');
Route::get('user/order-view/{id}','UserController@orderView');