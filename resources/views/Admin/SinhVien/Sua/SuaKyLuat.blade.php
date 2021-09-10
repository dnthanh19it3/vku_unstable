@extends('layout.admin_layout')
@section('header')
@endsection
@section('body')
        <div class="row bg-white">
            <div class="col-md-12 profile-mainpanel">
                <h5>Sửa kỷ luật</h5>
                <hr/>
                <form id="khenthuong-form" action="{{route('ad.suasinhvien.suakyluat.store', ['masv' => $sinhvien->masv, 'id' => $kyluat->id])}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="capquyetdinh" class="col-3 col-form-label">Cấp quyết định</label>
                        <div class="col-9">
                            <input class="form-control rounded" id="capquyetdinh" name="capquyetdinh" type="text" class="form-control" value="{{$kyluat->capquyetdinh}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="soquyetdinh" class="col-3 col-form-label">Quyết định số</label>
                        <div class="col-9">
                            <input class="form-control rounded" id="soquyetdinh" name="soquyetdinh" type="text" class="form-control" value="{{$kyluat->soquyetdinh}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                        <div class="col-9">
                            <input class="form-control rounded" id="noidung" name="noidung" type="text" class="form-control" value="{{$kyluat->noidung}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                        <div class="col-9">
                            <input class="form-control rounded" id="hinhthuckyluat" name="hinhthuckyluat" type="text" class="form-control" value="{{$kyluat->hinhthuckyluat}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-3 col-form-label">Thời gian</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input class="form-control rounded" id="thoigian" name="thoigian" type="date" class="form-control" value="{{$kyluat->thoigian}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-3 col-9">
                            <button name="submit" type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
@endsection
