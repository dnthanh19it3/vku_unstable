@extends('layout.admin_layout')
@section('title', 'Đề xuất nội dung')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <form id="fillter" class="bg-white p-3 mb-3" method="get" action="{{route('ad.hoplop.linklistdukien')}}">
                <h6><i class="fas fa-graduation-cap mr-2"></i>Năm học</h6>
                <select id="namhoc" name="namhoc" class="form-control rounded">
                    @foreach($list_kyhoc as $key => $value)
                        <option value="{{$value->id}}" {{$selected['namhoc'] == $value->id ? "selected" : ""}}>Năm học {{$value->nambatdau . "-" .$value->namketthuc    }}</option>
                    @endforeach
                </select>
                <hr/>
                <h6 class="mt-3"><i class="fas fa-calendar-day mr-2"></i>Học kỳ</h6>
                <select id="hocky" name="hocky" class="form-control rounded mb-3">
                    <option readonly="">Học kỳ</option>
                    <option value="1" {{$selected['hocky'] == 1 ? "selected" : ""}}>HK1</option>
                    <option value="2" {{$selected['hocky'] == 2 ? "selected" : ""}}>HK2</option>
                </select>
                <button id="btn" class="btn btn-sm btn-success w-100">Chọn học kỳ</button>
            </form>
            <div class="bg-white p-3 mb-3">
                <h6 class="mt-3"><i class="fas fa-calendar-check mr-2"></i>Tháng</h6>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($months as $value)
                        <a class="nav-link{{$selected['thang'] == $value ? " active" : ""}}" id="account-tab"
                           href="{{route('ad.hoplop.noidungdukien', ['namhoc' => $selected['namhoc'], 'hocky' => $selected['hocky'], 'thang' => $value])}}">
                            <span style="display:inline-block;color: white; background: #5b9bd1; border-radius: 999px;padding:8px;width: 32px;height: 32px;font-weight: 600;text-align: center;">{{(int)$value}}</span>
                            Tháng {{$value}}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h6><i class="fas fa-list mr-2"></i>Nội dung đề xuất tháng {{$selected['thang']}}</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-12">
                        @if($noidung)
                            <div id="info_block">
                                <p>{!! $noidung->noidung !!}</p>
                                <div class="pl-3 mb-3"><a href="javascript:void(0)" id="btn_taomoi" class="btn btn-primary btn-sm">Chỉnh sửa</a></div>
                            </div>
                            <form id="form" method="post" action="{{route('ad.hoplop.noidungdukien.capnhat', ['id' => $noidung->id])}}" class="row ml-3 mb-3 d-none">
                                {{csrf_field()}}
                                <div class="col-12 mb-3 border p-3 rounded">
                                    <h6><i class="fas fa-edit mr-2"></i>Sửa nội dung đề xuất</h6>
                                    <textarea name="noidung" id="noidung" class="form-control" rows="5">{!! $noidung->noidung !!}</textarea>
                                    <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Lưu</button>
                                </div>
                            </form>
                        @else
                            <div id="info_block">
                                <p>Chưa có đề xuất tháng này!</p>
                                <div class="pl-3 mb-3"><a href="javascript:void(0)" id="btn_taomoi" class="btn btn-primary btn-sm">Tạo mới</a></div>
                            </div>
                            <form id="form" method="post" action="{{route('ad.hoplop.noidungdukien.tao', ['namhoc' => $selected['namhoc'], 'hocky' => $selected['hocky'], 'thang' => $selected['thang']])}}" class="row ml-3 mb-3 d-none">
                                {{csrf_field()}}
                                <div class="col-12 mb-3 border p-3 rounded">
                                    <h6><i class="fas fa-edit mr-2"></i>Tạo nội dung đề xuất</h6>
                                    <textarea name="noidung" id="noidung" class="form-control" rows="5"></textarea>
                                    <button class="btn btn-primary btn-sm mt-3"><i class="fas fa-save mr-2"></i>Lưu</button>
                                </div>
                            </form>
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
            .create( document.querySelector( '#noidung' ) )
            .catch( error => {
                console.error( error );
            } );

        $('#btn_taomoi').click(function (){
            $('#form').removeClass('d-none');
            $('#info_block').addClass('d-none');
        })
    </script>
@endsection




