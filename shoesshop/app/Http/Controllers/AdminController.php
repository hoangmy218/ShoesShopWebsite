<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
session_start();

class AdminController extends Controller
{
    
    public function authLogin(){
        $admin_id = Session::get('admin_id');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function index()
    {
    	return view('admin_login');
    }

    public function show_dashboard(){
       /* $this->authLogin();*/
    	return view('dashboard');
    }

    public function dashboard(Request $request){

        $this->validate($request, [
            'admin_email'=>'required',
            'admin_password'=>'required|min:6|max:28'
            ],[
            'admin_email.required'=>'Bạn chưa nhập Email',
            'admin_password.required'=>'Bạn chưa nhập Password',
            'admin_password.min'=>'Password không nhỏ hơn 3 ký tự',
            'admin_password.max'=>'Password không lớn hơn 28 ký tự']);
        // if (Auth::attempt(['email'=>$request->admin_email, 'password'=>$request->admin_password]))
        // {
            $admin_email = $request->admin_email;
            $admin_password = md5($request->admin_password);

            $result = DB::table('tbl_admin')->where('admin_email', $admin_email)->where('admin_password',$admin_password)->first();
            /*echo '<pre>';
            print_r($result);
            echo '</pre>';*/
            /*return view('admin.dashboard');*/
            if ($result) {
                Session::put('admin_name', $result->admin_name);
                Session::put('admin_id',$result->admin_id);
                return Redirect::to('/dashboard');
            }else {
                Session::put('message','Email or Password is wrong. Please try again.');
                return Redirect::to('/admin');
            }
        //}
        
    	
    }
   
}
