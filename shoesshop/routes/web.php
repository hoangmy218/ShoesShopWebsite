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
Route::get('/register','HomeController@get_register');
Route::post('/postregister', 'HomeController@post_register');
Route::get('/userLogin','HomeController@userLogin');
Route::post('/user_home','HomeController@AfterLogin');
Route::get('/Home_u', 'HomeController@Home_u');
Route::get('/log_out', 'HomeController@log_out');

Route::group(['prefix'=>'User', 'middleware'=>'UserRole_Name'],function(){


});

/*
Route::get('/userLogin','UserController@userLogin');
Route::post('/user_home','UserController@AfterLogin');
Route::get('/log_out', 'UserController@log_out');
Route::get('/Home_u', 'UserController@Home_u');*/


//User
/*Route::get('/register','UserController@get_register');
Route::get('/checkout','UserController@gcheckout');*/
/*
Route::post('/postregister', 'UserController@post_register');*/

//Product
Route::get('/product-detail/{product_id}','ProductController@details_product');//Tiên


Route::get('/all-product','ProductController@all_product');//Tiên



//MY - select Size Stock
Route::get('/index','StockController@index');
/*Route::get('/getStock/{id}','StockController@getStock');*/
Route::get('/getStock','StockController@getStock');
Route::post('/getAmount','StockController@getAmount');

/*BACKEND hoat dong phia server*/

Route::get('/admin','AdminController@index');
Route::get('/dashboard', 'AdminController@show_dashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin_dashboard', 'AdminController@dashboard');

Route::group(['prefix'=>'Admin', 'middleware'=>'AdminRole_Name'],function()   {
	
});

//Cart
Route::get('/show-cart','CartController@showCart');
Route::get('/delete-to-cart/{rowId}','CartController@delete_to_cart');//Tien
Route::post('/update-cart-quantity','CartController@update_cart_quantity');//Tien
Route::get('/update-qty/{id}','CartController@update_qty');//My
Route::post('/save-cart','CartController@save_cart');//Tien


//Checkout
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save-checkout-customer', 'CheckoutController@save_checkout_customer');
Route::get('/payment','CheckoutController@payment');
Route::post('/order-place','CheckoutController@orderPlace');


//Order
Route::get('/manage-order','OrderController@showOrder');
Route::get('/view-order','OrderController@viewOrder');


//Brand
Route::get('/manage-brand','BrandController@showBrand');
Route::get('/add-brand','BrandController@addBrand');
Route::post('/save-brand','BrandController@saveBrand');

	//Tien
Route::get('/edit-brand-product/{brand_product_id}','BrandController@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandController@delete_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandController@update_brand_product');


//Category
Route::get('/manage-category','CategoryController@showCategory');
Route::get('/add-category','CategoryController@addCategory');
Route::post('/save-category','CategoryController@saveCategory');

	//NGAN

Route::get('/edit-category/{category_id}','CategoryController@editCategory');
Route::get('/delete-category/{category_id}','CategoryController@deleteCategory');

Route::post('/update-category/{category_id}','CategoryController@updateCategory');


//Product
Route::get('/manage-product','ProductController@showProduct');
Route::get('/add-product','ProductController@addProduct');
Route::post('/save-product','ProductController@saveProduct');

//Lan
Route::get('/chinhsua-sanpham/{chinhsua_sp_ma}','ProductController@chinhsua_sanpham');
Route::post('/capnhat-sanpham/{chinhsua_sp_ma}','ProductController@capnhat_sanpham');

//Goods-Receipt
Route::get('/add-goods-receipt','ProductController@addGoodsReceipt');
Route::post('/save-goods-receipt','ProductController@saveGoodsReceipt');


//Phuong thuc thanh toan
Route::get('/manage-pay','PayController@manage_pay');
Route::get('/add-pay','PayController@add_pay');
Route::post('/save-pay','PayController@save_pay');
Route::get('/edit-pay/{edit_id}','PayController@edit_pay');
Route::post('/update-pay/{update_id}','PayController@update_pay');
Route::get('/delete-pay/{delete_id}','PayController@delete_pay');

//transport hình thức vận chuyển
Route::get('/manage-transport','TransportController@manage_transport');
Route::get('/add-transport','TransportController@add_transport');
Route::post('/save-transport','TransportController@save_transport');
Route::get('/edit-transport/{edit_id}','TransportController@edit_transport');
Route::post('/update-transport/{update_id}','TransportController@update_transport');
Route::get('/delete-transport/{delete_id}','TransportController@delete_transport');


