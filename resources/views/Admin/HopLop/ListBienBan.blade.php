@extends('layout.admin_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách họp lớp</h6>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul>
                        @foreach($months as $value)
                            <li><a href="{{route('ad.hoplop.listhoplop', ['thang' => $value])}}">Tháng {{$value}}</a> </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách họp lớp</h6>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h6>Tháng {{$thang}}, học kỳ {{$kyhoc_hienhanh->hocky}} năm
                        học {{$kyhoc_hienhanh->nambatdau . " - " . $kyhoc_hienhanh->namketthuc}}</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list_thang">
                                @foreach($arrayMonth as $key => $value)
                                    @if(isset($value->bienban))
                                        <li>
                                            <div>
                                                Đã nộp biên bản ({{$thongke->danop}})
                                            </div>
                                            <ul>
                                                @foreach($value->bienban as $lop => $noidungbienban)

                                                    @if($noidungbienban != null)
                                                        <li>
                                                            {{$lop}}<a class="ml-2"
                                                                       href="{{route('admin.hoplop.xembienban', ['id' => $noidungbienban->id])}}"><i
                                                                        class="fas fa-eye mr-1"></i>Xem</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else

                                    @endif
                                @endforeach
                            </ul>
                        </div><div class="col-md-6">
                            <ul class="list_thang">
                                @foreach($arrayMonth as $key => $value)
                                    @if(isset($value->bienban))
                                        <li>
                                            <div>Chưa nộp biên bản ({{$thongke->chuanop}})</div>
                                            <ul>
                                                @foreach($value->bienban as $lop => $noidungbienban)

                                                    @if($noidungbienban == null)
                                                        <li>
                                                            {{$lop}} Chưa nộp biên bản
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else

                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <li class="@if($value->bienban->xacnhan_loptruong && $value->bienban->xacnhan_bithu && $value->bienban->xacnhan_gvcn) hoanthanh @else choxacminh @endif">--}}
{{--        <h6>Họp lớp tháng {{$value->thang_text}}</h6><a class="ml-2"--}}
{{--                                                        href="{{route('sv.hoplop.xembienban', ['id' => $value->bienban->id])}}"><i--}}
{{--                    class="fas fa-eye mr-1"></i>Xem</a><a--}}
{{--                href="{{route('sv.hoplop.suabienban', ['id' => $value->bienban->id])}}"><i--}}
{{--                    class="fas fa-pen mr-1 ml-2"></i>Sửa</a></li>--}}
@endsection
