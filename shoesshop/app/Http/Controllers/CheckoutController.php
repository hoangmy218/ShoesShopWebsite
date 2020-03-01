<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function checkout()
    {
    	$ma_vanchuyen=DB::table('vanchuyen')->orderby('vc_ma', 'desc')->get();
    	return view("pages.checkout.checkout")->with('ma_vanchuyen', $ma_vanchuyen);
    }

    public function save_checkout_customer(Request $request){
   
        $nd_id = Session::get('nd_ma');
        $time= Carbon::now('Asia/Ho_Chi_Minh');//lấy luôn giờ phút giây
        $dh_ngayDat=$time->toDateString();// chỉ lấy ngày
        Session::put('dh_tenNhan', $request->dh_tenNhan);
        Session::put('dh_diaChiNhan', $request->dh_diaChiNhan);
        Session::put('dh_dienThoai', $request->dh_dienThoai);
        Session::put('dh_email', $request->dh_email);
        Session::put('dh_ghiChu', $request->dh_ghiChu);
        Session::put('dh_ngayDat', $request->$dh_ngayDat);
        Session::put('dh_trangThai', 'Chờ xử lý');
        Session::put('dh_tongTien','100000');
        Session::put('vc_ma', $request->vc_ma);
        Session::put('nd_ma', $nd_id);
    	return Redirect::to('payment');
    }

    public function payment()
    {
    	$ma_thanhtoan=DB::table('thanhtoan')->orderby('tt_ma', 'desc')->get();
    	return view("pages.checkout.payment")->with('ma_thanhtoan', $ma_thanhtoan);
    }
}
