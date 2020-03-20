<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
use Cart;
use App\Comment;

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
       
        if($request->hasFile('product_image')) {
            $sp_ma = DB::table('sanpham')->insertGetId($data);
                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->product_image as $photo) {
                    $get_image = $photo->getClientOriginalName();
                    $destinationPath = public_path('upload/product');
                    $photo->move($destinationPath, $get_image);
                    $data_img = array();
                    $data_img['sp_ma']=$sp_ma;
                    $data_img['ha_ten']=$get_image;
                    DB::table('hinhanh')->insert($data_img);
                }
                Session::put('message','Thêm sản phẩm thành công!');
                return Redirect::to('/manage-product');
        }

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
 
    public function details_product($product_id){


        $content = Cart::content();

        $details_product = DB::table('sanpham')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->where('sanpham.sp_ma',$product_id)->get(); 
        $sz_product = DB::table('chitietsanpham')->where('chitietsanpham.sp_ma',$product_id)->get(); 

        $all_product = DB::table('sanpham')->select('sp_ma')->where('sanpham.sp_ma',$product_id)->limit(1)->get(); //Tiên 14/03

   
        $sizes = DB::Table('chitietsanpham')->select('ctsp_kichCo','ctsp_soLuongTon','ctsp_ma')->where('chitietsanpham.sp_ma',$product_id)->get(); // Tiên 12/03
        
        $sold_product=DB::table('chitietdonhang')->join('chitietsanpham','chitietsanpham.ctsp_ma','=','chitietdonhang.ctsp_ma')->where('chitietsanpham.sp_ma',$product_id)->select('soLuongDat')->sum('soLuongDat'); //Tien 18/03

        $comments = Comment::where('sp_ma',$product_id)->get(); // Tiên 14/03

        $total_view=DB::table('binhluan')->join('sanpham','sanpham.sp_ma','=','binhluan.sp_ma')->where('binhluan.sp_ma',$product_id)->select('sp_ma')->count();

         return view('pages.product.show_detail',compact('chitietsanpham'))->with('details_product',$details_product)->with('sz_product',$sz_product)->with('sizes',$sizes)->with('all_product',$all_product)->with('comments',$comments)->with('sold_product',$sold_product)->with('total_view',$total_view);
    }


    //GOODS RECEIPT MY
    public function addGoodsReceipt()
    {
        $this->authLogin();     
        $list_products = DB::table('sanpham')->orderby('sp_ma','desc')->get();
        return  view('admin.add_receipt')->with('list_pro', $list_products);
    }

    public function saveGoodsReceipt(Request $request)
    {
        $data = array();
        $data = $request->all();
        $datapn = array();
        /*
        $datapn['pn_ngayNhap']=$request->ngayNhap;*/
        $dateTime = Carbon::parse($request->ngayNhap);

        $datapn['pn_ngayNhap'] = $dateTime->format('Y-m-d');
        $pn_id = DB::table('phieunhap')->insertGetId($datapn);

        foreach($data['group-a'] as $pro){
             $datasp = array($pro);
             $insert_data[] = $datasp;
        }
  
         $count = count($insert_data);
         /*echo $count.'count <br>';*/
         $masp = array();
        for ($i=0; $i<$count; $i++){
            $insert_datapro = $insert_data[$i];
             $count_i = count($insert_datapro);
            for ($y=0; $y<$count_i; $y++){
                $insert_datadetail = $insert_datapro[$y];
                $masp[$i+1] = $insert_datadetail['masp'];
                $data_ctsp = array();
                $data_ctsp['sp_ma']= $insert_datadetail['masp'];
                $data_ctsp['ctsp_kichCo']= $insert_datadetail['kichCo'];
                $data_ctsp['ctsp_soLuongNhap'] = $insert_datadetail['soLuongNhap'];
                $data_ctsp['ctsp_soLuongTon'] =  $insert_datadetail['soLuongNhap'];
                $data_ctsp['pn_ma'] = $pn_id;
                DB::table('chitietsanpham')->insertGetId($data_ctsp);
               

            }   
        }
        $list_products = DB::table('sanpham')->whereIn('sp_ma',$masp)->orderby('sanpham.sp_ma','desc')->get();        
        return view('admin.add_price_receipt')->with('list_pro', $list_products)->with('ma_pn',$pn_id);
            
    }

    public function savePriceReceipt(Request $request)
    {
         $data = array();
        $data = $request->all();
        /*echo "<pre>"; print_r($data); echo '</pre>';
        echo "<br>";*/
        $dataSP = array();
        $i=0;
        foreach($data['sp_ma'] as $key => $pro){
             $dataSP[$i] = $pro;       
             $i++;
        }
  
        $count = count($dataSP);
/*          echo $count.'count dataSP <br>';
          echo "<pre>"; print_r($data['sp_ma']); echo '</pre><br>';
          echo '<br>array insert_dataSP<br>';
          echo "<pre>"; print_r($dataSP); echo '</pre><br>';*/
          /*echo '<br> array dataSP <br>';
          foreach ($dataSP as $key => $value) {
              echo $value.' SP_MA<br>';
          }*/

        $dataGN = array();
        $i=0;
        foreach($data['giaNhap'] as $key => $pro){
             $dataGN[$i] = $pro;       
             $i++;
        }
        $dataGB = array();
        $i=0;
        foreach($data['giaBan'] as $key => $pro){
             $dataGB[$i] = $pro;       
             $i++;
        }

        $data_price_pro = array();
        for ($i=0; $i<$count; $i++){
            $data_price_pro['sp_donGiaNhap'] =$dataGN[$i];
            $data_price_pro['sp_donGiaBan'] = $dataGB[$i];
           /* echo '<br>array data_price_pro SP_MA'.$dataSP[$i].'<br>' ;
            echo "<pre>"; print_r($data_price_pro); echo '</pre><br>';*/
            DB::table('sanpham')->where('sp_ma',$dataSP[$i])->update($data_price_pro);
        }
        return Redirect::to('/manage-product');
    }

    public function showGoodsReceipt()
    {

        /*$list_receipts = DB::table('phieunhap')->join('chitietsanpham','chitietsanpham.pn_ma','=','phieunhap.pn_ma')->select('phieunhap.*',DB::raw("count(chitietsanpham.pn_ma) as count"))->orderby('pn_ma','desc')->groupBy('chitietsanpham.pn_ma')->get();  */

        $list_receipts = DB::table('chitietsanpham')->join('phieunhap','chitietsanpham.pn_ma','=','phieunhap.pn_ma')->select('phieunhap.*',DB::raw("count(chitietsanpham.pn_ma) as count"))->orderby('chitietsanpham.pn_ma','desc')->groupBy('chitietsanpham.pn_ma')->get();        
        return view('admin.manage_goods_receipt')->with('list_receipts', $list_receipts);
    }

    public function viewReceiptDetails($pn_ma)
    {
        $receipt_detail = DB::table('phieunhap')->join('chitietsanpham','chitietsanpham.pn_ma','=','phieunhap.pn_ma')->join('sanpham','sanpham.sp_ma','=','chitietsanpham.sp_ma')->where('phieunhap.pn_ma',$pn_ma)->orderby('chitietsanpham.ctsp_ma','desc')->get();
        $receipt = DB::table('phieunhap')->where('pn_ma',$pn_ma)->first();
        $list_products = DB::table('sanpham')->join('thuonghieu','sanpham.th_ma','=','thuonghieu.th_ma')->join('danhmuc','danhmuc.dm_ma','=','sanpham.dm_ma')->join('hinhanh','hinhanh.sp_ma','=','sanpham.sp_ma')->orderby('sanpham.sp_ma','desc')->get();   
       
        return view('admin.view_goods_receipt')->with('receipt',$receipt)->with('receipt_detail',$receipt_detail)->with('list_pro', $list_products);
    }

    public function deleteReceipt($pn_ma)
    {
        $this->authLogin();
        try {
            DB::table('chitietsanpham')->where('pn_ma', $pn_ma)->delete();
            DB::table('phieunhap')->where('pn_ma', $pn_ma)->delete(); //Neu doi ctsp cascade thi xoa dong nay
            Session::put('success_message','Xóa phiếu nhập thành công!');
            
        } catch (\Illuminate\Database\QueryException $e) {
            Session::put('fail_message','Xóa phiếu nhập không thành công!');
        }

    }

    public function getDateReceipt(Request $request)
    {
        $receipt_date = DB::Table('phieunhap')->select('pn_ngayNhap')->where('pn_ma',$request->pn_ma)->first(); 
        return json_encode($receipt_date);
    }

    public function saveEditReceipt(Request $request, $pn_ma)
    {
        $this->authLogin();
        
        $date = $request->pn_ngayNhap;
        echo gettype($date);
        $ngayNhap = array();
        $ngayNhap['pn_ngayNhap'] = date('Y-m-d',strtotime($date));
        
        echo $pn_ma;
        try{
            DB::table('phieunhap')->where('pn_ma',$pn_ma)->update($ngayNhap);
            
             Session::put('success_message','Cập nhật phiếu nhập thành công!');
        }catch (\Illuminate\Database\QueryException $e) {
           
            Session::put('fail_message','Cập nhật phiếu nhập không thành công!');
        }
       

    }

    //Edit Goods of Receipt
    public function deleteGoods($ctsp_ma)
    {
        # code...
    }

    public function getDetailGoods(Request $request)
    {
        $receipt_good = DB::Table('chitietsanpham')->join('sanpham','chitietsanpham.sp_ma','=','sanpham.sp_ma')->where('ctsp_ma',$request->ctsp_ma)->select('chitietsanpham.ctsp_ma','sanpham.sp_ma','sanpham.sp_ten','sanpham.sp_donGiaNhap','sanpham.sp_donGiaBan','ctsp_kichCo','ctsp_soLuongNhap')->first(); 
        return json_encode($receipt_good);
    }

    public function saveEditGoods(Request $request, $ctsp_ma)
    {
        $this->authLogin();
        
        $sp_ma = $request->sp_ma;
        // echo gettype($date);
        $dataSP = array();
       /* $ngayNhap['pn_ngayNhap'] = date('Y-m-d',strtotime($date));*/
        $dataSP['sp_donGiaNhap'] = $request->sp_donGiaNhap;
        $dataSP['sp_donGiaBan'] = $request->sp_donGiaBan;
        
        $ctsp_old = DB::table('chitietsanpham')->where('ctsp_ma',$ctsp_ma)->first();
        $dataCTSP = array();
        $dataCTSP['sp_ma']=$sp_ma;
        $dataCTSP['ctsp_kichCo'] = $request->ctsp_kichCo;
        $dataCTSP['ctsp_soLuongNhap'] = $request->ctsp_soLuongNhap;
        $dataCTSP['ctsp_soLuongTon'] = $ctsp_old->ctsp_soLuongTon + $request->ctsp_soLuongNhap - $ctsp_old->ctsp_soLuongNhap;

        try{
            DB::table('sanpham')->where('sp_ma',$sp_ma)->update($dataSP);
            DB::table('chitietsanpham')->where('ctsp_ma',$ctsp_ma)->update($dataCTSP);
            Session::put('success_message','Cập nhật chi tiết sản phẩm nhập thành công!');
        }catch (\Illuminate\Database\QueryException $e) {
           
            Session::put('fail_message','Cập nhật chi tiết sản phẩm nhập không thành công!');
        }
    }

    //Lan
    public function chinhsua_sanpham($chinhsua_sp_ma){
        $this->authLogin();    
        $list_cate = DB::table("danhmuc")->orderby('dm_ma','desc')->get();
        $list_brand = DB::table("thuonghieu")->orderby('th_ma','desc')->get();
        $hinh_anh=DB::table('hinhanh')->where('sp_ma', $chinhsua_sp_ma)->get();
        $edit_pro=DB::table('sanpham')->where('sp_ma',$chinhsua_sp_ma)->get();
       
        // echo $hinh_anh;
        return view('admin.edit_product')->with('edit_pro', $edit_pro)->with('list_brand', $list_brand)->with('list_cate', $list_cate)->with('hinh_anh', $hinh_anh);
    }
    
    public function capnhat_sanpham(Request $request, $chinhsua_sp_ma){
        $data= array();
        $data['sp_ten']=$request->pro_name;
        $data['sp_donGiaNhap']=$request->pro_pricegor;
        $data['sp_donGiaBan']=$request->pro_price;
        $data['sp_ghiChu']=$request->pro_note;
        $data['th_ma']=$request->pro_brand;
        $data['dm_ma']=$request->pro_cate;

        if($request->hasFile('product_image')) {
            DB::table('sanpham')->where('sp_ma', $chinhsua_sp_ma)->update($data);
                // duyệt từng ảnh và thực hiện lưu
                foreach ($request->product_image as $photo) {
                    $get_image = $photo->getClientOriginalName();
                    $destinationPath = public_path('upload/product');
                    $photo->move($destinationPath, $get_image);
                    $data_img = array();
                    $data_img['sp_ma']=$chinhsua_sp_ma;
                    $data_img['ha_ten']=$get_image;
                    DB::table('hinhanh')->insert($data_img);
                }
                Session::put('message','Cập nhật sản phẩm thành công!');
                return Redirect::to('/manage-product');
        }else{
            DB::table('sanpham')->where('sp_ma', $chinhsua_sp_ma)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('/manage-product');
        }
    }



}
