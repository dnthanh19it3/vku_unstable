@extends('layout.sv_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-lg-3 col-xs-12" style="margin-bottom: 1rem">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img id="avatar_round" src="{{$sinhvien->avatar}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{$sinhvien->hodem." ".$sinhvien->ten}}
                    </div>
                    <div class="profile-usertitle-job">
                        NGÀNH {{$sinhvien->tennganh}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{$sinhvien->tenlop}} MSV {{$sinhvien->masv}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <div class="profile-usermenu">
                        <ul class="nav nav-pills nav-stacked" id="leftmenu">
                            <li class="active"><a href="#canhan" data-toggle="tab">Thông tin cá nhân</a></li>
                            <li><a href="#giadinh" data-toggle="tab">Thông tin gia đình</a></li>
                            <li><a href="#diachi" data-toggle="tab">Địa chỉ và thường trú</a></li>
                            <li><a href="#lienhe" data-toggle="tab">Thông tin liên hệ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <form class="col-lg-9 col-xs-12" method="post" action="{{route('suahosoStore')}}">
            {{@csrf_field()}}
            @if ($errors->any())
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
                {{@csrf_field()}}
                <div class="tab-content" style="height: 100%">
                    <div class="tab-pane active" id="canhan">
                        <div class="profile_main_block p-4 bg-white">
                            <h4><i class="fas fa-info-circle mr-2"></i>Thông tin cá nhân</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Họ và tên</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->hodem." ".$sinhvien->ten}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Giới tính</div>
                                    <select type="text" class="form-control rounded" selected="{{$sinhvien->gioitinh}}" disabled>
                                        <option value="0" {{$sinhvien->gioitinh ? "" : "selected"}}>Nữ</option>
                                        <option value="1" {{$sinhvien->gioitinh ? "selected" : ""}}>Nam</option>
                                    </select>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Ngày sinh</div>
                                    <input type="text" class="form-control rounded" value="{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-xs-12 form-group">
                                    <div class="title-text">Nơi sinh</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->noisinh}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Dân tộc</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">CMND/CCCD</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Ngày cấp</div>
                                    <input type="date" class="form-control rounded" value="{{$sinhvien->ngaycap}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Nơi cấp</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->noicap}}" disabled/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Đoàn thể</div>
                                    <input type="text" class="form-control rounded" value="{{getTruongTinh('doanthe', $sinhvien)}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Ngày kết nạp</div>
                                    <input type="date" class="form-control rounded" value="{{$sinhvien->ngayketnap}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Tôn giáo</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->tongiao}}" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="giadinh">
                        <div class="profile_main_block p-4 bg-white">
                            <h4><i class="fas fa-users mr-2"></i>Thông tin gia đình</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <h4 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h4>
                                    <div class="form-group">
                                        <div class="title-text">Họ tên</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->hotencha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Ngày sinh</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhcha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Dân tộc</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_cha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">CMND/CCCD</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_cha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Nghề nghiệp</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_cha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Nơi ở</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_cha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Email</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->email_cha}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">SĐT</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_cha}}" disabled/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h4>
                                    <div class="form-group">
                                        <div class="title-text">Họ tên</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->hotenme}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Ngày sinh</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhme}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Dân tộc</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_me}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">CMND/CCCD</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_me}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Nghề nghiệp</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_me}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Nơi ở</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_me}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">Email</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->email_me}}" disabled/>
                                    </div>
                                    <div class="form-group">
                                        <div class="title-text">SĐT</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_me}}" disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h4>
                                    <div class="form-group">
                                        <div class="title-text">Anh chị em</div>
                                        <input type="text" class="form-control rounded" value="{{$sinhvien->thanhphangiadinh}}" disabled/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="diachi">
                        <div class="profile_main_block">
                            <h4><i class="fas fa-map-marker-alt mr-2"></i>Thường trú và địa chỉ</h4>
                            <hr/>
                            <i>Hộ khẩu thường trú</i>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Thôn tổ</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->thon_to}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Xã phường</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->xa_phuong}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Quận huyện</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->quan_huyen}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Tỉnh/ Thành phố</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->tinh_thanh}}" disabled/>
                                </div>
                            </div>
                            <i>Địa chỉ liên lạc</i>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="title-text">Địa chỉ</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dia_chi_lien_lac}}" disabled/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="lienhe">
                        <div class="profile_main_block p-4 bg-white">
                            <h4><i class="fas fa-address-card mr-2"></i>Thông tin liên hệ</h4>
                            <hr/>
                            <i>Hộ khẩu thường trú</i>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Email khác</div>
                                    <input type="text" class="form-control rounded" name="email_khac" value="{{$sinhvien->email_khac}}"/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Điện thoại</div>
                                    <input type="text" class="form-control rounded" name="dienthoai" value="{{$sinhvien->dienthoai}}"/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Zalo</div>
                                    <input type="text" class="form-control rounded" name="zalo" value="{{$sinhvien->zalo}}"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Điện thoại gia đình</div>
                                    <input type="text" class="form-control rounded" name="dienthoaigiadinh" value="{{$sinhvien->dienthoaigiadinh}}" disabled/>
                                </div>
                                <div class="col-lg-4 col-xs-12 form-group">
                                    <div class="title-text">Facebook cá nhân</div>
                                    <input type="text" class="form-control rounded" name="facebook" value="{{$sinhvien->facebook}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="alert alert-info" style="color: #337ab7 !important;">
                Sinh viên liên hệ <a href="https://www.facebook.com/ctsv.vku.udn.vn"><i class="fab fa-facebook ml-1 mr-1"></i>Phòng công tác sinh viên</a> hoặc <a href="tel:0236 3667 129"><i class="fas fa-phone mr-1"></i>0236 3667 129</a> nếu có thay đổi chi tiết thông tin cá nhân (Áp dụng với các trường thông tin bị làm mờ)
            </div>
            <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;Lưu</button>
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
        </form>
    </div>
@endsection
@section('custom-script')
    <script>
        resizeAvatar();
        $(window).resize(()=>{
            resizeAvatar()
        });
        function resizeAvatar(){
            var cw = $('#avatar_round').width();
            $('#avatar_round').css({'height': + cw +'px'});
        }
    </script>
@endsection
@section('custom-css')
    <style>

    </style>
@endsection
