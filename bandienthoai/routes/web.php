<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['checkAdmin']], function () {
    Route::get('admin', 'Admin\DashboardController@index');
    Route::resource('admin/category', 'Admin\CategoryController');
    Route::resource('admin/group', 'Admin\GroupController');
    Route::resource('admin/product', 'Admin\ProductController');
    Route::resource('admin/order', 'Admin\OrderController');
    Route::resource('admin/slide', 'Admin\SlideController');
});

Route::get('/', 'PageController@index')->name('home_page');
Route::get('productDetails/{id}', 'PageController@productDetails')->name('product_details');
Route::get('cart', 'PageController@cart')->name('cart');

Route::get('addCart/{id}', 'CartController@store')->name('add_cart');
Route::patch('updateCart/{id}', 'CartController@update')->name('update_cart');
Route::delete('deleteCart/{id}', 'CartController@destroy')->name('delete_cart');

Route::get('dangky', 'PageController@getRegister')->name('dang_ky');
Route::post('dangky', 'PageController@postRegister')->name('dang_ky');

Route::get('dangnhap', 'PageController@getLogin')->name('dang_nhap');
Route::post('dangnhap', 'PageController@postLogin')->name('dang_nhap');

Route::get('dangxuat', 'PageController@dangXuat')->name('dang_xuat');

Route::get('order', 'PageController@getOrder')->name('order');
Route::post('order', 'PageController@PostOrder')->name('order');

Route::get('promotion', 'PageController@promotion')->name('promotion');

Route::get('search', 'PageController@search')->name('search');

Route::get('contact', 'PageController@contact')->name('contact');