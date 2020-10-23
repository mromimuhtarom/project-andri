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

Route::middleware('authloginadmin')->group(function(){
    Route::group(['prefix' => 'Admin'], function() {
        Route::get('/logout', 'Admin\LoginController@logout')->name('logout');
        Route::group(['prefix' => 'Dashboard'], function() {
            Route::get('/dashboard-view', 'Admin\DashboardController@index')->name('dashboard');
        });

        Route::group(['prefix' => 'Product'], function() {
            Route::get('/product-view', 'Admin\ProductController@index')->name('product');
            Route::post('/product-create', 'Admin\ProductController@store')->name('productcreate');
            Route::post('/imageproduct-edit', 'Admin\ProductController@updateimage')->name('productimage-update');
            Route::post('/product-update', 'Admin\ProductController@update')->name('product_update');
        });

        Route::group(['prefix' => 'Orders'], function(){
            Route::group(['prefix' => 'Customer-Orders'], function() {
                Route::get('/order-view', 'Admin\OrderController@index')->name('Customer-Orders');
                Route::get('/order-serach', 'Admin\OrderController@search')->name('order-search');
            });

            Route::group(['prefix' => 'Approvement-Payment'], function() {
                Route::get('/approvement-view', 'Admin\ApprovementpaymentController@index')->name('Approvement-Payment');
                Route::post('/approvement-accept', 'Admin\ApprovementpaymentController@acceptprovement')->name('approvement-accept');
                Route::post('approvement-decline', 'Admin\ApprovementpaymentController@declineapprovement')->name('approvement-decline');
            });
        });

        Route::group(['prefix' => 'Settings'], function(){
            Route::group(['prefix' => 'Payment-Setting'], function() {
                Route::get('/paymentsetting-view', 'Admin\PaymentSettingController@index')->name('Payment-Setting');
                Route::post('/paymentsetting-create', 'Admin\PaymentSettingController@store')->name('Payment-Setting-create');
                Route::delete('paymentsetting-delete', 'Admin\PaymentSettingController@delete')->name('Payment-Setting-delete');
            });

            Route::group(['prefix' => 'Price-Group'], function() {
                Route::get('/pricegroup-view', 'Admin\GroupHargaController@index')->name('Price-Group');
                Route::post('/pricegroup-create', 'Admin\GroupHargaController@store')->name('Price-Group-create');
                Route::delete('/pricegroup-delete', 'Admin\GroupHargaController@delete')->name('Price-Group-delete');
            });
        });
    });
});



    // ------ Bagian Front End ------ //


Route::group(['prefix' => 'User'], function(){
    Route::post('/process', 'User\UserLoginController@login')->name('loginuser-process');
    Route::get('/register-view', 'User\UserLoginController@registerview')->name('registeruser');
    Route::post('/register-create', 'User\UserLoginController@storeRegister')->name('registeruser-create');
    Route::get('/city-view', 'User\UserLoginController@city')->name('city-view');
    Route::get('/login', 'User\UserLoginController@index')->name('loginuser');
});

Route::group(['prefix' => 'Home'], function(){
    Route::get('/', 'User\HomeController@index')->name('home-view');   
    Route::get('/{id_product}', 'User\DetailProductController@index')->name('detailproduct-view');
    Route::post('/totalprice', 'User\DetailProductController@totalprice')->name('totalprice');
    Route::post('/add-cart', 'User\DetailProductController@cartstore')->name('addcart');
    Route::get('/category/{category_name}', 'User\CategoryStoreController@index')->name('categorystore-view');
});

Route::middleware('authloginuser')->group(function(){
    
    Route::get('/search-detail', 'User\HomeController@searchproduct')->name('search-detail');


    Route::group(['prefix' => 'Profile'], function() {
        Route::get('/Profile-view', 'User\ProfileController@index')->name('profile-view');
        Route::post('/Profile-update', 'User\ProfileController@updateprofile')->name('profile-updateuser');
        Route::post('/Profile-updatepwd', 'User\ProfileController@updatepassword')->name('profile-updatepwd');
        Route::post('/Profile-createaddress', 'User\ProfileController@storeAddress')->name('profile-createaddress');
        Route::post('/Profile-updateaddress', 'User\ProfileController@updateAddress')->name('profile-updaddress');
        Route::delete('Profile-deleteaddress', 'User\ProfileController@deleteAddress')->name('profile-deladdress');
    });

    Route::group(['prefix' => 'Cart'], function() {
        Route::group(['prefix' => 'Cart-Main'], function(){
            Route::get('/cart', 'User\CartController@index')->name('cart-view');
            Route::post('/cart/qty-update', 'User\CartController@update')->name('cart-qty-update');
            Route::post('/cart-delete', 'User\CartController@delete')->name('cart-delete');
            Route::post('/cart-updatedelivery', 'User\CartController@UpdateDelivery')->name('cart-upddelivery');
            Route::post('/cart-service-list', 'User\CartController@service')->name('cart-servicelist');
            Route::post('/cart-create', 'User\CartController@store')->name('cart-create');
        });

        Route::group(['prefix' => 'Approvement-Payment'], function(){
            Route::get('/Approvepayment-view', 'User\ApprovePaymentController@index')->name('approvepaymentview');
            Route::post('/Approvepayment-create', 'User\ApprovePaymentController@Uploadimage')->name('approvepayment-create');
        });

        Route::group(['prefix' => 'Process'], function(){
            Route::get('/Process-view', 'User\ProcessController@index')->name('process-view');
        });

        Route::group(['prefix' => 'Accept-Decline'], function(){
            Route::get('/acceptdecline-view', 'User\AcceptDeclineController@index')->name('acceptdecline-view');
        });
    });


    

    


    
    Route::get('/user/logout', 'User\UserLoginController@logout')->name('logoutuser-process');
});

// Route::post('/province', )

