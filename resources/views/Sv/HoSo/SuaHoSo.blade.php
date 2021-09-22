@extends('layout.sv_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
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
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="canhan-tab" data-toggle="pill" href="#canhan" role="tab" aria-controls="canhan" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Cá nhân
                        </a>
                        <a class="nav-link" id="giadinh-tab" data-toggle="pill" href="#giadinh" role="tab" aria-controls="giadinh" aria-selected="false">
                           <i class="fas fa-users mr-1"></i>
                            Gia đình
                        </a>
                        <a class="nav-link" id="thuongtru-tab" data-toggle="pill" href="#thuongtru" role="tab" aria-controls="thuongtru" aria-selected="false">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            Thường trú
                        </a>
                        <a class="nav-link" id="lienhe-tab" data-toggle="pill" href="#lienhe" role="tab" aria-controls="lienhe" aria-selected="false">
                            <i class="fas fa-address-card mr-1"></i>
                            Liên hệ
                        </a>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
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
            <form class="row" method="post" action="{{route('suahosoStore')}}">
                {{csrf_field()}}
                <div class="col-md-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="canhan" role="tabpanel" aria-labelledby="canhan-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white">
                                    <h6><i class="fas fa-info-circle mr-2"></i>Thông tin cá nhân</h6>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Họ và tên</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->hodem." ".$sinhvien->ten}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Giới tính</div>
                                            <select type="text" class="form-control rounded" selected="{{$sinhvien->gioitinh}}" disabled>
                                                <option value="0" {{$sinhvien->gioitinh ? "" : "selected"}}>Nữ</option>
                                                <option value="1" {{$sinhvien->gioitinh ? "selected" : ""}}>Nam</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày sinh</div>
                                            <input type="text" class="form-control rounded" value="{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <div class="label">Nơi sinh</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->noisinh}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Dân tộc</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">CMND/CCCD</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày cấp</div>
                                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngaycap}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Nơi cấp</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->noicap}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Đoàn thể</div>
                                            <input type="text" class="form-control rounded" value="{{getTruongTinh('doanthe', $sinhvien)}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày kết nạp</div>
                                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngayketnap}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Tôn giáo</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->tongiao}}" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="giadinh" role="tabpanel" aria-labelledby="giadinh-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="profile_main_block p-4 bg-white">
                                        <h6><i class="fas fa-users mr-2"></i>Thông tin gia đình</h6>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-6 ">
                                                <h6 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h6>
                                                <div class="form-group">
                                                    <div class="label">Họ tên</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->hotencha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Ngày sinh</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhcha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Dân tộc</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_cha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">CMND/CCCD</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_cha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Nghề nghiệp</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_cha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Nơi ở</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_cha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Email</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->email_cha}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">SĐT</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_cha}}" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ">
                                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h6>
                                                <div class="form-group">
                                                    <div class="label">Họ tên</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->hotenme}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Ngày sinh</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhme}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Dân tộc</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_me}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">CMND/CCCD</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_me}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Nghề nghiệp</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_me}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Nơi ở</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_me}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">Email</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->email_me}}" disabled/>
                                                </div>
                                                <div class="form-group">
                                                    <div class="label">SĐT</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_me}}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 mt-3">
                                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h6>
                                                <div class="form-group">
                                                    <div class="label">Anh chị em</div>
                                                    <input type="text" class="form-control rounded" value="{{$sinhvien->thanhphangiadinh}}" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="thuongtru" role="tabpanel" aria-labelledby="thuongtru-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white">
                                    <h6><i class="fas fa-map-marker-alt mr-2"></i>Thường trú và địa chỉ</h6>
                                    <hr/>
                                    <i>Hộ khẩu thường trú</i>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Thôn tổ</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->thon_to}}" disabled/>
                                            <div class="value">{{$sinhvien->thon_to}}</div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Xã phường</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->xa_phuong}}" disabled/>
                                            <div class="value">{{$sinhvien->xa_phuong}}</div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Quận huyện</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->quan_huyen}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Tỉnh/ Thành phố</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->tinh_thanh}}" disabled/>
                                        </div>
                                    </div>
                                    <i>Địa chỉ liên lạc</i>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="label">Địa chỉ</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dia_chi_lien_lac}}" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="lienhe" role="tabpanel" aria-labelledby="lienhe-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white">
                                    <h6><i class="fas fa-address-card mr-2"></i>Thông tin liên hệ</h6>
                                    <hr/>
                                    <i>Hộ khẩu thường trú</i>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Email khác</div>
                                            <input type="text" class="form-control rounded" name="email_khac" value="{{$sinhvien->email_khac}}"/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Điện thoại</div>
                                            <input type="text" class="form-control rounded" name="dienthoai" value="{{$sinhvien->dienthoai}}"/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Zalo</div>
                                            <input type="text" class="form-control rounded" name="zalo" value="{{$sinhvien->zalo}}"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Điện thoại gia đình</div>
                                            <input type="text" class="form-control rounded" name="dienthoaigiadinh" value="{{$sinhvien->dienthoaigiadinh}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Facebook cá nhân</div>
                                            <input type="text" class="form-control rounded" name="facebook" value="{{$sinhvien->facebook}}"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 pl-3">
                        <div class="col-md-12 mb-3">
                           Sinh viên liên hệ <a href="https://www.facebook.com/ctsv.vku.udn.vn"><i class="fab fa-facebook ml-1 mr-1"></i>Phòng công tác sinh viên</a> hoặc <a href="tel:0236 3667 129"><i class="fas fa-phone mr-1"></i>0236 3667 129</a> nếu có thay đổi chi tiết thông tin cá nhân
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary pl-3 pr-3"><i class="fa fa-save mr-3"></i> Lưu</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
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
