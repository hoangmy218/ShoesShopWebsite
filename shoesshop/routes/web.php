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

// Route::get('/', function () {
//     return view('welcome');
// });

//frontend hoạt động phía user
Route::get('/','HomeController@index');
Route::get('/userLogin','UserController@index');


//backend hoat dong phia server

Route::get('/admin','AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin_dashboard', 'AdminController@dashboard');

//Cart
Route::get('/show-cart','CartController@showCart');

//Checkout
Route::get('/checkout','CheckoutController@checkout');


//Order
Route::get('/manage-order','OrderController@manageOrder');
Route::get('/view-order','OrderController@viewOrder');