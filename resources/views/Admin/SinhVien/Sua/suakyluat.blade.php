@extends('layout.admin_layout')
@section('title', 'Sửa khen thưởng')
@section('header')
@endsection
@section('body')
    <!-- NEW -->
    <style>
        .mr-2{margin-right: 8px}
        .ml-1{margin-left: 1px}
        .mr-1{margin-right: 1px}
        .mb-3{margin-bottom: 8px}
    </style>
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            @if($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Có lỗi xảy ra
                            <ol style="">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            @endif
            <div class="tab-content" style="height: 100%">
                <div class="tab-pane active" id="canhan">
                    <div class="profile_main_block p-4 bg-white">
                        <h4 style="display: flex; flex-direction: row; align-items: center"><img src="{{$sinhvien_static->anhthe}}" class="avatar mr-2" style="border-radius: 99px"/> Sửa kỷ luật - {{$sinhvien_static->hodem . " " . $sinhvien_static->ten . " (" . $sinhvien_static->masv . ")"}}</h4>
                        <hr/>
                        <form id="khenthuong-form" action="{{route('ad.suasinhvien.suakyluat.store', ['masv' => $sinhvien->masv, 'id' => $kyluat->id])}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-xs-12 col-lg-12">
                                    <label for="capkhenthuong" class="col-form-label">Cấp quyết định</label>
                                    <input class="form-control rounded" id="capquyetdinh" name="capquyetdinh" type="text" class="form-control" value="{{$kyluat->capquyetdinh}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 col-xs-12">
                                    <label for="soquyetdinh" class="col-3 col-form-label">Quyết định số</label>
                                    <input class="form-control rounded" id="soquyetdinh" name="soquyetdinh" type="text" class="form-control" value="{{$kyluat->soquyetdinh}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12 col-lg-12">
                                    <label for="noidung" class="col-3 col-form-label">Nội dung</label>
                                    <input id="noidung" name="noidung" type="text" class="form-control rounded" value="{{$kyluat->noidung}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12 col-lg-12">
                                    <label for="noidung" class="col-3 col-form-label">Hình thức</label>
                                    <input class="form-control rounded" id="hinhthuckyluat" name="hinhthuckyluat" type="text" class="form-control" value="{{$kyluat->hinhthuckyluat}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12 col-lg-4">
                                    <label for="thoigian" class="col-3 col-form-label">Năm học</label>
                                    <div class="col-9">
                                        <select name="namhoc" class="form-control rounded">
                                            @foreach($namhoc_hocky as $key => $value)
                                                <option value="{{$value->id}}" {{$value->id == $kyluat->namhoc ? "selected" : ""}}>{{$value->nambatdau."-".$value->namketthuc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-2">
                                    <label for="thoigian" class="col-3 col-form-label">Học kỳ</label>
                                    <div class="col-9">
                                        <select name="hocky" class="form-control rounded">
                                            <option value="1" {{1 == $kyluat->hocky ? "selected" : ""}}>Học kỳ 1</option>
                                            <option value="2" {{2 == $kyluat->hocky ? "selected" : ""}}>Học kỳ 2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6">
                                    <label for="thoigian" class="col-3 col-form-label">Thời gian</label>
                                    <div class="col-9">
                                        <input id="thoigian" name="thoigian" type="date" class="form-control rounded" value="{{$kyluat->thoigian}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-3 col-xs-12 col-lg-12">
                                    <button name="submit" type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Lưu</button>
                                    <a class="btn btn-default" href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}"><i class="fa fa-step-backward mr-2"></i>Quay lại</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                #leftmenu > li.active > a {
                    border-left: 2px solid #5b9bd1;
                    border-radius: unset;
                    background: #f6f9fb !important;
                    color: #5b9bd1 !important;
                }
                .equal {
                    display: flex;
                    display: -webkit-flex;
                    flex-wrap: wrap;
                }
                @media (min-width: 768px) {
                    .row.equal {
                        display: flex;
                        flex-wrap: wrap;
                    }
                }
                .margin-bottom-3px {
                    margin-bottom: 3px;
                }
                .profile_main_block {
                    background: #fff;
                    padding: 2rem;
                    margin-bottom: 1rem;
                }
                .title-text {
                    font-weight: 500;
                    font-size: 16px;
                    margin-bottom: 3px;
                }
                .rounded {
                    border-radius: 4px;
                }

            </style>
        </div>
    </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
@endsection
