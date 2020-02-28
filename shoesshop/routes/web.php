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

//FRONTEND hoạt động phía user
Route::get('/','HomeController@index');


Route::get('/userLogin','UserController@index');
Route::post('/user_home','UserController@AfterLogin');
Route::get('/log_out', 'UserController@logout');
Route::get('/Home_u', 'UserController@Home_u');


//User
Route::get('/register','UserController@get_register');
Route::get('/checkout','UserController@gcheckout');

Route::post('/postregister', 'UserController@post_register');

//Product
Route::get('/product-detail','ProductController@detail_product');



/*BACKEND hoat dong phia server*/

Route::get('/admin','AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin_dashboard', 'AdminController@dashboard');



//Cart
Route::get('/show-cart','CartController@showCart');

//Checkout
Route::get('/checkout','CheckoutController@checkout');


//Order
Route::get('/manage-order','OrderController@showOrder');
Route::get('/view-order','OrderController@viewOrder');


//Brand
Route::get('/manage-brand','BrandController@showBrand');
Route::get('/add-brand','BrandController@addBrand');
Route::post('/save-brand','BrandController@saveBrand');

//Category
Route::get('/manage-category','CategoryController@showCategory');
Route::get('/add-category','CategoryController@addCategory');
Route::post('/save-category','CategoryController@saveCategory');


//Product
Route::get('/manage-product','ProductController@showProduct');
Route::get('/add-product','ProductController@addProduct');
Route::post('/save-product','ProductController@saveProduct');