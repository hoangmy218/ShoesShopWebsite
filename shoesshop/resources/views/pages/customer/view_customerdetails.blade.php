@extends('shop_layout')
@section('content')
	<div class="hero-wrap hero-bread" style="background-image: url({{asset('public/frontend/images/bg_6.jpg')}});">
     	<div class="container">
        	<div class="row no-gutters slider-text align-items-center justify-content-center">
          		<div class="col-md-9 ftco-animate text-center">
          			<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Trang chủ</a></span> <span>Đơn hàng</span></p>
            		<h1 class="mb-0 bread">Đơn hàng của tôi</h1>
          		</div>
        	</div>
      	</div>
    </div>

    <section class="ftco-section">
    	<div class="container">
        	   <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table" border="0">
                            <thead class="thead-primary">
                              <tr class="text-center">
                                <th><h3 class=" float-left">Mã đơn hàng: {{$order->dh_ma}}</h3></th>
                                <th></th>
                                <th><h3 class=" float-right">Ngày đặt: {{$order->dh_ngayDat}}</h3></th>
                                
                                <th>&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                                <td class=" float-left " > 
                                        Người đặt
                                        <address>
                                            <strong>{{$order->nd_ten}}</strong><br>{{$order->nd_diaChi}} <br>Phone: {{$order->nd_dienThoai}}<br>Email: {{$order->nd_email}}
                                        </address>
                                    </td>
                                <td>
                                    Người nhận
                                        <address>
                                            <strong>{{$order->dh_tenNhan}}</strong><br>{{$order->dh_diaChiNhan}}<br>Phone: {{$order->dh_dienThoai}}<br>Email: {{$order->dh_email}}
                                        </address>
                                </td>
                                <td>
                                    <b>Mã đơn hàng #{{$order->dh_ma}}</b><br>          
                                        <b>Hình thức vận chuyển:</b> {{$order->vc_ten}}<br>
                                        <b>Hình thức thanh toán:</b> {{$order->tt_ten}}
                                </td>
                            </tbody>
                          </table>
                      </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                              <tr class="text-center">
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>&nbsp;</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $i=1;
                                    $congTien=0;
                                    ?>
                                @foreach($items as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->sp_ten}}</td>
                                    <td>{{$item->soLuongDat}}</td>
                                    <td>{{number_format($item->sp_donGiaBan).' VND'}}</td>
                                    <td>{{number_format($item->thanhTien).' VND'}}</td>
                                    <?php $congTien = $congTien + $item->thanhTien; ?>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                      </div>
                </div>
            </div>
            

            <div class="row">
                <div class="col-6">
                    <p class="lead">Phương thức thanh toán:</p>
                    <b>{{$order->tt_ten}}</b>
                    <p class="lead">Trạng thái thanh toán:</p>
                    @if ($order->tt_ten=='Tiền mặt')
                        <b>Chưa thanh toán</b>
                    @endif
                </div>
                <div class="col-6">
                <div class="table-responsive">
                <table class="table">
                    <tr align="left">
                        <th style="width:50%">Cộng tiền: {{number_format($congTien).' VND'}}</th>
                    </tr>
                    <tr align="left">
                        <th>Khuyến mãi: 0</th>
                    <tr align="left" >
                        <th>Phí vận chuyển: {{number_format($order->vc_phi).' VND'}}</th>
                    </tr>
                    <tr align="left" >
                        <th>Tổng tiền thanh toán: {{number_format($congTien+$order->vc_phi).' VND'}}</th>
                    </tr>
                </table>
                </div>
                </div>
            </div>
            <div>
</div>
          
      
    </section> <!-- .section -->

@endsection