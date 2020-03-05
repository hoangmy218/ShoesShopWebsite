<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function authLogin(){
        $user_id = Session::get('nd_ma');
        $cv=Session::get('cv_ma');
        
        if (($user_id)&&($cv==2)) 
            return Redirect::to('/Home_u'); 
        else 
            return Redirect::to('/')->send();
    }
    public function index()
    {

        // Tiên
        $all_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->limit(4)->get(); 
        return view("pages.home")->with('all_product',$all_product);
    }

     public function userLogin(){
        return view('pages.customer.user_login');
    }

    public function Home_u(){
        $this->authLogin();
        $all_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->limit(4)->get(); 
        return view("pages.home")->with('all_product',$all_product);
    }

    public function get_register(){
        return view('pages.customer.user_register');
    }

    public function post_register(Request $req){
        $data=array();

        $data['nd_ten'] = $req->user_name;
        $data['nd_ngaySinh'] = $req->user_birth;
        $data['nd_email'] = $req->user_email;
        $data['nd_dienThoai'] = $req->user_phone;
        $data['nd_diaChi'] = $req->user_address;
        $data['cv_ma'] = "2"; //Chuc vu Khach hang
        if($req->rdGioitinh=="Male"){
            $data['nd_gioiTinh'] = 0;
        }
        else{
            $data['nd_gioiTinh'] = 1;
        }
        $data['nd_matKhau'] = md5($req->user_password);

        $customer_id = DB::table('nguoidung')->insertGetId($data);

        Session::put('nd_ma',$customer_id);
        Session::put('nd_ten',$req->user_name);
        return Redirect::to('/Home_u');
    }


     public function AfterLogin(Request $request){
        $this->validate($request, [
            'user_email'=>'required',
            'user_password'=>'required|min:3|max:28'
            ],[
            'user_email.required'=>'Bạn chưa nhập Email',
            'user_password.required'=>'Bạn chưa nhập Password',
            'user_password.min'=>'Password không nhỏ hơn 3 ký tự',
            'user_password.max'=>'Password không lớn hơn 28 ký tự']);
        // if (Auth::attempt(['email'=>$request->admin_email, 'password'=>$request->admin_password]))
        // {
            $user_email = $request->user_email; // request trỏ tới tên thẻ
            $user_password = md5($request->user_password);

            $result = DB::table('nguoidung')->where('nd_email', $user_email)->where('nd_matKhau',$user_password)->first();
            /*echo '<pre>';
            print_r($result);
            echo '</pre>';*/
            /*return view('admin.dashboard');*/
            if ($result) {
                Session::put('cv_ma',$result->cv_ma);
                $cv=Session::get('cv_ma');
                if($cv==2){
                    Session::put('nd_ma', $result->nd_ma); // result trỏ tới trường csdl
                    Session::put('nd_ten',$result->nd_ten);
                    Session::put('nd_email',$result->nd_email);
                        return Redirect::to('/Home_u');
                }else{
                    Session::put('message1','Bạn không có quyền truy cập.');
                        return Redirect::to('/userLogin');
                }
            }    
            else {
                
                Session::put('message','Email hoặc mật khẩu không đúng. Vui lòng thử lại');
                return Redirect::to('/userLogin');
            }
            
        //}
    }


    public function log_out(){
        $this->authLogin();
        Session::put('nd_ma',null);
        Session::put('nd_ten',null);
        Session::put('cv_ma',null);
        Session::put('nd_email',null);
        return Redirect::to('/');
       /* return Redirect::to('/userLogin');*/
                //echo "Logout";
    }
}
