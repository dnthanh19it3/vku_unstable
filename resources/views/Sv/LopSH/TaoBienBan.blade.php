@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        </div>
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Biên bản họp lớp tháng {{(int)$thang}}</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" action="{{route('sv.hoplop.taobienban.store')}}">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="thoigianhop" class="col-3 col-form-label">Thời gian họp</label>
                            <div class="col-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                    <input id="thang" name="thang" type="text" class="form-control" hidden value="{{$thang}}">
                                    <input id="thoigianhop" name="thoigianhop" type="datetime-local" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="diadiem" class="col-3 col-form-label">Địa điểm</label>
                            <div class="col-9">
                                <input id="diadiem" name="diadiem" placeholder="Địa điểm họp" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="chuongtrinh" class="col-3 col-form-label">Chương trình cuộc họp</label>
                            <div class="col-9">
                                <textarea id="chuongtrinh" name="chuongtrinh" cols="40" rows="5" required="required" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="noidung" class="col-3 col-form-label">Nội dung triển khai</label>
                            <div class="col-9">
                                <textarea id="noidung" name="noidung" cols="40" rows="5" required="required" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gopy" class="col-3 col-form-label">Nội dung góp ý</label>
                            <div class="col-9">
                                <textarea id="gopy" name="gopy" cols="40" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nhanxet_gvcn" class="col-3 col-form-label">Giảng viên chủ nhiệm nhận xét</label>
                            <div class="col-9">
                                <textarea id="nhanxet_gvcn" name="nhanxet_gvcn" cols="40" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-3 col-9">
                                <button name="submit" type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            .create( document.querySelector( '#nhanxet_gvcn' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
