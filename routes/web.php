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

Route::get('/', 'LoginController@login')->name('login');
Route::post('/login', 'LoginController@processlogin')->name('processlogin');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/dashboard-view', 'DashboardController@index')->name('dashboard');
Route::get('/product-view', 'ProductController@index')->name('product');
Route::post('/product-create', 'ProductController@store')->name('productcreate');
Route::post('/imageproduct-edit', 'ProductController@updateimage')->name('productimage-update');
Route::get('/order-view', 'OrderController@index')->name('order');
Route::get('/historyorder-view', 'HistoryOrderController@index')->name('historyorder');
Route::get('/paymentsetting-view', 'PaymentSettingController@index')->name('paymentsetting');
Route::get('/grouphargabarang-view', 'GroupHargaController@index')->name('gouphargabarangpengaturan');

