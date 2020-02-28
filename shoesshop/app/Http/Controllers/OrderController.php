<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function manageOrder()
    {
    	return view('admin.manage_order');
    }

    public function viewOrder()
    {
    	return view('admin.view_order');
    }
}
