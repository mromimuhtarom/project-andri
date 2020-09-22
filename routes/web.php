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
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/product', 'ProductController@index')->name('product');
Route::get('/order', 'OrderController@index')->name('order');
