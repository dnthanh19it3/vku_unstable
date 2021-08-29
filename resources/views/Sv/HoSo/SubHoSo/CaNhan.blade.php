@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="profile_avatar_bl p-4 bg-white">
                <img id="avatar_round" class="avatar_round" src="{{$sinhvien->avatar}}" alt="Avatar" title="Change the avatar"/>
                <h5 class="mt-3">{{$sinhvien->hodem." ".$sinhvien->ten}}</h5>
                <div class="">Mã sinh viên: {{$sinhvien->masv}} Lớp: {{$sinhvien->tenlop}} </div>
                <div class="">Sinh viên ngành {{$sinhvien->tennganh}}</div>
                <div class="mt-3">
                    <a class="btn btn-sm btn-primary" style="color: #fff" href="{{route('suahoso')}}"><i
                                class="fa fa-edit m-right-xs mr-1"></i>Sửa hồ sơ</a>
                    <a class="btn btn-sm btn-success" style="color: #fff" href="{{route('sv.getlylich')}}"><i
                                class="fa fa-file-export m-right-xs mr-1"></i>Xuất lý lịch</a>
                </div>
            </div>
            <div class="profile_avatar_bl p-3 bg-white mt-3 mb-3">
                <ul class="contact_list">
                    <li class="contact_item"><div class="label"><i class="fa fa-mailbox"></i>Email</div><div class="value">{{$sinhvien->email}}</div></li>
                    <li class="contact_item"><div class="label"><i class="fa fa-phone"></i>Số điện thoại</div><div class="value">123{{$sinhvien->dienthoai}}</div></li>
                    <li class="contact_item"><div class="label"><i class="fab fa-facebook"></i>Facebook</div><div class="value">123{{$sinhvien->facebook}}</div></li>
                    <li class="contact_item"><div class="label"><i class="fa fa-phone"></i>Facebook</div><div class="value">123{{$sinhvien->dienthoai}}</div></li>
                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="profile_top_menu profile_top_menu_scroll">
                <li class="profile_top_menu_item"><a href="{{route('xemhoso')}}">Cá nhân</a></li>
                <li class="profile_top_menu_item"><a href="{{route('xemhoso', ['danhmuc' => 'khenthuong'])}}">Khen thưởng</a></li>
                <li class="profile_top_menu_item"><a href="#">Kỷ luật</a></li>
                <li class="profile_top_menu_item"><a href="#">Rèn luyện</a></li>
                <li class="profile_top_menu_item"><a href="#">Timeline</a></li>

            </ul>
            <div class="profile_main_block p-4 bg-white">
                <h6>Thông tin cá nhân</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-4 info_group">
                        <div class="label">Họ và tên</div>
                        <div class="value">{{$sinhvien->hodem." ".$sinhvien->ten}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Giới tính</div>
                        <div class="value">@if($sinhvien->gioitinh == 1) Nam @else Nữ @endif</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Ngày sinh</div>
                        <div class="value">{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Nơi sinh</div>
                        <div class="value">{{$sinhvien->noisinh}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 info_group">
                        <div class="label">Dân tộc</div>
                        <div class="value">{{$sinhvien->dantoc}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">CMND/CCCD</div>
                        <div class="value">{{$sinhvien->cmnd}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Ngày cấp</div>
                        <div class="value">{{$sinhvien->ngaycap}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Nơi cấp</div>
                        <div class="value">{{$sinhvien->noicap}}</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 info_group">
                        <div class="label">Đoàn thể</div>
                        <div class="value">{{$sinhvien->doanthe}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Ngày kết nạp</div>
                        <div class="value">{{$sinhvien->ngayketnap}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Tôn giáo</div>
                        <div class="value">{{$sinhvien->tongiao}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Diện chính sách</div>
                        <div class="value">{{"N/A"}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="profile_main_block p-4 bg-white">
                        <h6>Thông tin gia đình</h6>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 ">
                                <h6 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h6>
                                <div class="info_group">
                                    <div class="label">Họ tên</div>
                                    <div class="value">{{$sinhvien->hotencha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Ngày sinh</div>
                                    <div class="value">{{$sinhvien->namsinhcha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Dân tộc</div>
                                    <div class="value">{{$sinhvien->dantoc_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">CMND/CCCD</div>
                                    <div class="value">{{$sinhvien->cmnd_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Nghề nghiệp</div>
                                    <div class="value">{{$sinhvien->nghenghiep_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Nơi ở</div>
                                    <div class="value">{{$sinhvien->diachi_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Email</div>
                                    <div class="value">{{$sinhvien->email_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">SĐT</div>
                                    <div class="value">{{$sinhvien->sdt_cha}}</div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h6>
                                <div class="info_group">
                                    <div class="label">Họ tên</div>
                                    <div class="value">{{$sinhvien->hotenme}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Ngày sinh</div>
                                    <div class="value">{{$sinhvien->namsinhme}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Dân tộc</div>
                                    <div class="value">{{$sinhvien->dantoc_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">CMND/CCCD</div>
                                    <div class="value">{{$sinhvien->cmnd_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Nghề nghiệp</div>
                                    <div class="value">{{$sinhvien->nghenghiep_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Nơi ở</div>
                                    <div class="value">{{$sinhvien->diachi_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">Email</div>
                                    <div class="value">{{$sinhvien->email_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="label">SĐT</div>
                                    <div class="value">{{$sinhvien->sdt_me}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h6>
                                <div class="info_group">
                                    <div class="label">Anh chị em</div>
                                    <div class="value">{{$sinhvien->thanhphangiadinh}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="profile_main_block p-4 bg-white mt-3">
                <h6>Thường trú và địa chỉ</h6>
                <hr/>
                <i>Hộ khẩu thường trú</i>
                <div class="row">
                    <div class="col-md-4 info_group">
                        <div class="label">Thôn tổ</div>
                        <div class="value">{{$sinhvien->thon_to}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Xã phường</div>
                        <div class="value">{{$sinhvien->xa_phuong}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Quận huyện</div>
                        <div class="value">{{$sinhvien->quan_huyen}}</div>
                    </div>
                    <div class="col-md-4 info_group">
                        <div class="label">Tỉnh/ Thành phố</div>
                        <div class="value">{{$sinhvien->tinh_thanh}}</div>
                    </div>
                </div>
                <i>Địa chỉ liên lạc</i>
                <div class="row">
                    <div class="col-md-12 info_group">
                        <div class="label">Địa chỉ</div>
                        <div class="value">{{$sinhvien->dia_chi_lien_lac}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h5>Hồ sơ sinh viên</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-4 col-sm-3  profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar d-flex">
                                <img class="img-account-profile rounded-circle mb-2 " src="{{$sinhvien->avatar}}"
                                     alt="Avatar" title="Change the avatar">
                            </div>
                            @if($sinhvien->avatar_temp)
                                <div class="alert alert-warning">Ảnh đang chờ duyệt</div>
                            @endif
                        </div>
                        <h3>{{$sinhvien->hodem." ".$sinhvien->ten}}</h3>

                        <ul class="list-unstyled user_data">
                            <li>
                                <i class="fa fa-map-marker user-profile-icon"></i> {{$sinhvien->thon_to .", ". $sinhvien->xa_phuong.", ". $sinhvien->quan_huyen.", ".$sinhvien->tinh_thanh}}
                            </li>
                            <li>
                                <i class="fa fa-indent user-profile-icon"></i> Mã sinh viên: {{$sinhvien->masv}}
                            </li>
                            <li>
                                <i class="fa fa-mail-reply-all user-profile-icon"></i> {{$sinhvien->email}}
                            </li>
                            <li>
                                <i class="fa fa-briefcase user-profile-icon"></i> {{$sinhvien->tennganh}}
                            </li>

                            <li class="m-top-xs">
                                <i class="fa fa-external-link user-profile-icon"></i>
                                <a href="{{"https://".$sinhvien->facebook}}" target="_blank">{{$sinhvien->facebook}}</a>
                            </li>
                        </ul>

                        <a class="btn btn-primary" style="color: #fff" href="{{route('suahoso')}}"><i
                                class="fa fa-edit m-right-xs"></i>Sửa hồ sơ</a>
                        <a class="btn btn-success" style="color: #fff" href="{{route('sv.getlylich')}}"><i
                                    class="fa fa-edit m-right-xs"></i>Xuất lý lịch</a>
                        <br>

                    </div>
                    <div class="col-md-9 col-sm-9 ">
                        <!-- TAB -->
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="khen-kyluat"
                                                                          role="tab" data-toggle="tab"
                                                                          aria-expanded="true">Thông tin cá nhân</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content2" id="khen-kyluat"
                                                                          role="tab" data-toggle="tab"
                                                                          aria-expanded="true">Khen thưởng</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tab_content3" role="tab" id="kyluat" data-toggle="tab" aria-expanded="false">
                                        Kỷ luật
                                    </a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content4" role="tab" id="tamtru"
                                                                    data-toggle="tab" aria-expanded="false">Tạm trú tạm
                                        vắng</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content5" role="tab" id="renluyen"
                                                                    data-toggle="tab" aria-expanded="false">Đánh giá rèn luyện</a>
                                </li>
                                <li role="presentation" class=""><a href="#tab_content6" role="tab" id="dongthoigian"
                                                                    data-toggle="tab" aria-expanded="false">Dòng thời gian</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane active " id="tab_content1"
                                     aria-labelledby="thongtincanhan">
                                    <div class="profile_title">
                                        <div class="col-md-12">
                                            <h2>Thông tin cá nhân</h2>
                                        </div>
                                    </div>
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Họ và tên</div>
                                            <div class="content">{{$sinhvien->hodem." ".$sinhvien->ten}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Ngày sinh</div>
                                            <div
                                                class="content">{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Giới tính</div>
                                            <div class="content">@if($sinhvien->gioitinh == 1) Nữ @else Nam @endif</div>
                                        </div>
                                    </div>
                                    <!-- Line2 -->
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">CMND</div>
                                            <div class="content">{{$sinhvien->cmnd}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Ngày cấp</div>
                                            <div class="content">{{$sinhvien->ngaycap}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Nơi cấp</div>
                                            <div class="content">{{$sinhvien->noicap}}</div>
                                        </div>
                                    </div>
                                    <!-- Line2 -->
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Dân tộc</div>
                                            <div class="content">{{$sinhvien->dantoc}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Tôn giáo</div>
                                            <div class="content">{{$sinhvien->tongiao}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Đoàn thể</div>
                                            <div class="content">{{$sinhvien->doanthe}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Mã số thẻ BHYT</div>
                                            <div class="content">{{$sinhvien->ma_bhyt}}</div>
                                        </div>
                                    </div>
                                    <!-- End Thông tin cá nhân -->
                                    <!-- Thông tin gia đình -->
                                    <div class="profile_title">
                                        <div class="col-md-12">
                                            <h2>Thông tin gia đình</h2>
                                        </div>
                                    </div>
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-6 hoso_block">
                                            <div class="title">Họ và tên cha</div>
                                            <div class="content">{{$sinhvien->hotencha}}</div>
                                        </div>
                                        <div class="col-md-6 hoso_block">
                                            <div class="title">Năm sinh cha</div>
                                            <div class="content">{{$sinhvien->namsinhcha}}</div>
                                        </div>
                                    </div>
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-6 hoso_block">
                                            <div class="title">Họ và tên mẹ</div>
                                            <div class="content">{{$sinhvien->hotenme}}</div>
                                        </div>
                                        <div class="col-md-6 hoso_block">
                                            <div class="title">Năm sinh mẹ</div>
                                            <div class="content">{{$sinhvien->namsinhme}}</div>
                                        </div>
                                    </div>
                                    <!-- Line2 -->
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Hộ khẩu (Thôn xã)</div>
                                            <div class="content">{{$sinhvien->thon_to}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Hộ khẩu (Xã phường)</div>
                                            <div class="content">{{$sinhvien->xa_phuong}}</div>
                                        </div>
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Hộ khẩu (Quận huyện)</div>
                                            <div class="content">{{$sinhvien->quan_huyen}}</div>
                                        </div>
                                    </div>
                                    <!-- Line2 -->
                                    <div class="row pl-3 pr-3 pb-2">
                                        <div class="col-md-4 hoso_block">
                                            <div class="title">Hộ khẩu (Tính/ TP)</div>
                                            <div class="content">{{$sinhvien->tinh_thanh}}</div>
                                        </div>
                                        <div class="col-md-8 hoso_block">
                                            <div class="title">Địa chỉ liên lạc</div>
                                            <div class="content">{{$sinhvien->dia_chi_lien_lac}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active " id="tab_content2"
                                     aria-labelledby="khen-kyluat">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th>
                                                <div class="icheckbox_flat-green" style="position: relative;"><input
                                                        type="checkbox" id="check-all" class="flat"
                                                        style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper"
                                                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                            </th>
                                            <th class="column-title">Cấp khen thưởng</th>
                                            <th class="column-title">Quyết định số</th>
                                            <th class="column-title">Nội dung</th>
                                            <th class="column-title">Thời gian</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @php
                                            $i = 0
                                        @endphp

                                        @foreach ($khenthuong as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{ $item->capkhenthuong }}</td>
                                                <td>{{ $item->soquyetdinh }}</td>
                                                <td>{{ $item->noidung }}</td>
                                                <td>{{ $item->thoigian }}</td>
                                            </tr>
                                            @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="kyluat">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">STT</th>
                                            <th class="column-title">Cấp quyết định</th>
                                            <th class="column-title">Số quyết định</th>
                                            <th class="column-title">Nội dung</th>
                                            <th class="column-title">Hình thức</th>
                                            <th class="column-title">Thời gian</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @forelse ($kyluat as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{ $item->capquyetdinh }}</td>
                                                <td>{{ $item->soquyetdinh }}</td>
                                                <td>{{ $item->noidung }}</td>
                                                <td>{{ $item->hinhthuckyluat }}</td>
                                                <td>{{ $item->thoigian }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    Sinh viên này không có thông tin kỷ luật!
                                                </td>
                                            </tr>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="tamtru">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th>
                                                <div class="icheckbox_flat-green" style="position: relative;"><input
                                                        type="checkbox" id="check-all" class="flat"
                                                        style="position: absolute; opacity: 0;">
                                                    <ins class="iCheck-helper"
                                                         style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>
                                                </div>
                                            </th>
                                            <th class="column-title">Địa chỉ</th>
                                            <th class="column-title">Tên chủ hộ</th>
                                            <th class="column-title">SĐT chủ hộ</th>
                                            <th class="column-title">Thời gian</th>
                                            <th class="column-title">Học kỳ</th>
                                            <th class="column-title">Năm học</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0
                                        @endphp

                                        @forelse($tamtru as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{ $item->so_nha.", ". $item->thon_to.", ".$item->xa_phuong.", ".$item->quan_huyen.", ".$item->tinh_thanh}}</td>
                                                <td>{{ $item->tenchuho }}</td>
                                                <td>{{ $item->sdtchuho }}</td>
                                                <td>{{ $item->thoigian }}</td>
                                                <td>{{ $item->hocky }}</td>
                                                <td>{{ $item->nambatdau."-".$item->namketthuc }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-danger">
                                                        Bạn chưa khai báo trong học kì này! Vui lòng bổ sung khai báo tạm
                                                        trú trong chỉnh sửa hồ sơ!
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="renluyen">
                                    <h6>Điểm rèn luyện</h6>
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">STT</th>
                                            <th class="column-title">Năm học</th>
                                            <th class="column-title">Học kì</th>
                                            <th class="column-title">Điểm</th>
                                            <th class="column-title">Xếp loại</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0
                                        @endphp

                                        @forelse($renluyen as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{ $item->namhoc}}</td>
                                                <td>{{ $item->hocky }}</td>
                                                <td>{{ $item->diem }}</td>
                                                <td>{{ $item->xeploai }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    <div class="alert alert-danger">
                                                        Chưa có đánh giá rèn luyện
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforelse
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="dongthoigian">
                                    <h6>Nhật kí hoạt động</h6>
                                    <ul class="list-unstyled timeline">
                                        @forelse($timeline as $item)
                                            <li>
                                                <div class="block">
                                                    <div class="tags">
                                                        <a href="" class="tag">
                                                            <span>{{$item->danhmuc}}</span>
                                                        </a>
                                                    </div>
                                                    <div class="block_content">
                                                        <h2 class="title">
                                                            <a>{{$item->tieude}}</a>
                                                        </h2>
                                                        <div class="byline">
                                                            <span>{{\Carbon\Carbon::create($item->thoigian)->format('d-m-Y')}}</span>
                                                        </div>
                                                        <p class="excerpt">{{$item->noidung}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END TAB -->
                    </div>
                </div>
            </div>
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
