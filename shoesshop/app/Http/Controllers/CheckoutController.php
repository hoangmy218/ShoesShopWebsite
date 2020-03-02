<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use Carbon\Carbon;
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
        Session::put('dh_ngayDat', $dh_ngayDat);
        /*Session::put('dh_trangThai', 'Chờ xử lý');*/
        // Session::put('dh_tongTien','100000');
        Session::put('vc_ma', $request->vc_ma);
        $vanchuyen=DB::table('vanchuyen')->where('vc_ma',$request->vc_ma)->first();
        Session::put('vc_ten', $vanchuyen->vc_ten);
        Session::put('vc_phi', $vanchuyen->vc_phi);
    	return Redirect::to('payment');
    }

    public function payment()
    {
        $ma_vanchuyen=DB::table('vanchuyen')->orderby('vc_ma', 'desc')->get();
    	$ma_thanhtoan=DB::table('thanhtoan')->orderby('tt_ma', 'desc')->get();
    	return view("pages.checkout.payment")->with('ma_thanhtoan', $ma_thanhtoan)->with('ma_vanchuyen', $ma_vanchuyen);
    }

     public function orderPlace(Request $request)
    {
        //them don hang



        $data = array();
        $data['dh_tenNhan'] = Session::get('dh_tenNhan');
        $data['dh_diaChiNhan'] = Session::get('dh_diaChiNhan');
        $data['dh_dienThoai'] = Session::get('dh_dienThoai');
        $data['dh_email'] = Session::get('dh_email');
        $data['dh_ghiChu'] = Session::get('dh_ghiChu');
        $data['dh_ngayDat'] = Session::get('dh_ngayDat');
        $data['dh_trangThai'] = 'Chờ xử lý';
        $data['dh_tongTien'] =  (int)Session::get('dh_tongTien');
        $data['vc_ma'] = Session::get('vc_ma');
        $data['tt_ma'] = $request->optradio;
        $data['nd_ma'] = Session::get('nd_ma');


        $insert_donhang_id = DB::table('donhang')->insertGetId($data);

        //insert chi tiet don hang

        $content = Cart::content(); 
        foreach ($content as $v_content) {
            $order_detail_data = array();
            $order_detail_data['dh_ma'] = $insert_donhang_id; 
            $order_detail_data['ctsp_ma'] = $v_content->id;
            $order_detail_data['soLuongDat'] = $v_content->qty;
            $order_detail_data['thanhTien'] = $v_content->qty*$v_content->price;            
            $insert_orderdetail_id = DB::table('chitietdonhang')->insertGetId($order_detail_data);
        }

        if (Session::get('vc_ma') == 1){
            Cart::destroy();
            return view('pages.checkout.handcash');
        }
            
    }
}
