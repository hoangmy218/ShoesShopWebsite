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
                                            <h5>Quản lý đơn hàng</h5>
                                            {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
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
                                                <a href="#">Quản lý đơn hàng</a>
                                            </li>
                                            {{-- <li class="breadcrumb-item active" aria-current="page">Bootstrap Tables</li> --}}
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
								<div class="card">
                                    <div class="card-header d-block">
                                        <h3>Danh sách đơn hàng</h3>
                                        
                                    </div>
                                    <div class="card-body p-0 table-border-style">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>STT</th>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Tên người mua</th>
                                                        <th>Thông tin giao hàng</th>
                                                        <th>Ngày đặt hàng</th>
                                                        <th>Ngày duyệt</th>
                                                        <th>Hình thức thanh toán</th>
                                                        <th>Tổng tiền</th>
                                                        <th>Trạng thái</th>
                                                        <th>Thao tác</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	{{-- @foreach( $order as $ord) --}}
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>110</td>
                                                        <td>BJ Alex</td>
                                                        <td>DG / Can Tho / 099x / VNPOST </td>
                                                        <td>28/02/2020</td>
                                                        <td>28/02/2020</td>
                                                        <td>Tiền mặt</td>
                                                        <td>{{number_format(799000).' VND'}}</td>
                                                        <td>Đã duyệt</td>
                                                        <td><div class="table-actions">
                                                            <a href="{{URL::to('/view-order')}}"><i class="ik ik-eye"></i></a>
                                                            
                                                            <a href="#"><i class="ik ik-trash-2"></i></a>
                                                        </div></td>
                                                    </tr>
                                                   	{{-- @endforeach --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            


@endsection