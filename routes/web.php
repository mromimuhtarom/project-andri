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

Route::get('/admin', 'LoginController@login')->name('login');

Route::post('/login', 'LoginController@processlogin')->name('processlogin');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/dashboard-view', 'DashboardController@index')->name('dashboard');

Route::get('/product-view', 'ProductController@index')->name('product');
Route::post('/product-create', 'ProductController@store')->name('productcreate');
Route::post('/imageproduct-edit', 'ProductController@updateimage')->name('productimage-update');
Route::post('/product-update', 'ProductController@update')->name('product_update');


Route::get('/order-view', 'OrderController@index')->name('order');
Route::get('/historyorder-view', 'HistoryOrderController@index')->name('historyorder');

Route::get('/paymentsetting-view', 'PaymentSettingController@index')->name('paymentsetting');
Route::post('/paymentsetting-create', 'PaymentSettingController@store')->name('paymentsetting-create');

Route::get('/grouphargabarang-view', 'GroupHargaController@index')->name('gouphargabarangpengaturan');
Route::post('/grouphargabarang-create', 'GroupHargaController@store')->name('gouphargabarangpengaturan-create');




// ------ Bagian Front End ------ //

Route::get('/user', 'UserLoginController@index')->name('loginuser');
Route::post('/user/process', 'UserLoginController@login')->name('loginuser-process');

Route::get('/user/register-view', 'UserLoginController@registerview')->name('registeruser');
Route::get('/user/logout', 'UserLoginController@logout')->name('logoutuser-process');
Route::get('/', 'HomeController@index')->name('home-view');

Route::get('/category/{category_name}', 'CategoryStoreController@index')->name('categorystore-view');
Route::get('/cart', 'CartController@index')->name('cart-view');
Route::post('/cart/qty-update', 'CartController@update')->name('cart-qty-update');
Route::post('/cart-delete', 'CartController@delete')->name('cart-delete');


Route::get('/Profile-view', 'ProfileController@index')->name('profile-view');
Route::post('/profile-update', 'ProfileController@updateprofile')->name('profile-updateuser');
Route::post('/profile-updatepwd', 'ProfileController@updatepassword')->name('profile-updatepwd');
Route::post('/profile-createaddress', 'ProfileController@storeAddress')->name('profile-createaddress');
Route::post('/profile-updateaddress', 'ProfileController@updateAddress')->name('profile-updaddress');
// Route::post('/province', )

