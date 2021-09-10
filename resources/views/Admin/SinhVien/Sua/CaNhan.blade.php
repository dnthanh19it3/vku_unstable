@extends('layout.admin_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row mb-3">
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
                <div class="profile-userbuttons">
                    <a href="{{route('suahoso')}}" class="btn btn-success btn-sm"><i
                                class="fa fa-edit m-right-xs mr-1"></i>Sửa hồ sơ</a>
                    <a href="{{route('sv.getlylich')}}" class="btn btn-danger btn-sm"><i
                                class="fa fa-file-export m-right-xs mr-1"></i>Xuất lý lịch</a>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->

                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Thông tin cá nhân </a>
                        </li>
                        <li>
                            <a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Khen thưởng </a>
                        </li>
                        <li>
                            <a href="{{route('ad.suasinhvien.kyluat', ['masv' => $sinhvien->masv])}}">
                                <i class="glyphicon glyphicon-ok"></i>
                                Kỉ luật </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
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
                <form action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}" method="POST">
                    {{ csrf_field() }}
                    <h6>Thông tin cá nhân</h6>
                    <hr>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (first name)-->
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputFirstName">Họ</label>
                            <input type="text" class="form-control rounded"
                                   value="{{$sinhvien->hodem}}" name="hodem">
                            <input type="text" name="avatar" id="avatar" hidden>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLastName">Tên</label>
                            <input type="text" class="form-control rounded"
                                   value="{{$sinhvien->ten}}" name="ten">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (organization name)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputOrgName">Giói tính</label>
                            <select id="gioitinh" name="gioitinh" class="custom-select">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <!-- Form Group (location)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Ngày sinh</label>
                            <input type="date" class="form-control rounded"
                                   value="{{$sinhvien->ngaysinh}}" name="ngaysinh">
                        </div>
                        <!-- Form Group (location)-->
                        <div class="form-group col-md-4">
                            <label class="mb-1" for="inputLocation">Dân tộc</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->dantoc}}" name="dantoc">
                            </div>
                        </div>

                    </div>
                    <!-- Form Group (email address)-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Số CMND</label>
                            <input type="text" class="form-control rounded"
                                   value="{{$sinhvien->cmnd}}" name="cmnd">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Ngày cấp</label>
                            <input type="date" class="form-control rounded"
                                   value="{{$sinhvien->ngaycap}}" name="ngaycap">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Nơi cấp</label>
                            <input type="text" class="form-control rounded"
                                   value="{{$sinhvien->noicap}}" name="noicap">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (phone number)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputPhone">Mã BHYT</label>
                            <input type="text" name="ma_bhyt" class="form-control rounded" id="Mã BHYT"
                                   placeholder="Mã BHYT" value="{{$sinhvien->ma_bhyt}}">
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputBirthday">Đoàn thể</label>
                            <div class="detail-content">
                                <select name="doanthe" class="form-control rounded" value="{{$sinhvien->doanthe}}">
                                    <option value="Đoàn viên">Đoàn viên</option>
                                    <option value="Đảng viên">Đảng viên</option>
                                    <option value="Không">Không</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Ngày kết nạp</label>
                            <input type="date" class="form-control rounded" name="ngayketnap"
                                   value="{{$sinhvien->ngayketnap}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Tôn giáo</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->tongiao}}" name="tongiao">
                            </div>
                        </div>
                    </div>
                    <h6>Thông tin gia đình</h6>
                    <hr/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Họ tên cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->hotencha}}" name="hotencha">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Năm sinh cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->namsinhcha}}" name="namsinhcha">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Dân tộc cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->dantoc_cha}}" name="dantoc_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Số CMND cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->cmnd_cha}}" name="cmnd_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Nghề nghiệp cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->nghenghiep_cha}}" name="nghenghiep_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">SĐT Cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->sdt_cha}}" name="sdt_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Email cha (nếu có)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->email_cha}}" name="email_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" mb-1" for="inputLocation">Nơi ở cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->diachi_cha}}" name="diachi_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Họ tên mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->hotenme}}" name="hotenme">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Năm sinh mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->namsinhme}}" name="namsinhme">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Dân tộc Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->dantoc_me}}" name="dantoc_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Số CMND Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->cmnd_me}}" name="cmnd_me">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Nghề nghiệp Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->nghenghiep_me}}" name="nghenghiep_me">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">SĐT Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->sdt_me}}" name="sdt_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Email mẹ (nếu có)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->email_me}}" name="email_me">
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" mb-1" for="inputLocation">Nơi ở Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->diachi_me}}" name="diachi_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" mb-1" for="inputLocation">Thành phần gia đình</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->thanhphangiadinh}}" name="thanhphangiadinh">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (tỉnh/tp)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->tinh_thanh}}" name="tinh_thanh">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (huyện/quận)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->quan_huyen}}" name="quan_huyen">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (xã/phường)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->xa_phuong}}" name="xa_phuong">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (đường/ số nhà)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->thon_to}}" name="thon_to">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Địa chỉ liên lạc</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded"
                                       value="{{$sinhvien->dia_chi_lien_lac}}" name="dia_chi_lien_lac">
                            </div>
                        </div>
                    </div>
                    <h6>Thông tin liên lạc</h6>
                    <hr/>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Số điện thoại</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded" name="dienthoai"
                                       placeholder="Số điện thoại" value="{{$sinhvien->dienthoai}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Số điện thoại gia đình</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded" name="dienthoaigiadinh"
                                       placeholder="Số điện thoại gia đình"
                                       value="{{$sinhvien->dienthoaigiadinh}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Email</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded" name="email_khac"
                                       value="{{$sinhvien->email_khac}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Facebook</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded" name="facebook"
                                       value="{{$sinhvien->facebook}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Zalo</label>
                            <div class="detail-content">
                                <input type="text" class="form-control rounded" name="zalo"
                                       placeholder="Zalo" value="{{$sinhvien->zalo}}">
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
