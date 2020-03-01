<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function showCart()
    {
    	return view("pages.cart.show_cart");
    }

     // Tien 
    public function save_cart(Request $request){
    	$id= $request->size;
    	$soluong = $request->qty;

    	$ctsp = DB::table('chitietsanpham')->where('ctsp_id',$id)->first();

    	$ma_sanpham = $ctsp->sp_ma;

    
    	$sanpham = DB::table('sanpham')->where('sp_ma',$ma_sanpham)->first(); 

        $hinhanh= DB::table('hinhanh')->where('ha_ma',$sanpham->sp_ma)->first(); 

		$data= array();
    	$data['id'] = $id;
        $data['qty'] = $soluong;
        $data['name'] = $sanpham->sp_ten;
        $data['price'] = $sanpham->sp_donGiaBan;
        $data['weight'] = 0;
        $data['options']['image'] = $hinhanh->ha_ten;
        $data['options']['size'] = $ctsp->ctsp_kichCo;
  
        // return view("pages.cart.show_cart");
		Cart::add($data);
        // Cart::destroy();
   		return Redirect::to('/show-cart');
    }// Tien 
    
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    // Tien 
    
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }

}
