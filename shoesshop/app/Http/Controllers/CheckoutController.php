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
     public function authLogin(){
        $user_id = Session::get('nd_ma');
        $cv=Session::get('cv_ma');
        
        if (($user_id)&&($cv==2)) 
            return Redirect::to('/Home_u'); 
        else 
            return Redirect::to('/')->send();
    }

    public function checkout()
    {
        $this->authLogin();
        $this->authLogin();
        $content = Cart::content();
        if ($content->isempty()){
            return Redirect::to('/');
        }else {
        	$ma_vanchuyen=DB::table('vanchuyen')->orderby('vc_ma', 'desc')->get();
        	return view("pages.checkout.checkout")->with('ma_vanchuyen', $ma_vanchuyen);
        }
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
        $this->authLogin();
        $content = Cart::content();
        if ($content->isempty()){
            return Redirect::to('/');
        }else {
            $ma_vanchuyen=DB::table('vanchuyen')->orderby('vc_ma', 'desc')->get();
        	$ma_thanhtoan=DB::table('thanhtoan')->orderby('tt_ma', 'desc')->get();
        	return view("pages.checkout.payment")->with('ma_thanhtoan', $ma_thanhtoan)->with('ma_vanchuyen', $ma_vanchuyen);
        }
    }

     public function orderPlace(Request $request)
    {
        $content = Cart::content(); 
        //them don hang

        if (!$content->isempty()) {

        $data = array();
        $data['dh_tenNhan'] = Session::get('dh_tenNhan');
        $data['dh_diaChiNhan'] = Session::get('dh_diaChiNhan');
        $data['dh_dienThoai'] = Session::get('dh_dienThoai');
        $data['dh_email'] = Session::get('dh_email');
        $data['dh_ghiChu'] = Session::get('dh_ghiChu');
        $data['dh_ngayDat'] = Session::get('dh_ngayDat');
        $data['dh_trangThai'] = 'Chờ xử lý';
        $subtt =(int)Cart::subtotal(2,'.','');
        $data['dh_tongTien'] =  $subtt;
        $data['vc_ma'] = Session::get('vc_ma');
        $data['tt_ma'] = $request->optradio;
        $data['nd_ma'] = Session::get('nd_ma');


       

        //insert chi tiet don hang


        $hethang = 0; //false
        $outstock = array();
        foreach ($content as $v_content) {
             $ctsp_ton =  DB::table('chitietsanpham')->where('ctsp_ma', $v_content->id)->first();
            if ( $v_content->qty > $ctsp_ton->ctsp_soLuongTon){
                $hethang = $hethang+1; //true
                $outstock[$hethang] = $ctsp_ton->sp_ma;
            }
        }
        
        if ($hethang == 0){
            $insert_donhang_id = DB::table('donhang')->insertGetId($data);
            foreach ($content as $v_content) {
                $order_detail_data = array();
                $order_detail_data['dh_ma'] = $insert_donhang_id; 
                $order_detail_data['ctsp_ma'] = $v_content->id;
                $order_detail_data['soLuongDat'] = $v_content->qty;
                $order_detail_data['thanhTien'] = $v_content->qty*$v_content->price;            
                $insert_orderdetail_id = DB::table('chitietdonhang')->insertGetId($order_detail_data);
                $ctsp_ton = DB::table('chitietsanpham')->where('ctsp_ma', $v_content->id)->first();
                DB::table('chitietsanpham')->where('ctsp_ma', $v_content->id)->update(['ctsp_soLuongTon' => $ctsp_ton->ctsp_soLuongTon - $v_content->qty]);
            }
            if ($request->optradio == 1){ //thanh toan tien mat

                Cart::destroy();
                return Redirect::to('/handcash');
            }else{
                Cart::destroy();
                return Redirect::to('/paypal');
            }
        }
        else {
            $tenhang = '';
            foreach ($outstock as $key => $value) {
                $hang = DB::table('sanpham')->where('sp_ma',$value)->select('sp_ten')->first();
                $tenhang .= ' ';
                $tenhang .= $hang->sp_ten;
                if ($key != count($outstock))
                $tenhang .= ',';
            }
            /*$sizes = DB::Table('chitietsanpham')->select('ctsp_kichCo','ctsp_ma')->where('sp_ma',4)->get(); */
       
            Session::put('message','Đặt hàng không thành công! <b>'.$tenhang.'</b> không đủ hàng');
            return view('pages.cart.show_cart');
        }
    }

            
    }

    public function handcash()
    {
        $this->authLogin();
        return view('pages.checkout.handcash');
    }

    public function paypal()
    {
        $this->authLogin();
        return view('pages.checkout.paypal');
    }
}
