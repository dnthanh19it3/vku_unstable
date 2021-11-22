@extends('layout.admin_layout')
@section('title', 'Xem biên bản')
@section('header')
@endsection
@section('body')
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="bg-white p-3">
                <div class="row">
                   <div class="col-md-7">
                       <h5 class="pb-0"><i class="fas fa-file mr-2"></i>BIÊN BẢN HỌP LỚP {{$data->tenlop}} THÁNG {{$data->thang}} NĂM HỌC {{$data->nambatdau."-".$data->namketthuc}}</h5>
                   </div>
                    <div class="col-md-5  d-flex justify-content-end">
                        <!--Nút duyệt GVCN-->
                        @if(!$data->xacnhan_khoa)
                            @if($data->xacnhan_gvcn)
                                <a href="{{route('admin.hoplop.duyet.gvcn', ['id' => $data->id])}}" class="btn btn-danger"><i class="fas fa-check-circle mr-2"></i>Bỏ duyệt biên bản (GVCN)</a>
                            @else
                                <a href="{{route('admin.hoplop.duyet.gvcn', ['id' => $data->id])}}" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i>Duyệt biên bản (GVCN)</a>
                            @endif
                        @endif
                        <!--Nút duyệt Khoa-->
                        @if(!$data->xacnhan_ctsv && $data->xacnhan_bithu && $data->xacnhan_loptruong && $data->xacnhan_gvcn)
                            @if($data->xacnhan_khoa)
                                <a href="{{route('admin.hoplop.duyet.khoa', ['id' => $data->id])}}" class="btn btn-danger"><i class="fas fa-check-circle mr-2"></i>Bỏ duyệt biên bản (Khoa)</a>
                            @else
                                <a href="{{route('admin.hoplop.duyet.khoa', ['id' => $data->id])}}" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i>Duyệt biên bản (Khoa)</a>
                            @endif
                        @endif
                        <!--Nút duyệt CTSV-->
                        @if($data->xacnhan_khoa)
                            @if($data->xacnhan_ctsv)
                                <a href="{{route('admin.hoplop.duyet.ctsv', ['id' => $data->id])}}" class="btn btn-danger"><i class="fas fa-check-circle mr-2"></i>Bỏ duyệt biên bản (CTSV)</a>
                            @else
                                <a href="{{route('admin.hoplop.duyet.ctsv', ['id' => $data->id])}}" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i>Duyệt biên bản (CTSV)</a>
                            @endif
                        @endif
                        <!--Nút duyệt BGH-->
                        @if($data->xacnhan_khoa)
                            @if($data->xacnhan_bgh)
                                <a href="{{route('admin.hoplop.duyet.bgh', ['id' => $data->id])}}" class="btn btn-danger"><i class="fas fa-check-circle mr-2"></i>Bỏ duyệt biên bản (BGH)</a>
                            @else
                                <a href="{{route('admin.hoplop.duyet.bgh', ['id' => $data->id])}}" class="btn btn-primary"><i class="fas fa-check-circle mr-2"></i>Duyệt biên bản (BGH)</a>
                            @endif
                        @endif

                   </div>
                </div>
            </div>
        </div>
    </div>
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
                    <div class="row ml-3 mb-2">
                        <div class="col-md-4"><h6>{{$item->chucvu}}</h6></div>
                        <div class="col-md-8"><img src="{{asset($item->avatar)}}" style="object-fit: cover;width: 32px;height: 32px; border-radius: 999px;margin-right: 16px" alt="">{{$item->hodem." ".$item->ten}}</div>
                    </div>
                @endforeach
            </div>
            <div class="bg-white p-3 mb-3">
                <h6><i class="fas fa-file-signature mr-2"></i>Xác nhận</h6>
                <hr/>
                <div class="row ml-3">
                    <div class="col-6"><h6>Lớp trưởng</h6></div>
                    <div class="col-6">@if($data->xacnhan_loptruong) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
                </div>
                <div class="row ml-3">
                    <div class="col-6"><h6>Bí thư</h6></div>
                    <div class="col-6">@if($data->xacnhan_bithu) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
                </div
                ><div class="row ml-3">
                    <div class="col-6"><h6>GVCN</h6></div>
                    <div class="col-6">@if($data->xacnhan_gvcn) <i class="fas fa-check-circle"></i> @else <i class="fas fa-times-circle"></i> @endif</div>
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
                    <div class="col-md-12 ml-3 border-bottom"><p>{!! $data->gopy ? $data->gopy : "Không có nội dung thảo luận" !!}</p></div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Góp ý của GVCN</h6></div>
                    <div class="col-md-12 mb-2 ml-3 border-bottom"><p>{!! $data->gvcn_nhanxet ? $data->gopy : "Không có góp ý GVCN" !!}</p></div>
                </div>
            </div>
            <div class="bg-white p-3 pr-6 mb-3">
                <h6><i class="fas fa-comment-dots mr-2"></i>Phản hồi</h6>
                <hr/>
                <div class="phan-hoi-info pl-3 mb-3">
                    @if($data->phanhoi != null)
                        <div class="trang-thai-badge trang-thai-badge-open">
                            <i class="fas fa-check-circle mr-2"></i>Đã phản hồi
                        </div>
                        <a href="javascript:void(0)" id="btn_suaphanhoi" class="trang-thai-badge trang-thai-badge-open bg-primary text-white"><i class="fas fa-edit mr-1"></i>Sửa phản hồi</a>
                    @else
                        <div class="trang-thai-badge trang-thai-badge-close">
                            Chờ phản hồi
                        </div>
                    @endif
                    <div class="lop">
                        {{$data->thoigianphanhoi != null ? \Carbon\Carbon::make($data->thoigianphanhoi)->diffForHumans() : ""}}
                    </div>
                </div>
                <div class="row hoplop-content" id="phanhoi_text">
                    <div class="col-md-12">
                        <h6>Nội dung phản hồi</h6>
                    </div>
                    <div class="col-md-12 mb-2 ml-3">
                        {!! $data->phanhoi ? $data->phanhoi : "Không có phản hồi!" !!}
                    </div>
                </div>
                @if(!$data->phanhoi)
                    <form id="form_phanhoi" method="post" action="{{route('ad.hoplop.phanhoi', ['id' => $data->id])}}" class="row ml-3 mb-3">
                        {{csrf_field()}}
                        <div class="col-12 mb-3 border p-3 rounded">
                            <h6><i class="fas fa-edit mr-2"></i>Phản hồi</h6>
                            <textarea name="phanhoi" id="phanhoi" class="form-control" rows="5">{!! $data->phanhoi !!}</textarea>
                            <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Lưu phản hồi</button>
                        </div>
                    </form>
                @endif
                <form id="form_suaphanhoi" method="post" action="{{route('ad.hoplop.phanhoi', ['id' => $data->id])}}" class="row ml-3 mb-3">
                    {{csrf_field()}}
                    <div class="col-12 mb-3 border p-3 rounded">
                        <h6><i class="fas fa-edit mr-2"></i>Sửa phản hồi</h6>
                        <textarea name="phanhoi" id="suaphanhoi" class="form-control" rows="5">{!! $data->phanhoi !!}</textarea>
                        <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Sửa phản hồi</button>
                    </div>
                </form>
            </div>
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
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#phanhoi' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#suaphanhoi' ) )
            .catch( error => {
                console.error( error );
            } );
        $('#form_suaphanhoi').hide();
        $('#btn_suaphanhoi').click(function (){
            $('#form_suaphanhoi').show();
            $('#btn_suaphanhoi').hide();
            $('#phanhoi_text').hide();
        })
    </script>
@endsection