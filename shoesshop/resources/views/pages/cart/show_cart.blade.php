@extends('shop_layout')
@section('content')

    <div class="hero-wrap hero-bread" style="background-image: url({{URL::to('public/frontend/images/bg_6.jpg')}});">
      <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
          <div class="col-md-9 ftco-animate text-center">
          	<p class="breadcrumbs"><span class="mr-2"><a href="{{URL::to('/')}}">Trang chủ</a></span> <span>Giỏ hàng</span></p>
            <h1 class="mb-0 bread">Giỏ hàng của tôi</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-cart">
			<div class="container">
				<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">
	    				<table class="table">
						    <thead class="thead-primary">
						      <tr class="text-center">
						        <th>STT</th>
						        <th>Hình ảnh</th>
						        <th>Sản phẩm</th>
						        <th>Đơn giá</th>
						        <th>Số lượng</th>
						        <th>Thành tiền</th>
						        <th>&nbsp;</th>
						      </tr>
						    </thead>
						    <tbody>
						      <tr class="text-center">
						      	<td class="product-price">
						        	<h4>1</h4>
						        </td>
						        <td class="image-prod"><div class="img" style="background-image:url({{URL::to('public/frontend/images/product-3.jpg')}});"></div></td>
						        
						        <td class="product-name">
						        	<h3>Nike Free RN 2019 iD</h3>
						        	<p>Far far away, behind the word mountains, far from the countries</p>
						        </td>
						        
						        <td class="price">$4.90</td>
						        
						        <td class="quantity">
						        	<div class="input-group mb-3">
					             	<input type="number" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
					          	</div>
					          </td>
						        <td class="total">$4.90</td>
						         <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>
						      </tr><!-- END TR-->
						    </tbody>
						  </table>
					  </div>
    			</div>
    		</div>
    		<div class="row justify-content-start">
    			<div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
    				<div class="cart-total mb-3">
    					<h3 class="billing-heading mb-4">Tổng tiền giỏ hàng</h3>
	          			<p class="d-flex">
    						<span>Thành tiền</span>
    						<span>$20.60</span>
    					</p>
    					<p class="d-flex">
    						<span>Phí giao hàng</span>
    						<span>$0.00</span>
    					</p>
    					<p class="d-flex">
    						<span>Giảm giá</span>
    						<span>$3.00</span>
    					</p>
    					<hr>
    					<p class="d-flex total-price">
    						<span>Tổng tiền</span>
    						<span>$17.60</span>
    					</p>
    				</div>
    				<p class="text-center"><a href="{{URL::to('/checkout')}}" class="btn btn-primary py-3 px-4">Thanh toán</a></p>
    			</div>
    		</div>
			</div>
		</section>
@endsection
		