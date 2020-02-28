<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandController extends Controller
{
     public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function addBrand(){
        $this->authLogin(); 
    	return view('admin.add_brand');
    }

    public function saveBrand(Request $request)
    {
        $data = array();
        $data['th_ma'] = $request->brand_ma;
        $data['th_ten'] = $request->brand_name;
        Db::table('thuonghieu')->insert($data);
        Session::put('message','The brand was added successfully.');
        return Redirect::to('/manage-brand');
    }

    public function showBrand(){
        $this->authLogin();
    	$list_brands = DB::table('thuonghieu')->get();
    	$manager_brand = view('admin.manage_Brand')->with('list_brands', $list_brands);
    	return view('admin_layout')->with('admin.manage_Brand', $manager_brand);
    	/*return view('admin.manage_Brand');*/
    }
}
