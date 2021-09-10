@extends('layout.admin_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
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
                    <div class="col-md-6">@if($data->xacnhan_bithu) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
                </div
                ><div class="row ml-3">
                    <div class="col-md-6"><h6>GVCN</h6></div>
                    <div class="col-md-6">@if($data->xacnhan_gvcn) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
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
                    @if($data->phanhoi_nhatruong != null)
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
                    <div class="col-md-12 mb-2 ml-3">{!! $data->phanhoi_nhatruong ? $data->phanhoi_nhatruong : "Không có phản hồi!" !!}</div>
                </div>
            </div>
        </div>
    </div>












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
                        <div class="col-md-8">{{\Carbon\Carbon::make($data->thoigianhop)->format('d-m-Y     h:m')}}</div>
                    </div>
                    <hr/>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Xác nhận</h6></div>
                        <div class="col-md-8">
                            <div class="row">
{{--                                <div class="col-md-12">Lớp trưởng: {{$bancansu->loptruong->hodem . ' ' . $bancansu->loptruong->ten}} @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>--}}
{{--                                <div class="col-md-12">Bí thư: {{$bancansu->bithu->hodem . ' ' . $bancansu->bithu->ten}} @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>--}}
{{--                                <div class="col-md-12">GVCN @if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else Chưa xác nhận @endif</div>--}}
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
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Chương trình họp</h6></div>
                        <div class="col-md-8">{!! $data->chuongtrinh !!}</div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Nội dung họp</h6></div>
                        <div class="col-md-8">{!! $data->noidung !!}</div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Thảo luận và góp ý</h6></div>
                        <div class="col-md-8">{!! $data->gopy !!}</div>
                    </div>
                    <div class="row ml-3">
                        <div class="col-md-4"><h6>Nhận xét GVCN</h6></div>
                        <div class="col-md-8">{!! $data->gvcn_nhanxet !!}</div>
                    </div>
                    <hr/>
                    <h6>Phản hồi</h6>
                    @if($data->phanhoi_nhatruong)
                        <div class="ml-3">
                                {!! $data->phanhoi_nhatruong !!}
                        </div>
                    @else
                        <form id="form_phanhoi" method="post" action="{{route('ad.hoplop.phanhoi', ['id' => $data->id])}}" class="row ml-3 mb-3">
                            {{csrf_field()}}
                            <div class="col-12 mb-3">
                                <textarea name="phanhoi" id="phanhoi" class="form-control" rows="5"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary btn-sm">Phản hồi</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#phanhoi' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection