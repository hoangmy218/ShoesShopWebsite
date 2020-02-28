<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class OrderController extends Controller
{
	 public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function showOrder()
    {
    	$this->authLogin();
    	return view('admin.manage_order');
    }

    public function viewOrder()
    {
    	$this->authLogin();
    	return view('admin.view_order');
    }
}
