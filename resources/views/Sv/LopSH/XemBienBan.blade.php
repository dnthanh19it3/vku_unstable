@extends('layout.sv_layout')
@section('body')
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-info-circle mr-2"></i>Thông tin biên bản</h6>
                <hr/>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Lớp sinh hoạt</h6></div>
                    <div class="col-md-6">{{$data->tenlop}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Năm học</h6></div>
                    <div class="col-md-6">{{$data->nambatdau."-".$data->namketthuc}}</div>
                </div
                ><div class="row ml-3">
                    <div class="col-md-6"><h6>Học kỳ</h6></div>
                    <div class="col-md-6">{{$data->hocky}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Tháng</h6></div>
                    <div class="col-md-6">{{$data->thang}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Thời gian họp</h6></div>
                    <div class="col-md-6">{{$data->thoigianhop}}</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Thời gian nộp</h6></div>
                    <div class="col-md-6">{{$data->created_at}}</div>
                </div>
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-user-check mr-2"></i>Thành phần tham dự</h6>
                <hr/>
                @foreach($bancansu as $key => $item)
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>{{$item->chucvu}}</h6></div>
                        <div class="col-md-8"><img src="{{asset($item->avatar)}}" style="object-fit: cover;width: 32px;height: 32px; border-radius: 999px;margin-right: 16px" alt="">{{$item->hodem." ".$item->ten}}</div>
                    </div>
                @endforeach
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-file-signature mr-2"></i>Xác nhận</h6>
                <hr/>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Lớp trưởng</h6></div>
                    <div class="col-md-6">@if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>Bí thư</h6></div>
                    <div class="col-md-6">@if($data->xacnhan_bithu) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i>@endif</div>
                </div>
                <div class="row ml-3">
                    <div class="col-md-6"><h6>GVCN</h6></div>
                    <div class="col-md-6">@if($data->xacnhan_gvcn) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        @if($data->xacnhan_khoa != 1)
                            @foreach($bancansu as $key => $item)
                                @if($item->masv == session('masv'))
                                    @php $array_data = (array) $data @endphp
                                    @if(!$array_data['xacnhan_'.$item->chucvu_slug])
                                        <a href="{{route('sv.hoplop.xacnhan', ['id' => $data->id, 'role' => $item->chucvu_slug])}}" class="btn btn-sm btn-primary w-100"><i class="fas fa-check-circle mr-2"></i>{{$item->chucvu}} xác nhận</a>
                                    @else
                                        <a href="{{route('sv.hoplop.xacnhan', ['id' => $data->id, 'role' => $item->chucvu_slug])}}" class="btn btn-sm btn-danger w-100"><i class="fas fa-times-circle mr-2"></i>{{$item->chucvu}} huỷ xác nhận</a>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-file-signature mr-2"></i>Thông tin điểm danh</h6>
                <hr/>
            </div>
        </div>

        <div class="col-md-9">
            <div class="bg-white p-3 pr-6 mb-3">
                <h6><i class="fas fa-file-alt mr-2"></i>Nội dung thực hiện</h6>
                <hr/>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Chương trình họp</h6></div>
                    <div class="col-md-12 mb-2 ml-3 border-bottom">{!! $data->chuongtrinh !!}</div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Nội dung triển khai</h6></div>
                    <div class="col-md-12 mb-2 ml-3 border-bottom">{!! $data->noidung !!}</div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Thảo luận và góp ý</h6></div>
                    <div class="col-md-12 mb-2 ml-3 border-bottom">{!! $data->gopy ? $data->gopy : "Không có góp ý" !!}</div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Góp ý của GVCN</h6></div>
                    <div class="col-md-12 mb-2 ml-3 border-bottom">{!! $data->gvcn_nhanxet ? $data->gopy : "Không có góp ý" !!}</div>
                </div>
            </div>
            <div class="bg-white p-3 pr-6 mb-3">
                <h6><i class="fas fa-comment-dots mr-2"></i>Phản hồi từ nhà trường</h6>
                <hr/>
                <div class="phan-hoi-info pl-3">
                    @if($data->phanhoi != null)
                        <div class="trang-thai-badge trang-thai-badge-open">
                            Đã phản hồi
                        </div>
                    @else
                        <div class="trang-thai-badge trang-thai-badge-close">
                            Chờ phản hồi
                        </div>
                    @endif
                    <div class="lop">
                        {{$data->thoigianphanhoi != null ? \Carbon\Carbon::make($data->thoigianphanhoi)->diffForHumans() : ""}}
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Nội dung phản hồi</h6></div>
                    <div class="col-md-12 mb-2 ml-3">{!! $data->phanhoi ? $data->phanhoi : "Không có phản hồi!" !!}</div>
                </div>
            </div>
            <!-- Xác nhận -->
            <div class="bg-white p-3">
                <h6><i class="fas fa-signature mr-2"></i>Xác nhận</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        @if($data->xacnhan_khoa)
                            <div class="text-center" style="font-size: 32px"><i class="far fa-check-circle"></i></div>
                            <div class="text-center">Khoa: Đã duyệt</div>
                        @else
                            <div class="text-center" style="font-size: 32px"><i class="far fa-times-circle"></i></div>
                            <div class="text-center">Khoa: Chưa duyệt</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if($data->xacnhan_ctsv)
                            <div class="text-center" style="font-size: 32px"><i class="far fa-check-circle"></i></div>
                            <div class="text-center">CTSV: Đã duyệt</div>
                        @else
                            <div class="text-center" style="font-size: 32px"><i class="far fa-times-circle"></i></div>
                            <div class="text-center">CTSV: Chưa duyệt</div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if($data->xacnhan_bgh)
                            <div class="text-center" style="font-size: 32px"><i class="far fa-check-circle"></i></div>
                            <div class="text-center">BGH: Đã duyệt</div>
                        @else
                            <div class="text-center" style="font-size: 32px"><i class="far fa-times-circle"></i></div>
                            <div class="text-center">BGH: Chưa duyệt</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection