<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Cart;
use DB;

class PaymentController extends Controller
{
  //   private $_api_context;

  //   public function __construct()
  //   {
  //   	/** PayPal api context **/
  //       $paypal_conf = \Config::get('paypal');
  //       $this->_api_context = new ApiContext(new OAuthTokenCredential(
  //           $paypal_conf['client_id'],
  //           $paypal_conf['secret'])
  //       );
  //       $this->_api_context->setConfig($paypal_conf['settings']);
  //   }

  //   public function payWithPayPal(Request $request)
  //   {

		// $payer = new Payer();
  //       $payer->setPaymentMethod('paypal');

  //       $content = Cart::content();
		// (double)$rate = 0.000043; 
		// $index = 0;
		// $items = array();
		// foreach($content as $v_content){
		// 	$index++;
		// 	$items[$index] = new Item();
		// 	$items[$index]->setName($v_content->name)
		// 	    ->setCurrency('USD')
		// 	    ->setQuantity($v_content->qty)
		// 	    ->setSku($v_content->id) // Similar to `item_number` in Classic API
		// 	    ->setPrice($v_content->price * $rate);
		// }

		// $itemList = new ItemList();
		// $itemList->setItems($items);
		

		// (int)$phi=Session::get('vc_phi');
		// $subtt =(double)Cart::subtotal(2,'.','');

		// $details = new Details();
		// $details->setShipping(round($phi*$rate))
		//     ->setSubtotal(round($subtt*$rate));

		// $amount = new Amount();
		// $amount->setCurrency("USD")
		//     ->setTotal(($subtt + $phi)*$rate)
		//     ->setDetails($details);

  //       $transaction = new Transaction();
  //       $transaction->setAmount($amount)
  //           ->setItemList($item_list)
  //           ->setDescription('Your transaction description');

  //       $redirect_urls = new RedirectUrls();
  //       $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
  //           ->setCancelUrl(URL::to('status'));

  //       $payment = new Payment();
  //       $payment->setIntent('Sale')
  //           ->setPayer($payer)
  //           ->setRedirectUrls($redirect_urls)
  //           ->setTransactions(array($transaction));
  //       /** dd($payment->create($this->_api_context));exit; **/
  //       try {

  //           $payment->create($this->_api_context);

  //       } catch (\PayPal\Exception\PPConnectionException $ex) {

  //           if (\Config::get('app.debug')) {

  //               \Session::put('error', 'Connection timeout');
  //               return Redirect::to('/thankyou');

  //           } else {

  //               \Session::put('error', 'Some error occur, sorry for inconvenient');
  //               return Redirect::to('/thankyou');

  //           }

  //   	}
  //   	foreach ($payment->getLinks() as $link) {

  //           if ($link->getRel() == 'approval_url') {

  //               $redirect_url = $link->getHref();
  //               break;

  //           }

  //       }

  //       /** add payment ID to session **/
  //       Session::put('paypal_payment_id', $payment->getId());

  //       if (isset($redirect_url)) {

  //           /** redirect to paypal **/
  //           return Redirect::away($redirect_url);

  //       }

  //       \Session::put('error', 'Unknown error occurred');
  //       return Redirect::to('/thankyou');
  //   }

  //   public function getPaymentStatus()
  //   {
  //       /** Get the payment ID before session clear **/
  //       $payment_id = Session::get('paypal_payment_id');

  //       /** clear the session payment ID **/
  //       Session::forget('paypal_payment_id');
  //       if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

  //           \Session::put('error', 'Payment failed');
  //           return Redirect::to('/thankyou');

  //       }

  //       $payment = Payment::get($payment_id, $this->_api_context);
  //       $execution = new PaymentExecution();
  //       $execution->setPayerId(Input::get('PayerID'));

  //       /**Execute the payment **/
  //       $result = $payment->execute($execution, $this->_api_context);

  //       if ($result->getState() == 'approved') {

  //           \Session::put('success', 'Payment success');
  //           return Redirect::to('/');

  //       }

  //       \Session::put('error', 'Payment failed');
  //       return Redirect::to('/thankyou');

  //   }

	public function create(Request $request)
	{
		$apiContext = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(
	            'AQByb9RaFErl1oTeyv5HUdRyfAEwBsly5WkpvXRdrhueFmjUtDzlAvdpvzFfRos6o_yngGomvCh3MtWR', 
	            'ENirRyKeVs7uXUfwLjDlweNwzessWOyTpCV2U2lfc1krrM6vFW85ubZyCW48PX15edbDReZ8cJVBnQgu'  
	        )
		);

		$payer = new Payer();
		$payer->setPaymentMethod("paypal");

