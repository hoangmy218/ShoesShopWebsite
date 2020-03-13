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
        	<?php
                    $message = Session::get('fail_message');
                    if ($message){
                        echo '<span class="alert alert-danger">'.$message."</span>";
                        
                        Session::put('fail_message',null);
                    }
                    $message = Session::get('success_message');
                    if ($message){
                        echo '<span class="alert alert-success">'.$message."</span>";
                        
                        Session::put('success_message',null);
                    }
                ?>
				
          		<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
                        
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>STT</th>
						        <th>Mã đơn</th>
						        <th>Người nhận</th>
						        <th>Ngày đặt</th>
						        <th>Tổng tiền</th>
						        <th>Trạng thái</th>
						        
						        <th>&nbsp;</th>
                                <th>Xem chi tiết</th>
						      </tr>
						    </thead>
						    <tbody>
                                <?php {{$i=1;}} ?>
                                @foreach( $status as $key => $status)
								<tr>
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$status->dh_ma}}</td>
                                    <td>{{$status->dh_tenNhan}}</td>
                                    <td>{{$status->dh_ngayDat}}</td>
                                    <td>{{number_format($status->dh_tongTien).' VND'}}</td>
                                    <td>{{$status->dh_trangThai}}</td>
                                    <td class="product-remove"> {{-- Hủy đơn M --}}
                                        @if ($status->dh_trangThai != 'Đã hủy')
                                        <a onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')" class="ion-ios-close" href="{{URL::to('/cus-cancel-order/'.$status->dh_ma)}}"><i class="fa fa-times"></i></a>
                                        @else
                                            &nbsp;
                                        @endif
                                    </td>
                                     <td><a href="{{URL::to('/view-customerdetails/'.$status->dh_ma)}}" class="btn btn-primary py-2 px-3">Xem thêm</a></td>
                                </tr>
                                <?php {{$i++;}} ?>
                                @endforeach
                                </tbody>
						  </table>
					  </div>
    			</div>
    		</div>



	         
	          	</div>
          
      
    </section> <!-- .section -->

@endsection