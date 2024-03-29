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

use App\Http\Controllers\AdminController;

//add index
Route::get('/', 'IndexController@index');
Route::match(['get','post'],'/admin','AdminController@login');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/dashboard','AdminController@dashboard');
Route::get('/admin/setting','AdminController@setting');
Route::get('/admin/check-pwd','AdminController@chkPassword');
Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
//add banner
Route::match(['get','post'],'/admin/add-banner','BannersController@addBanner');
Route::match(['get','post'],'/admin/edit-banner/{id}','BannersController@editBanner');
Route::get('admin/view-banner','BannersController@viewBanner');
Route::get('/admin/delete-banner/{id}','BannersController@deleteBanner');
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
Route::get('admin/view-coupons','CouponsController@viewCoupons');

Route::get('/logout','AdminController@logout');
