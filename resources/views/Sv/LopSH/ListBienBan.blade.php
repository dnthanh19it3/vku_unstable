@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Danh sách họp lớp</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h6>Học kỳ {{$kyhoc_hienhanh->hocky}} năm học {{$kyhoc_hienhanh->nambatdau . " - " . $kyhoc_hienhanh->namketthuc}}</h6>
                    <ul class="list_thang">
                        @foreach($arrayMonth as $key => $value)
                            @if(isset($value->bienban))
                                <li class="@if($value->bienban->xacnhan_loptruong && $value->bienban->xacnhan_bithu && $value->bienban->xacnhan_gvcn) hoanthanh @else choxacminh @endif"><h6>Họp lớp tháng {{$value->thang_text}}</h6><a class="ml-2" href="{{route('sv.hoplop.xembienban', ['id' => $value->bienban->id])}}"><i class="fas fa-eye mr-1"></i>Xem</a><a href="{{route('sv.hoplop.suabienban', ['id' => $value->bienban->id])}}"><i class="fas fa-pen mr-1 ml-2"></i>Sửa</a></li>
                            @else
                                <li class="chuadenhan"><h6 class="mr-2">Họp lớp tháng {{$value->thang_text}}</h6><a href="{{route("sv.hoplop.taobienban", ['thang' => $value->thang])}}"><i class="fas fa-plus-circle mr-1"></i>Tạo biên bản</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
