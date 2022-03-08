@extends('layout.sv_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>Thông tin tạm trú</h5>
                            </div>
                            <div class="col-sm-7">
                                <a href="{{route('taotamtru')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Khai báo</span></a>
                            </div>
                        </div>
                    </div>
                    @if($khaibaohientai == null)
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Bạn chưa khai báo cho học kì hiện tại. Vui lòng khai báo tại <a class="text-white" href="{{route('taotamtru')}}"><b>đây</b></a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- Thêm thông báo lỗi dưới if..... -->
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" style="color: #3c763d;" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Địa chỉ</th>
                                <th>Năm học</th>
                                <th>Học kì</th>
                                <th>Chủ hộ</th>
                                <th>Điện thoại chủ hộ</th>
                                <th>Từ ngày</th>
                                <th>Trạng thái</th>
                                <th>Ngày khai báo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tamtru as $key => $item)
                                <tr>
                                    <td>{{$key+=1}}</td>
                                    <td>{{$item->sonha .", ".$item->thonto.", ".$item->xaphuong.", ".$item->quanhuyen.", ".$item->tinhthanh}}</td>
                                    <td>{{$item->nambatdau."-".$item->namketthuc}}</td>
                                    <td>{{$item->hocky}}</td>
                                    <td>{{$item->tenchuho}}</td>
                                    <td>{{$item->sdtchuho}}</td>
                                    <td>{{\Carbon\Carbon::make($item->thoigianbatdau )->format('d-m-Y')}}</td>
                                    <td>@if($item->trangthai)<span class="status text-success">&bull;</span> Hiện tại @else <span class="status text-danger">&bull;</span> Chỗ ở cũ @endif</td>
                                    <td>{{\Carbon\Carbon::make($item->created_at)->format('d-m-Y')}}</td>
                                </tr>
                            @empty
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
