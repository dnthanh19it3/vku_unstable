@extends('layout.admin_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    @php use Carbon\Carbon;Carbon::setLocale('vi') @endphp
    <div class="row">
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Tổng hợp phản hồi</h6>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <ul>
                        @foreach($months as $value)
                            <li><a href="{{route('ad.hoplop.tonghopphanhoi', ['thang' => $value])}}">Tháng {{$value}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách phản hồi</h6>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <h6>Tháng {{$thang}}, học kỳ {{$kyhoc_hienhanh->hocky}} năm
                        học {{$kyhoc_hienhanh->nambatdau . " - " . $kyhoc_hienhanh->namketthuc}}</h6>
                    <div class="row">
                        <div class="col-md-12">
                            @foreach($arrayMonth as $key => $value)
                                @if(isset($value->bienban))
                                    @foreach($value->bienban as $lop => $noidungbienban)

                                        @if($noidungbienban != null && $noidungbienban->gopy != null)
                                            <div class="phan-hoi-info pl-3">
                                                <div class="ma-phan-hoi">
                                                    {{$lop}}
                                                </div>
                                                @if($noidungbienban->phanhoi != null)
                                                <div class="trang-thai-badge trang-thai-badge-open">
                                                    Đã phản hồi
                                                </div>
                                                @else
                                                    <div class="trang-thai-badge trang-thai-badge-close">
                                                       Chờ phản hồi
                                                    </div>
                                                @endif
                                                <div class="lop">
                                                     {{\Carbon\Carbon::make($noidungbienban->thoigianhop)->diffForHumans()}}
                                                </div>
                                            </div>
                                            <div class="phan-hoi-content mt-3 ml-3">
                                                <div class="gopy-lop">
                                                    {!! $noidungbienban->gopy !!}
                                                    <div class="phan-hoi-nha-truong">
                                                        @if($noidungbienban->phanhoi != null)
                                                            <div class="title">
                                                                <i class="fas fa-share mr-2"></i>Phản hồi từ {{"phòng abc"}}
                                                            </div>
                                                            <div class="content">
                                                                {!! $noidungbienban->phanhoi !!}
                                                            </div>
                                                        @else
                                                            <div class="title">
                                                                <i class="far fa-clock mr-2"></i>Đang chờ phản hồi
                                                                <a href="{{route('admin.hoplop.xembienban', ['id' => $noidungbienban->id])}}" class="btn btn-primary btn-sm ml-2">Phản hồi</a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
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
    </script>
@endsection