		$content = Cart::content();
		(double)$rate = 0.000043; 
		$index = 0;
		$items = array();
		foreach($content as $v_content){
			$index++;
			$items[$index] = new Item();
			$items[$index]->setName($v_content->name)
			    ->setCurrency('USD')
			    ->setQuantity($v_content->qty)
			    ->setSku($v_content->id) // Similar to `item_number` in Classic API
			    ->setPrice($v_content->price * $rate);
		}
		$itemList = new ItemList();
		$itemList->setItems($items);
		

		(int)$phi=Session::get('vc_phi');
		$subtt =(double)Cart::subtotal(2,'.','');

		$details = new Details();
		$details->setShipping($phi*$rate)
		    ->setSubtotal($subtt*$rate);

		$amount = new Amount();
		$amount->setCurrency("USD")
		    ->setTotal(($subtt + $phi)*$rate)
		    ->setDetails($details);

		// $item1 = new Item();
		// $item1->setName('Ground Coffee 40 oz')
		// 	    ->setCurrency('USD')
		// 	    ->setQuantity(1)
		// 	    ->setSku("123123") // Similar to `item_number` in Classic API
		// 	    ->setPrice(7.5);
		// $item2 = new Item();
		// $item2->setName('Granola bars')
		// 	    ->setCurrency('USD')
		// 	    ->setQuantity(5)
		// 	    ->setSku("321321") // Similar to `item_number` in Classic API
		// 	    ->setPrice(2);

		// $itemList = new ItemList();
		// $itemList->setItems(array($item1, $item2));

		// $details = new Details();
		// $details->setShipping(1.2)
		// 	    ->setTax(1.3)
		// 	    ->setSubtotal(17.50);


		// $amount = new Amount();
		// $amount->setCurrency("USD")
		// 	    ->setTotal(20)
		// 	    ->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
		    ->setItemList($itemList)
		    ->setDescription("Payment description")
		    ->setInvoiceNumber(uniqid());

		// $baseUrl = getBaseUrl();
		$redirectUrls = new RedirectUrls();
		
		// $redirectUrls->setReturnUrl("http://localhost/GitHub/ShoesShopWebsite/shoesshop/execute-payment")
		$redirectUrls->setReturnUrl(URL::to('/execute-payment'))
		    ->setCancelUrl(URL::to('/payment'));

		$payment = new Payment();
		$payment->setIntent("sale")
		    ->setPayer($payer)
		    ->setRedirectUrls($redirectUrls)
		    ->setTransactions(array($transaction));

		// $request = clone $payment;
		$payment->create($apiContext);

		return redirect($payment->getApprovalLink());

	}

	public function execute()
	{
		$apiContext = new \PayPal\Rest\ApiContext(
	        new \PayPal\Auth\OAuthTokenCredential(
	            'AQByb9RaFErl1oTeyv5HUdRyfAEwBsly5WkpvXRdrhueFmjUtDzlAvdpvzFfRos6o_yngGomvCh3MtWR', 
	            'ENirRyKeVs7uXUfwLjDlweNwzessWOyTpCV2U2lfc1krrM6vFW85ubZyCW48PX15edbDReZ8cJVBnQgu'  
	        )
		);

		$paymentId = request('paymentId');
    	$payment = Payment::get($paymentId, $apiContext); 

    	$execution = new PaymentExecution();
    	$execution->setPayerId(request('PayerID'));

    	$transaction = new Transaction();
	    $amount = new Amount();
	    $details = new Details();

	    //them du lieu
		$content = Cart::content();
	    (double)$rate = 0.000043; 

		(int)$phi=Session::get('vc_phi');
		$subtt =(double)Cart::subtotal(2,'.','');

		// $details = new Details();
		$details->setShipping($phi*$rate)
		    ->setSubtotal($subtt*$rate);

		// $amount = new Amount();
		$amount->setCurrency("USD")
		    ->setTotal(($subtt + $phi)*$rate)
		    ->setDetails($details);



	    // $details->setShipping(1.2)
		   //      ->setTax(1.3)
		   //      ->setSubtotal(17.50);

     //    $amount->setCurrency('USD');
	    // $amount->setTotal(20);
	    // $amount->setDetails($details);
	    $transaction->setAmount($amount);

	    $execution->addTransaction($transaction);

	    $result = $payment->execute($execution, $apiContext); //ktra tinh tong tien

		return Redirect::to('/orderplace');
	}

    public function thankyou()
    {
    	return view('pages.checkout.thankyou');
    }

    public function orderPlace()
    {
    	$content = Cart::content(); 
        //them don hang
    	$matt = DB::table('thanhtoan')->where('tt_ten','Paypal')->first();
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
            $data['tt_ma'] = $matt->tt_ma;
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
                Cart::destroy();
                return Redirect::to('thankyou');
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
}
