@extends('shop_layout')
@section('content')

    <section id="home-section" class="hero">
        <div class="home-slider owl-carousel">
          <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
              <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
                <img class="one-third order-md-last img-fluid" src="{{URL::to('public/frontend/images/bg_1.png')}}" alt="">
                  <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <div class="text">
                        <span class="subheading">{{ __('Sản phẩm mới') }}</span>
                        <div class="horizontal">
                            <h1 class="mb-4 mt-3">{{ __('Bộ sưu tập giày 2019') }}</h1>
                            <p class="mb-4">{{ __('Loạt sản phẩm giày thể thao hoàn toàn khác biệt và đậm tính thời trang. Sắc màu của tôi - Giấc mơ của bạn.') }}</p>
                            
                            <p><a href="#" class="btn-custom">{{ __('Khám phá ngay') }}</a></p>
                            
                          </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>

          <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
              <div class="row d-flex no-gutters slider-text align-items-center justify-content-end" data-scrollax-parent="true">
                <img class="one-third order-md-last img-fluid" src="{{URL::to('public/frontend/images/bg_2.png')}}" alt="">
                  <div class="one-forth d-flex align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                    <div class="text">
                        <span class="subheading">{{ __('Sản phẩm mới') }}</span>
                        <div class="horizontal">
                            <h1 class="mb-4 mt-3">{{ __('Bộ sưu tập giày mùa hè mới') }}</h1>
                            <p class="mb-4">{{ __('Lắng nghe âm thanh của mùa hạ') }}</p>
                            
                            <p><a href="#" class="btn-custom">{{ __('Khám phá ngay') }}</a></p>
                          </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row no-gutters ftco-services">
              <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                  <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-bag"></span>
                  </div>
                  <div class="media-body">
                    <h3 class="heading">{{ __('Khuyến mãi') }}</h3>
                    <p>{{ __('Nhiều mã giảm giá hấp dẫn') }}</p>
                  </div>
                </div>      
              </div>
              <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                  <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-customer-service"></span>
                  </div>
                  <div class="media-body">
                    <h3 class="heading">{{ __('Hỗ trợ khách hàng') }}</h3>
                    <p>{{ __('Nhanh chóng, kinh nghiệm và hiệu quả. Chúng tôi luôn luôn sẵn sàng giải đáp tất cả các thằc mắc và giải quyết nhanh chóng vấn đề của bạn!') }}</p>
                  </div>
                </div>    
              </div>
              <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                  <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-payment-security"></span>
                  </div>
                  <div class="media-body">
                    <h3 class="heading">{{ __('Thanh toán bảo mật') }}</h3>
                    <p>{{ __('Dịch vụ được đảm bảo an toàn, nhanh chóng và bảo mật với hình thức thanh toán trực tuyến.') }}</p>
                  </div>
                </div>      
              </div>
            </div>
        </div>
    </section>

  <section class="ftco-section bg-light">
        <div class="container">
                <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2 class="mb-4">{{ __('Sản phẩm mới') }}</h2>
            <p>{{ __('Nâng niu bàn chân bạn') }}</p>
          </div>
        </div>          
        </div>
        <div class="container">
            <div class="row">
                @foreach($all_product as $key => $product)<!-- Tiên -->
                <div class="col-sm-12 col-md-6 col-lg-3 ftco-animate d-flex">
                     
                    <div class="product d-flex flex-column">
                        <a href="#" class="img-prod"><img class="img-fluid" src="public/upload/product/{{$product->ha_ten}}" alt="Colorlib Template">
                            <div class="overlay"></div>
                            <span class="status">{{ __('Giảm 50%') }}</span>
                        </a>
                        <div class="text py-3 pb-4 px-3">
                            <div class="d-flex">
                                <div class="cat">
                                    <span>{{ __('Phong cách thời thượng') }}</span>
                                    
                                </div>
                                <div class="rating">
                                    <p class="text-right mb-0">
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                        <a href="#"><span class="ion-ios-star-outline"></span></a>
                                    </p>
                                </div>
                            </div>
                            <!-- Tiên -->
                            <h3><a href="{{URL::to('/product-detail/'.$product->sp_ma)}}">{{$product->sp_ten}}</a></h3>
                            <div class="pricing">
                                <p class="price"><span>{{number_format($product->sp_donGiaBan).' '.'VNĐ'}}</span></p>
                            </div>
                            <p class="bottom-area d-flex px-3">
                                <a href="#" class="add-to-cart text-center py-2 mr-1"><span>{{ __('Thêm giỏ hàng') }}<i class="ion-ios-add ml-1"></i></span></a>
                                <a href="#" class="buy-now text-center py-2">{{ __('Buy now') }}<span><i class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>

                        
                    </div>
                    
                </div>
                @endforeach
 
            </div>
        </div>
    </section>



    <section class="ftco-section ftco-choose ftco-no-pb ftco-no-pt">
        <div class="container">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="choose-wrap divider-one img p-5 d-flex align-items-end" style="background-image: url({{asset('public/frontend/images/choose-1.jpg')}});">

                        <div class="text text-center text-white px-2">
                                <span class="subheading">{{ __('Giày nam') }}</span>
                            <h2>{{ __('Bộ sưu tập giày nam') }}</h2>
                            <p>{{ __('Cũng tương tự như phong cách cổ điển, những người theo phong cách tinh tế luôn muốn đồ chất lượng cao.') }}</p>
                            <p><a href="#" class="btn btn-black px-3 py-2">{{ __('Mua sắm ngay') }}</a></p>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-8">
                    <div class="row no-gutters choose-wrap divider-two align-items-stretch">
                        <div class="col-md-12">
                            <div class="choose-wrap full-wrap img align-self-stretch d-flex align-item-center justify-content-end" style="background-image: url({{URL::to('public/frontend/images/choose-2.jpg')}});">
                                <div class="col-md-7 d-flex align-items-center">
                                    <div class="text text-white px-5">
                                        <span class="subheading">{{ __('Giày nữ') }}</span>
                                        <h2>{{ __('Bộ sưu tập giày nữ') }}</h2>
                                        <p>{{ __('Phong cách nữ sinh rất phổ biến trong giới sinh viên đại học.') }}</p>
                                        <p><a href="#" class="btn btn-black px-3 py-2">{{ __('Mua sắm ngay') }}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row no-gutters">
                                <div class="col-md-6">
                                    <div class="choose-wrap wrap img align-self-stretch bg-light d-flex align-items-center">
                                        <div class="text text-center px-5">
                                            <span class="subheading">{{ __('Mua sắm mùa hè') }}</span>
                                            <h2>{{ __('Giảm giá thêm 50%') }}</h2>
                                            <p>{{ __('Cùng chào đón một mùa hè sôi động.') }}</p>
                                            <p><a href="#" class="btn btn-black px-3 py-2">{{ __('Mua sắm ngay') }}</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="choose-wrap wrap img align-self-stretch d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/choose-3.jpg')}});">
                                        <div class="text text-center text-white px-5">
                                            <span class="subheading">{{ __('Giày dép') }}</span>
                                            <h2>{{ __('Bán chạy nhất') }}</h2>
                                            <p>{{ __('5 mẫu giày bán chạy nhất 2020 mà bạn không nên bỏ lỡ.') }}</p>
                                            <p><a href="#" class="btn btn-black px-3 py-2">{{ __('Mua sắm ngay') }}</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-deal bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{URL::to('public/frontend/images/prod-1.png')}}" class="img-fluid" alt="">
                </div>
                <div class="col-md-6">
                    <div class="heading-section heading-section-white">
                        <span class="subheading">{{ __('Khuyến mãi đặc biệt hàng tháng') }}</span>
                <h2 class="mb-3">{{ __('Khuyến mãi đặc biệt hàng tháng') }}</h2>
              </div>
                    <div id="timer" class="d-flex mb-4">
                          <div class="time" id="days"></div>
                          <div class="time pl-4" id="hours"></div>
                          <div class="time pl-4" id="minutes"></div>
                          <div class="time pl-4" id="seconds"></div>
                        </div>
                        <div class="text-deal">
                            <h2><a href="#">Nike Free RN 2019 iD</a></h2>
                            <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
                            <ul class="thumb-deal d-flex mt-4">
                                <li class="img" style="background-image: url({{URL::to('public/frontend/images/product-6.png')}});"></li>
                                <li class="img" style="background-image: url({{URL::to('public/frontend/images/product-2.png')}});"></li>
                                <li class="img" style="background-image: url({{URL::to('public/frontend/images/product-4.png')}});"></li>
                            </ul>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="services-flow">
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-bag"></span>
                        </div>
                        <div class="text">
                            <h3>{{ __('Giảm giá') }}</h3>
                            <p class="mb-0">{{ __('Nhiều mã giảm giá hấp dẫn') }}</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-heart-box"></span>
                        </div>
                        <div class="text">
                            <h3>{{ __('Quà tặng giá trị') }}</h3>
                            <p class="mb-0">{{ __('Nhiều quà tặng giá trị') }}</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-payment-security"></span>
                        </div>
                        <div class="text">
                            <h3>{{ __('Hỗ trợ xuyên suốt') }}</h3>
                            <p class="mb-0">{{ __('Chúng tôi luôn luôn bên bạn để lắng nghe và giúp đỡ') }}</p>
                        </div>
                    </div>
                    
                </div>
            </div>
          <div class="col-lg-7">
            <div class="heading-section ftco-animate mb-5">
                <h2 class="mb-4">{{ __('Sự hài lòng của khách hàng') }}</h2>
                <p>{{ __('với dịch vụ của chúng tôi') }}</p>
              </div>
            <div class="carousel-testimony owl-carousel">
              <div class="item">
                <div class="testimony-wrap">
                  <div class="user-img mb-4" style="background-image: url({{URL::to('public/frontend/images/person_1.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4 pl-4 line">{{ __('Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.') }}</p>
                    <p class="name">Garreth Smith</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="user-img mb-4" style="background-image: url({{URL::to('public/frontend/images/person_2.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Garreth Smith</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="user-img mb-4" style="background-image: url({{URL::to('public/frontend/images/person_3.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Garreth Smith</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="user-img mb-4" style="background-image: url({{URL::to('public/frontend/images/person_1.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Garreth Smith</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap">
                  <div class="user-img mb-4" style="background-image: url({{URL::to('public/frontend/images/person_1.jpg')}})">
                    <span class="quote d-flex align-items-center justify-content-center">
                      <i class="icon-quote-left"></i>
                    </span>
                  </div>
                  <div class="text">
                    <p class="mb-4 pl-4 line">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Garreth Smith</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-gallery">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 heading-section text-center mb-4 ftco-animate">
            {{-- <h2 class="mb-4">Follow Us On Instagram</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in</p> --}}
          </div>
            </div>
        </div>
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-1.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-1.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-2.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-2.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-3.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-3.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-4.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-4.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-5.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-5.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
                    <div class="col-md-4 col-lg-2 ftco-animate">
                        <a href="{{URL::to('public/frontend/images/gallery-6.jpg')}}" class="gallery image-popup img d-flex align-items-center" style="background-image: url({{URL::to('public/frontend/images/gallery-6.jpg')}});">
                            <div class="icon mb-4 d-flex align-items-center justify-content-center">
                            <span class="icon-instagram"></span>
                        </div>
                        </a>
                    </div>
        </div>
        </div>
    </section>


@endsection