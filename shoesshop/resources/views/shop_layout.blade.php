<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Shoes Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/frontend/css/searchmodal.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/open-iconic-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/animate.css')}}">
    {{--     <link rel="stylesheet" href="{{asset('public/frontend/css/core-style.css')}}"> --}}
    
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/aos.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery.timepicker.css')}}">

    
    <link rel="stylesheet" href="{{asset('public/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/css/icomoon.css')}}">

    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}">
    @yield('script_thumbnail')
  


{{--       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}
 
  </head>
 <body class="goto-here">
    <div class="py-1 bg-black">
      <div class="container">
        <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
          <div class="col-lg-12 d-block">
            <div class="row d-flex">
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
                <span class="text">034 888 3338</span>
              </div>
              <div class="col-md pr-4 d-flex topper align-items-center">
                <div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
                <span class="text">shoesshop@gmail.com</span>
              </div>
              <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                {{-- <span class="text"><a href="{!! route('user.change-language', ['en']) !!}">English</a> | <a href="{!! route('user.change-language', ['vi']) !!}">Vietnamese</a>{{Session::get('website_language')}}{{App::getLocale()}}</span> --}}
                <span class="text"><a href="{{URL::to('/switchlang/en')}}">{{ __('Tiếng Anh') }}</a> | <a href="{{URL::to('/switchlang/vi')}}">{{ __('Tiếng Việt') }}</a></span>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="{{URL::to('/')}}">Shoes Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> 
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active"><a href="{{URL::to('/')}}" class="nav-link">{{ __('Trang chủ') }}</a></li>
            <li class="nav-item"><a data-toggle="modal" data-target="#myModal" class="nav-link">{{ __('Tìm kiếm') }}</a></li>
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ __('Danh mục') }}</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="shop.html">{{ __('Mua sắm') }}</a>
                <a class="dropdown-item" href="{{URL::to('/show-cart')}}">{{ __('Giỏ hàng của tôi') }}</a>
                <a class="dropdown-item" href="{{URL::to('/checkout')}}">{{ __('Đặt hàng') }}</a>
                <a class="dropdown-item" href="{{URL::to('/payment')}}">{{ __('Thanh toán') }}</a>
              </div>
            </li> --}}
            <li class="nav-item"><a href="about.html" class="nav-link">{{ __('Giới thiệu') }}</a></li>
         {{--   <li class="nav-item"><a href="blog.html" class="nav-link">{{ __('Blog') }}</a></li> --}}
            <li class="nav-item"><a href="contact.html" class="nav-link">{{ __('Liên hệ') }}</a></li>

            <?php 
              $customer_name = Session::get('nd_ten');
              $customer_cv = Session::get('cv_ma'); 
            ?>
            @if ($customer_cv == 2)
             <li class="nav-item dropdown">
              <a href="{{URL::to('/')}}" class="nav-link">{{$customer_name}}</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="{{URL::to('/info-customer')}}">{{ __('Thông tin của tôi') }}</a>
                <a class="dropdown-item" href="{{URL::to('/status-order')}}">{{ __('Đơn hàng của tôi') }}</a>
             <a class="dropdown-item" onclick="<?php echo "return confirm('"; ?>{{ __("Bạn chắc chắn muốn đăng xuất tài khoản này?") }}<?php echo "')";?>" href="{{URL::to('/log_out')}}">{{ __('Đăng xuất') }}</a>
              </div>
            </li>
            @else
              <li class="nav-item"><a href="{{URL::to('userLogin')}}" class="nav-link">{{ __('Đăng nhập') }}</a></li>
              <li class="nav-item"><a href="{{URL::to('register')}}" class="nav-link">{{ __('Đăng ký') }}</a></li>
            @endif

             <li class="nav-item dropdown nav-item cta cta-colored">
              <a class="nav-link dropdown-toggle" href="{{URL::to('/show-cart')}}" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icon-shopping_cart"></span> 
              <?php
                $content = Cart::content();
                $sl = 0;
                if ($content){
                  foreach ($content as $v_content){
                      $sl = $sl + $v_content->qty; 
                  }
                  
                }
                
              ?>
              [{{$sl}}]</a>
              <div class="dropdown-menu" aria-labelledby="dropdown04">
                <a class="dropdown-item" href="{{URL::to('/show-cart')}}">{{ __('Giỏ hàng của tôi') }}</a>
                <a class="dropdown-item" href="{{URL::to('/removeCart')}}">{{ __('Xóa giỏ hàng của tôi') }}</a>
                
              </div>
            </li>
            {{-- <li class="nav-item cta cta-colored"><a  class="nav-link"> --}}

          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                  </div>
                  <div class="modal-body">

                    <h1>{{ __('Tìm kiếm') }}</h1>
                    <form class="navbar-form " role="search" action="{{URL::to('/tim-kiem')}}" method="POST">
                        {{csrf_field()}}
                      <div class="form-group">
                        <input type="text" class="form-control" name="keywords_submit" placeholder="Nike Air Max...">
                      </div>
                      <button type="submit" class="btn btn-theme btn-primary py-3 px-4">{{ __('Tìm kiếm') }}</button>
                    </form>
                 </div>
              </div>
            </div>
          </div>


@yield('content')


    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row">
          <div class="mouse">
            <a href="#" class="mouse-icon">
              <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
            </a>
          </div>
        </div>
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Shoesshop</h2>
              <p>{{ __('Nâng niu bàn chân bạn') }}</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-5">
              <h2 class="ftco-heading-2">{{ __('Danh mục') }}</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">{{ __('Mua sắm') }}</a></li>
                <li><a href="#" class="py-2 d-block">{{ __('Giới thiệu') }}</a></li>
                <li><a href="#" class="py-2 d-block">{{ __('Liên hệ') }}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-4">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">{{ __('Giúp đỡ') }}</h2>
              <div class="d-flex">
                <ul class="list-unstyled mr-l-5 pr-l-3 mr-4">
                  <li><a href="#" class="py-2 d-block">{{ __('Thông tin vận chuyển') }}</a></li>
                  <li><a href="#" class="py-2 d-block">{{ __('Đổi & trả hàng') }}</a></li>
                </ul>
                <ul class="list-unstyled">
                  <li><a href="#" class="py-2 d-block">{{ __('Câu hỏi thường gặp') }}</a></li>
                  <li><a href="#" class="py-2 d-block">{{ __('Liên hệ') }}</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">{{ __('Bạn có thắc mắc?') }}</h2>
              <div class="block-23 mb-3">
                <ul>
                  <li><span class="icon icon-map-marker"></span><span class="text">{{ __('888A Đường 3/2, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ') }}</span></li>
                  <li><a href="#"><span class="icon icon-phone"></span><span class="text">034 888 3338</span></a></li>
                  <li><a href="#"><span class="icon icon-envelope"></span><span class="text">shoesshop@gmail.com</span></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            {{-- <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart color-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p> --}}
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{asset('public/frontend/js/jquery.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/popper.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.easing.1.3.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.stellar.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/owl.carousel.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/aos.js')}}"></script>
  <script src="{{asset('public/frontend/js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{asset('public/frontend/js/bootstrap-datepicker.js')}}"></script>
  <script src="{{asset('public/frontend/js/scrollax.min.js')}}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="{{asset('public/frontend/js/google-map.js')}}"></script>
  <script src="{{asset('public/frontend/js/main.js')}}"></script>

  
    @yield('script_qty')

  </body>
</html>