@extends('layout.admin_layout')
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
                        <div class="col-md-8">{{\Carbon\Carbon::make($data->thoigianhop)->format('d-m-Y     h:m')}}</div>
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