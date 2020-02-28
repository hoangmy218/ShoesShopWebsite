<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
     public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addProduct(){
        $this->authLogin();
        $list_brand = DB::table("danhmuc")->orderby('dm_ma','desc')->get();
        $list_cate = DB::table("thuonghieu")->orderby('th_ma','desc')->get();
        return view('admin.add_product')->with('list_cate',$list_cate)->with('list_brand',$list_brand);
    	
    }

    public function saveProduct(Request $request){

        $data = array();
        $data['sp_ten'] = $request->pro_name;
        $data['sp_donGiaBan'] = $request->pro_price;
        $data['sp_ghiChu'] = $request->pro_note;
        $data['th_ma'] = $request->pro_brand;
        $data['dm_ma'] = $request->pro_cate;
       

        //up 1 image
        $get_image = '';
        if ($request->hasFile('product_image')){
            $this->validate($request,
                                ['product_image'=>'mimes:jpg,jpeg,png,gif|max:2048',
                                ],
                                ['product_image.mimes'=>'Only accept jpg, jpeg, png, gif.',
                                 'product_image.max'=>'Max file size: 2MB.',
                                ]
                            );

            $product_image = $request->file('product_image');
            if ($product_image){
                $get_image = $product_image->getClientOriginalName();
                $destinationPath = public_path('upload/product');
                $product_image->move($destinationPath, $get_image);
                $data_img = array();
                
                $data_img['sp_ma'] = DB::table('sanpham')->insertGetId($data);               
                $data_img['ha_ten']=$get_image;
                DB::table('hinhanh')->insert($data_img);
                Session::put('message','The product was added successfully.');
                return Redirect::to('/manage-product');
            }
            
            
        }
        $data['pro_image']=$get_image;
        DB::table('sanpham')->insert($data);
        Session::put('message','The product was added successfully.');
        return Redirect::to('/manage-product');
    }


    public function showProduct(){
        $this->authLogin();
        
    	$list_products = DB::table('sanpham')->join('thuonghieu','sanpham.th_ma','=','thuonghieu.th_ma')->join('danhmuc','danhmuc.dm_ma','=','sanpham.dm_ma')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->get();
        /*echo "<pre>";
        print_r($list_products);
        echo "</pre>";*/
    	$manager_product = view('admin.manage_product')->with('list_pro', $list_products);
    	return view('admin_layout')->with('admin.manage_product', $manager_product);
    }

    public function detail_product(){
        return view('pages.product.show_detail');
    }
}
