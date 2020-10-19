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

Route::get('/admin', 'Admin\LoginController@login')->name('login');

Route::post('/login', 'Admin\LoginController@processlogin')->name('processlogin');
Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
Route::get('/dashboard-view', 'Admin\DashboardController@index')->name('dashboard');

Route::get('/product-view', 'Admin\ProductController@index')->name('product');
Route::post('/product-create', 'Admin\ProductController@store')->name('productcreate');
Route::post('/imageproduct-edit', 'Admin\ProductController@updateimage')->name('productimage-update');
Route::post('/product-update', 'Admin\ProductController@update')->name('product_update');


Route::get('/order-view', 'Admin\OrderController@index')->name('order');
Route::get('/approvement-view', 'Admin\ApprovementpaymentController@index')->name('historyorder');

Route::get('/paymentsetting-view', 'Admin\PaymentSettingController@index')->name('paymentsetting');
Route::post('/paymentsetting-create', 'Admin\PaymentSettingController@store')->name('paymentsetting-create');

Route::get('/grouphargabarang-view', 'Admin\GroupHargaController@index')->name('gouphargabarangpengaturan');
Route::post('/grouphargabarang-create', 'Admin\GroupHargaController@store')->name('gouphargabarangpengaturan-create');




// ------ Bagian Front End ------ //

Route::get('/user', 'User\UserLoginController@index')->name('loginuser');
Route::post('/user/process', 'User\UserLoginController@login')->name('loginuser-process');



Route::get('/search-detail', 'User\HomeController@searchproduct')->name('search-detail');


Route::get('/user/register-view', 'User\UserLoginController@registerview')->name('registeruser');
Route::get('/user/logout', 'User\UserLoginController@logout')->name('logoutuser-process');
Route::get('/', 'User\HomeController@index')->name('home-view');

Route::get('/category/{category_name}', 'User\CategoryStoreController@index')->name('categorystore-view');
Route::get('/cart', 'User\CartController@index')->name('cart-view');
Route::post('/cart/qty-update', 'User\CartController@update')->name('cart-qty-update');
Route::post('/cart-delete', 'User\CartController@delete')->name('cart-delete');
Route::post('/cart-updatedelivery', 'User\CartController@UpdateDelivery')->name('cart-upddelivery');
Route::post('/cart-service-list', 'User\CartController@service')->name('cart-servicelist');
Route::post('/cart-create', 'User\CartController@store')->name('cart-create');


Route::get('/Profile-view', 'User\ProfileController@index')->name('profile-view');
Route::post('/Profile-update', 'User\ProfileController@updateprofile')->name('profile-updateuser');
Route::post('/Profile-updatepwd', 'User\ProfileController@updatepassword')->name('profile-updatepwd');
Route::post('/Profile-createaddress', 'User\ProfileController@storeAddress')->name('profile-createaddress');
Route::post('/Profile-updateaddress', 'User\ProfileController@updateAddress')->name('profile-updaddress');

Route::get('/Approvepayment-view', 'User\ApprovePaymentController@index')->name('approvepaymentview');
Route::post('/Approvepayment-create', 'User\ApprovePaymentController@Uploadimage')->name('approvepayment-create');


Route::get('/Process-view', 'User\ProcessController@index')->name('process-view');

Route::get('/acceptdecline-view', 'User\AcceptDeclineController@index')->name('acceptdecline-view');


Route::get('/{id_product}', 'User\DetailProductController@index')->name('detailproduct-view');
Route::post('/totalprice', 'User\DetailProductController@totalprice')->name('totalprice');
Route::post('/add-cart', 'User\DetailProductController@cartstore')->name('addcart');



// Route::post('/province', )

