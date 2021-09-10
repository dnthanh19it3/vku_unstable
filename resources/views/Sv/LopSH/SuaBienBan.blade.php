@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <form method="post" action="{{route('sv.hoplop.suabienban.update', ['id' => $data->id])}}" class="row mb-3">
        {{ csrf_field() }}
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
                    <div class="col-md-6">
                        <h6>Thời gian họp</h6></div>
                    <div class="col-md-6">
                        {{$data->thoigianhop}}
                    </div>
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
                <h6><i class="fas fa-file-signature mr-2"></i>Thông tin điểm danh</h6>
                <hr/>
            </div>
        </div>

        <div class="col-md-9">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-white p-3 pr-6 mb-3">
                <h6><i class="fas fa-file-alt mr-2"></i>Nội dung thực hiện</h6>
                <hr/>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Chương trình họp</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="chuongtrinh" name="chuongtrinh" cols="40" rows="5" class="form-control">{{$data->chuongtrinh}}</textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Nội dung triển khai</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="noidung" name="noidung" cols="40" rows="5" class="form-control">{{$data->noidung}}</textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Thảo luận và góp ý</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="gopy" name="gopy" cols="40" rows="5" class="form-control">{{$data->gopy}}</textarea>
                    </div>
                </div>
                <div class="row hoplop-content">
                    <div class="col-md-12"><h6>Góp ý của GVCN</h6></div>
                    <div class="col-md-12 mb-2 ml-3">
                        <textarea id="gvcn_nhanxet" name="gvcn_nhanxet" cols="40" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row p-3">
                    <button type="submit" class="btn btn-primary w-100 ">SỬA BIÊN BẢN</button>
                </div>
            </div>
        </div>
    </form>















    ///
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="x_panel">--}}
{{--                <div class="x_title">--}}
{{--                    <h5>Sửa biên bản họp lớp tháng {{(int) $data->thang}}</h5>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <form method="post" action="{{route('sv.hoplop.suabienban.update', ['id' => $data->id])}}">--}}
{{--                        {{ csrf_field() }}--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="thoigianhop" class="col-3 col-form-label">Thời gian họp</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <div class="input-group">--}}
{{--                                    <div class="input-group-prepend">--}}
{{--                                        <div class="input-group-text">--}}
{{--                                            <i class="fa fa-calendar"></i>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <input id="thoigianhop" name="thoigianhop" type="datetime-local" class="form-control" value="{{Carbon\Carbon::make($data->thoigianhop)->format('Y-m-d')."T".Carbon\Carbon::make($data->thoigianhop)->format('h:s')}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="diadiem" class="col-3 col-form-label">Địa điểm</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <input id="diadiem" name="diadiem" placeholder="Địa điểm họp" type="text" class="form-control" value="{{$data->diadiem}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="chuongtrinh" class="col-3 col-form-label">Chương trình cuộc họp</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <textarea id="chuongtrinh" name="chuongtrinh" cols="40" rows="5" required="required" class="form-control"> {{$data->chuongtrinh}}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="noidung" class="col-3 col-form-label">Nội dung triển khai</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <textarea id="noidung" name="noidung" cols="40" rows="5" required="required" class="form-control">{{$data->noidung}}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="gopy" class="col-3 col-form-label">Nội dung góp ý</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <textarea id="gopy" name="gopy" cols="40" rows="5" class="form-control">{{$data->gopy}}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="nhanxet_gvcn" class="col-3 col-form-label">Giảng viên chủ nhiệm nhận xét</label>--}}
{{--                            <div class="col-9">--}}
{{--                                <textarea id="nhanxet_gvcn" name="nhanxet_gvcn" cols="40" rows="5" class="form-control">{{$data->gvcn_nhanxet}}</textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <div class="offset-3 col-9">--}}
{{--                                <button name="submit" type="submit" class="btn btn-primary">Cập nhật</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('custom-script')
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector('#chuongtrinh' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#noidung' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#gopy' ) )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#gvcn_nhanxet' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
