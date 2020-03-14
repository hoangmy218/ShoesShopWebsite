<?php

namespace App\Http\Controllers;
use PDF;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Dompdf\Dompdf;
use Dompdf\Options;


class PdfController extends Controller
{
	 public function authLogin(){
        $admin_id = Session::get('nd_ma');
        if ($admin_id) 
            return Redirect::to('/dashboard'); 
        else 
            return Redirect::to('/admin')->send();
    }

    public function createOrderPdf($dh_ma)
    {
    	$this->authLogin();
        $order = DB::table('donhang')->join('nguoidung','nguoidung.nd_ma','donhang.nd_ma')->join('thanhtoan','thanhtoan.tt_ma','donhang.tt_ma')->join('vanchuyen','vanchuyen.vc_ma','donhang.vc_ma')->where('donhang.dh_ma','=',$dh_ma)->first();
        $items = DB::table('chitietdonhang')->join('chitietsanpham','chitietsanpham.ctsp_ma','chitietdonhang.ctsp_ma')->join('sanpham','sanpham.sp_ma','chitietsanpham.sp_ma')->where('dh_ma',$dh_ma)->get();

        

        $pdf = PDF::loadView('admin.order_pdf', compact('order', 'items'));
        return $pdf->download('order'.$dh_ma.'.pdf');
    }
}
