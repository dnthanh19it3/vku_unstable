@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Thông tin chung</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Lớp sinh hoạt</h6></div>
                        <div class="col-md-8">{{$data->tenlop}}</div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Tháng</h6></div>
                        <div class="col-md-8">{{$data->thang}}</div>
                    </div><div class="row ml-3">
                        <div class="col-md-4"><h6>Thời gian họp</h6></div>
                        <div class="col-md-8">{{$data->thoigianhop}}</div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Địa điểm</h6></div>
                        <div class="col-md-8">{{$data->diadiem}}</div>
                    </div>
                    <hr/>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Xác nhận</h6></div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">Lớp trưởng: {{$bancansu->loptruong->hodem . ' ' . $bancansu->loptruong->ten}} @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>
                                <div class="col-md-12">Bí thư: {{$bancansu->bithu->hodem . ' ' . $bancansu->bithu->ten}} @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>
                                <div class="col-md-12">GVCN @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Nội dung biên bản</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row ml-3 vien-net-dut">
                        <div class="col-md-12"><h6>Chương trình họp</h6></div>
                        <div class="col-md-12 mb-2 ml-3">{!! $data->chuongtrinh !!}</div>
                    </div>
                    <div class="row ml-3 mt-1 vien-net-dut">
                        <div class="col-md-12"><h6>Nội dung họp</h6></div>
                        <div class="col-md-12 ml-3 mb-2">{!! $data->noidung !!}</div>
                    </div>
                    <div class="row ml-3 mt-1 vien-net-dut">
                        <div class="col-md-12"><h6>Thảo luận và góp ý</h6></div>
                        <div class="col-md-12 ml-3 mb-2">{!! $data->gopy ? $data->gopy : "Không có góp ý" !!}</div>
                    </div>
                    <div class="row ml-3 mt-1">
                        <div class="col-md-12"><h6>Nhận xét GVCN</h6></div>
                        <div class="col-md-12 ml-3 mb-2">{!! $data->gvcn_nhanxet != null ? $data->gvcn_nhanxet : "Không có nhận xét" !!}</div>
                    </div>
                    <hr/>
                    <h6>Phản hồi</h6>
                </div>
            </div>
        </div>
    </div>
@endsection