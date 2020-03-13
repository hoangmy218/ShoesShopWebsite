@extends('admin_layout')
@section('content')

                       


<div class="main-content">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-credit-card bg-blue"></i>
                        <div class="d-inline">
                            @foreach($list as $key => $sp)
                            <h5> Mã {{$sp->sp_ma}} : {{$sp->sp_ten}}</h5>
                                                    {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{URL::to('/dashboard')}}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="#">Quản lý sản phẩm</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Chi tiết sản phẩm</li>
                        </ol>
                    </nav>
                 </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-header d-block">
                        <h3>Thông tin chi tiết sản phẩm</h3>
                    </div>
                    <div class="card-body p-0 table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Kích thước(Size)</th>
                                        <th>Số lượng nhập</th>
                                        <th>Số lượng tồn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach( $kichco as $key => $size)
                                    <tr>
                                        <th scope="row">{{$i}}</th>
                                        <th scope="row">{{$size->ctsp_kichCo}}</th>
                                        @foreach($ton as $key =>$tn)
                                        @if($tn->ctsp_kichCo==$size->ctsp_kichCo)
                                        <th scope="row">{{$tn->ctsp_soLuongNhap}}</th>
                                        <th scope="row">{{$tn->ctsp_soLuongTon}}</th>
                                        @endif

                                        @endforeach
                                    </tr>
                                    <?php $i++; ?>
                                    @endforeach 
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                </div>                 
            </div>
            <div class="col-4">
                 <div class="row">
                            <div class="col-12">
                                <p class="lead">Tổng số lượng nhập:
                                    @foreach( $tongslnhap as $key => $slnhap)
                                        <b>{{$slnhap->slnhap}}</b>
                                    @endforeach 
                                </p> 
                                <p class="lead">Tổng số lượng tồn:
                                     @foreach( $tongslton as $key => $slton)
                                        <b>{{$slton->slton}}</b>   
                                    @endforeach 
                                </p>
                                <p class="lead">Ghi chú:
                                     @foreach( $list as $key => $sp)
                                        <b>{{$sp->sp_ghiChu}}</b>   
                                    @endforeach 
                                </p>
                                        
                            </div>
                </div>               
            </div>
        </div>
    </div>
</div>
@endsection
