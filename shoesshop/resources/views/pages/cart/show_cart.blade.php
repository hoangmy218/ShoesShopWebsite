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
			<?php
				$content = Cart::content();
			?>

			<div class="row">
    			<div class="col-md-12 ftco-animate">
    				<div class="cart-list">

	    				<table class="table">
						    <thead class="thead-primary">
							     <tr class="text-center">
							        <th>STT</th>
							        <th>Hình ảnh</th>
							        <th>Sản phẩm</th>
							        <th>Kích cỡ</th>
							        <th>Đơn giá</th>
							        <th>Số lượng</th>
							        <th>Thành tiền</th>
							        <th>&nbsp;</th>
							    </tr>
						    </thead>

							@foreach($content as $v_content)<!-- tien -->
							    <tbody>
								    <tr class="text-center">
								      	<td class="product-price">
								        	<h4>1</h4>
								        </td>
								        <td class="image-prod"><div class="img" style="background-image:url({{URL::to('public/upload/product/'.$v_content->options->image)}});" ></div></td>
								        
								        <td class="product-name">
								        	<h3>{{$v_content->name}}</h3>
								        	
								        </td>
								        <td class="quantity">
								        	<h3>{{$v_content->options->size}}</h3>								        	
								        </td>
								        
								        <td class="price">{{number_format($v_content->price).' '.'vnđ'}}</td>
								        
								        <td class="quantity">
									        <form action="{{URL::to('/update-cart-quantity')}}" method="POST">	
										        <div class="input-group mb-3">										        	
													{{ csrf_field() }}		
							             			<input type="number" onchange="this.form.submit()" name="quantity" class="quantity form-control input-number" value="{{$v_content->qty}}" min="1" max="5">
										             	{{-- <input type="number" name="cart_quantity" class="quantity form-control input-number" value="{{$v_content->qty}}" min="1" max="100"> --}}    	
									          	</div>
									          	<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart" class="form-control">
									        </form>
							         	</td>
								        <td class="total">
								        	<p class="cart_total_price">
											
											<?php
											$subtotal = $v_content->price * $v_content->qty;
											echo number_format($subtotal).' '.'vnđ';
											?><!-- Tien -->
										</p>
								        </td>
								        <td class="product-remove">
								         	<a class="ion-ios-close" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
								         	
								         </td>
								         
							         
							      		</tr><!-- END TR-->
							    	</tbody>
							@endforeach 
						</table>
					</div>
    			</div>
    		</div>
	    	<div class="row justify-content-start">
	    		<div class="col-md-12 ftco-animate">
	    			<div class="cart-total mb-3">
	    				<h3 class="billing-heading mb-4" align="right">Thành tiền giỏ hàng: &emsp;{{Cart::subtotal().' '.'vnđ'}}</h3>		
	    			</div>
	    			<p class="text-center"><a href="{{URL::to('/checkout')}}" class="btn btn-primary py-3 px-4">Đặt hàng</a></p>
	    		</div>
	    	</div>
	    

	</div>
</section>
@endsection
		