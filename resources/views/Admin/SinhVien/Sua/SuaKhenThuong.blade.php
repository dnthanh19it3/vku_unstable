@extends('layout.admin_layout')
@section('title', 'Sửa khen thưởng')
@section('header')
@endsection
@section('body')
    <div class="col-md-12">
        <div class="row bg-white">
            <div class="col-md-3 profile-leftpanel pr-md-3 border-right">
                @include('Admin.SinhVien.Sua.Menu', ['index' => 3])
            </div>
            <div class="col-md-9 profile-mainpanel">
                <h5>Khen thưởng</h5>
                <form id="khenthuong-form" action="{{route('ad.suasinhvien.suakhenthuong.store', ['masv' => $sinhvien->masv, 'id' => $khenthuong->id])}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="capkhenthuong" class="col-3 col-form-label">Cấp khen thưởng</label>
                        <div class="col-9">
                            <input id="capkhenthuong" name="capkhenthuong" type="text" class="form-control" value="{{$khenthuong->capkhenthuong}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="soquyetdinh" class="col-3 col-form-label">Quyết định số</label>
                        <div class="col-9">
                            <input id="soquyetdinh" name="soquyetdinh" type="text" class="form-control" value="{{$khenthuong->soquyetdinh}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                        <div class="col-9">
                            <input id="noidung" name="noidung" type="text" class="form-control" value="{{$khenthuong->noidung}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-3 col-form-label">Thời gian</label>
                        <div class="col-9">
                            <div class="input-group">
                                <input id="thoigian" name="thoigian" type="date" class="form-control" value="{{$khenthuong->thoigian}}">
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
    </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
@endsection
