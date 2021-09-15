@extends('layout.admin_layout')
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
                        {{getTruongTinh('hodem." ".$sinhvien->ten', $sinhvien)}}
                    </div>
                    <div class="profile-usertitle-job">
                        NGÀNH {{getTruongTinh('tennganh', $sinhvien)}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{getTruongTinh('tenlop', $sinhvien)}} MSV {{getTruongTinh('masv', $sinhvien)}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}" class="btn btn-success btn-sm"><i
                                class="fa fa-edit m-right-xs mr-1"></i>Sửa hồ sơ</a>
                    <a href="{{route('sv.getlylich')}}" class="btn btn-danger btn-sm"><i
                                class="fa fa-file-export m-right-xs mr-1"></i>Xuất lý lịch</a>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->

                <div class="profile-usermenu">
                    <div class="profile-usermenu">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="canhan-tab" data-toggle="pill" href="#canhan" role="tab" aria-controls="canhan" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Cá nhân
                            </a>
                            <a class="nav-link" id="khenthuong-tab" data-toggle="pill" href="#khenthuong" role="tab" aria-controls="khenthuong" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Khen thưởng
                            </a>
                            <a class="nav-link" id="kyluat-tab" data-toggle="pill" href="#kyluat" role="tab" aria-controls="kyluat" aria-selected="false">
                                <i class="fa fa-user text-center mr-1"></i>
                                Kỷ luật
                            </a>
                            <a class="nav-link" id="renluyen-tab" data-toggle="pill" href="#renluyen" role="tab" aria-controls="renluyen" aria-selected="false">
                                <i class="fa fa-tv text-center mr-1"></i>
                                Rèn luyện
                            </a>
                            <a class="nav-link" id="tamtru-tab" data-toggle="pill" href="#tamtru" role="tab" aria-controls="tamtru" aria-selected="false">
                                <i class="fa fa-bell text-center mr-1"></i>
                                Tạm trú
                            </a>
                            <a class="nav-link" id="timeline-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">
                                <i class="fa fa-bell text-center mr-1"></i>
                                Timeline
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="canhan" role="tabpanel" aria-labelledby="canhan-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white">
                                    <h6>Thông tin cá nhân</h6>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-4 info_group">
                                            <div class="label">Họ và tên</div>
                                            <div class="value">{{getTruongTinh('hoten', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Giới tính</div>
                                            <div class="value">@if($sinhvien->gioitinh == 1) Nam @else Nữ @endif</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Ngày sinh</div>
                                            <div class="value">{{getTruongTinh('ngaysinh', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Nơi sinh</div>
                                            <div class="value">{{getTruongTinh('noisinh', $sinhvien)}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 info_group">
                                            <div class="label">Dân tộc</div>
                                            <div class="value">{{getTruongTinh('dantoc', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">CMND/CCCD</div>
                                            <div class="value">{{getTruongTinh('cmnd', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Ngày cấp</div>
                                            <div class="value">{{getTruongTinh('ngaycap', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Nơi cấp</div>
                                            <div class="value">{{getTruongTinh('noicap', $sinhvien)}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 info_group">
                                            <div class="label">Đoàn thể</div>
                                            <div class="value">{{getTruongTinh('doanthe',$sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Ngày kết nạp</div>
                                            <div class="value">{{getTruongTinh('ngayketnap', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Tôn giáo</div>
                                            <div class="value">{{getTruongTinh('tongiao', $sinhvien)}}</div>
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
                                                        <div class="value">{{getTruongTinh('hotencha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Ngày sinh</div>
                                                        <div class="value">{{getTruongTinh('namsinhcha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Dân tộc</div>
                                                        <div class="value">{{getTruongTinh('dantoc_cha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">CMND/CCCD</div>
                                                        <div class="value">{{getTruongTinh('cmnd_cha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Nghề nghiệp</div>
                                                        <div class="value">{{getTruongTinh('nghenghiep_cha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Nơi ở</div>
                                                        <div class="value">{{getTruongTinh('diachi_cha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Email</div>
                                                        <div class="value">{{getTruongTinh('email_cha', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">SĐT</div>
                                                        <div class="value">{{getTruongTinh('sdt_cha', $sinhvien)}}</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h6>
                                                    <div class="info_group">
                                                        <div class="label">Họ tên</div>
                                                        <div class="value">{{getTruongTinh('hotenme', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Ngày sinh</div>
                                                        <div class="value">{{getTruongTinh('namsinhme', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Dân tộc</div>
                                                        <div class="value">{{getTruongTinh('dantoc_me', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">CMND/CCCD</div>
                                                        <div class="value">{{getTruongTinh('cmnd_me', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Nghề nghiệp</div>
                                                        <div class="value">{{getTruongTinh('nghenghiep_me', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Nơi ở</div>
                                                        <div class="value">{{getTruongTinh('diachi_me', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">Email</div>
                                                        <div class="value">{{getTruongTinh('email_me', $sinhvien)}}</div>
                                                    </div>
                                                    <div class="info_group">
                                                        <div class="label">SĐT</div>
                                                        <div class="value">{{getTruongTinh('sdt_me', $sinhvien)}}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h6>
                                                    @if($sinhvien->thanhphangiadinh != null)
                                                        @foreach($sinhvien->thanhphangiadinh as $value)
                                                            <div class="info_group">
                                                                {{$value}}
                                                            </div>
                                                        @endforeach
                                                    @endif
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
                                            <div class="value">{{getTruongTinh('thon_to', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Xã phường</div>
                                            <div class="value">{{getTruongTinh('xa_phuong', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Quận huyện</div>
                                            <div class="value">{{getTruongTinh('quan_huyen', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Tỉnh/ Thành phố</div>
                                            <div class="value">{{getTruongTinh('tinh_thanh', $sinhvien)}}</div>
                                        </div>
                                    </div>
                                    <i>Địa chỉ liên lạc</i>
                                    <div class="row">
                                        <div class="col-md-12 info_group">
                                            <div class="label">Địa chỉ</div>
                                            <div class="value">{{getTruongTinh('dia_chi_lien_lac', $sinhvien)}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="khenthuong" role="tabpanel" aria-labelledby="khenthuong-tab">
                            <div>
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6>Khen thưởng</h6>
                                            </div>
                                            <div class="col-sm-7">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nội dung</th>
                                            <th>Cấp khen thưởng</th>
                                            <th>Số quyết định</th>
                                            <th>Năm học</th>
                                            <th>Học kỳ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0
                                        @endphp

                                        @forelse ($khenthuong as $item)
                                            <tr role="row" class="odd">
                                                <td>{{ $i += 1 }}</td>
                                                <td>{{ $item->noidung }}</td>
                                                <td>{{ $item->capkhenthuong }}</td>
                                                <td>{{ $item->soquyetdinh }}</td>
                                                <td>{{ $item->nambatdau . " " . $item->namketthuc }}</td>
                                                <td>{{ $item->hocky }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Chưa có thông tin khen thưởng!</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kyluat" role="tabpanel" aria-labelledby="kyluat-tab">
                            <div class="table-responsive">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6>Kỷ luật</h6>
                                            </div>
                                            <div class="col-sm-7">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nội dung</th>
                                            <th>Cấp khen kỷ luật</th>
                                            <th>Số quyết định</th>
                                            <th>Năm học</th>
                                            <th>Học kỳ</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0;
                                        @endphp
                                        @forelse ($kyluat as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{ $item->noidung }}</td>
                                                <td>{{ $item->capquyetdinh }}</td>
                                                <td>{{ $item->soquyetdinh }}</td>
                                                <td>{{ $item->hinhthuckyluat }}</td>
                                                <td>{{ $item->nambatdau . " " . $item->namketthuc }}</td>
                                                <td>{{ $item->hocky }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7">
                                                    Sinh viên này không có thông tin kỷ luật!
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="renluyen" role="tabpanel" aria-labelledby="renluyen-tab">
                            <div>
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h6>Kết quả rèn luyện</h6>
                                            </div>
                                            <div class="col-sm-7">
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <th class="column-title">#</th>
                                        <th class="column-title">Năm học</th>
                                        <th class="column-title">Học kì</th>
                                        <th class="column-title">Điểm</th>
                                        <th class="column-title">Xếp loại</th>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i = 0
                                        @endphp

                                        @forelse($renluyen as $item)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{ $i += 1 }}</td>
                                                <td>{{$item->nambatdau."-".$item->namketthuc}}</td>
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
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tamtru" role="tabpanel" aria-labelledby="tamtru-tab">
                                <div class="table-wrapper">
                                    <div class="table-title">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <h5>Thông tin tạm trú</h5>
                                            </div>
                                            <div class="col-sm-7">

                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Địa chỉ</th>
                                            <th>Năm học</th>
                                            <th>Học kì</th>
                                            <th>Chủ hộ</th>
                                            <th>Điện thoại chủ hộ</th>
                                            <th>Từ ngày</th>
                                            <th>Trạng thái</th>
                                            <th>Ngày khai báo</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($tamtru as $key => $item)
                                            <tr>
                                                <td>{{$key+=1}}</td>
                                                <td>{{$item->sonha .", ".$item->thonto.", ".$item->xaphuong.", ".$item->quanhuyen.", ".$item->tinhthanh}}</td>
                                                <td>{{$item->nambatdau."-".$item->namketthuc}}</td>
                                                <td>{{$item->hocky}}</td>
                                                <td>{{$item->tenchuho}}</td>
                                                <td>{{$item->sdtchuho}}</td>
                                                <td>{{\Carbon\Carbon::make($item->thoigianbatdau )->format('d-m-Y')}}</td>
                                                <td>@if($item->trangthai)<span class="status text-success">&bull;</span> Hiện tại @else <span class="status text-danger">&bull;</span> Chỗ ở cũ @endif</td>
                                                <td>{{\Carbon\Carbon::make($item->created_at)->format('d-m-Y')}}</td>
                                            </tr>
                                        @empty
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>

                        </div>
                        <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="bg-white p-3">
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
                                        <li>Chưa có hoạt động được ghi nhận!</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="x_panel">--}}
{{--                <div class="x_title">--}}
{{--                    <h2>Hồ sơ sinh viên</h2>--}}
{{--                    <ul class="nav navbar-right panel_toolbox">--}}
{{--                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>--}}
{{--                        </li>--}}
{{--                        <li class="dropdown">--}}
{{--                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
{{--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                                <a class="dropdown-item" href="#">Settings 1</a>--}}
{{--                                <a class="dropdown-item" href="#">Settings 2</a>--}}
{{--                            </div>--}}
{{--                        </li>--}}
{{--                        <li><a class="close-link"><i class="fa fa-close"></i></a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <div class="col-md-3 col-sm-3  profile_left">--}}
{{--                        <div class="profile_img">--}}
{{--                            <div id="crop-avatar d-flex">--}}
{{--                                <img class="img-account-profile rounded-circle mb-2 " src="{{getTruongTinh('avatar}}" alt="Avatar" title="Change the avatar">--', $sinhvien)}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- Thông tin cá nhân -->--}}
{{--                        <h3>{{getTruongTinh('hodem." ".$sinhvien->ten}}</h3>--', $sinhvien)}}
{{--                        <ul class="list-unstyled user_data">--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-map-marker user-profile-icon"></i> {{getTruongTinh('thon_to .", ". $sinhvien->xa_phuong.", ". $sinhvien->quan_huyen.", ".$sinhvien->tinh_thanh}}--', $sinhvien)}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-indent user-profile-icon"></i> Mã sinh viên: {{getTruongTinh('masv}}--', $sinhvien)}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-mail-reply-all user-profile-icon"></i> {{getTruongTinh('email}}--', $sinhvien)}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <i class="fa fa-briefcase user-profile-icon"></i> {{getTruongTinh('tennganh}}--', $sinhvien)}}
{{--                            </li>--}}

{{--                            <li class="m-top-xs">--}}
{{--                                <i class="fa fa-external-link user-profile-icon"></i>--}}
{{--                                <a href="{{"https://".$sinhvien->facebook}}" target="_blank">{{getTruongTinh('facebook}}</a>--', $sinhvien)}}
{{--                            </li>--}}
{{--                        </ul>--}}

{{--                        <a class="btn btn-primary" style="color: #fff" href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}"><i class="fa fa-edit m-right-xs"></i>Sửa hồ sơ</a>--}}
{{--                        <br>--}}

{{--                    </div>--}}
{{--                    <div class="col-md-9 col-sm-9 ">--}}
{{--                            <!-- Danh sách tab -->--}}
{{--                            <div class="" role="tabpanel" data-example-id="togglable-tabs">--}}
{{--                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">--}}
{{--                                    <li role="presentation" class="active"><a href="#tab_content1" id="thongtincanhan" role="tab" data-toggle="tab" aria-expanded="true">Thông tin cá nhân</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content2" id="anh" role="tab" data-toggle="tab" aria-expanded="false">Ảnh</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content3" id="khen-kyluat" role="tab" data-toggle="tab" aria-expanded="false">Khen thưởng</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="renluyen" data-toggle="tab" aria-expanded="false">Kỷ luật</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content5" role="tab" id="renluyen"--}}
{{--                                                                        data-toggle="tab" aria-expanded="false">Đánh giá rèn luyện</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content6" role="tab" id="tamtru" data-toggle="tab" aria-expanded="false">Tạm trú tạm vắng</a>--}}
{{--                                    </li>--}}
{{--                                    <li role="presentation" class=""><a href="#tab_content7" role="tab" id="dongthoigian"--}}
{{--                                                                        data-toggle="tab" aria-expanded="false">Dòng thời gian</a>--}}
{{--                                    </li>--}}

{{--                                </ul>--}}
{{--                                <div id="myTabContent" class="tab-content">--}}
{{--                                    <div role="tabpanel" class="tab-pane active" id="tab_content1" aria-labelledby="thongtincanhan">--}}
{{--                                        <div class="profile_title"><!-- Thông tin cá nhân -->--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <h2>Thông tin cá nhân</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Họ và tên</div>--}}
{{--                                                <div class="content">{{getTruongTinh('hodem." ".$sinhvien->ten}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Ngày sinh</div>--}}
{{--                                                <div class="content">{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}</div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Giới tính</div>--}}
{{--                                                <div class="content">@if($sinhvien->gioitinh == 1) Nữ @else Nam @endif</div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Line2 -->--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">CMND</div>--}}
{{--                                                <div class="content">{{getTruongTinh('cmnd}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Ngày cấp</div>--}}
{{--                                                <div class="content">{{getTruongTinh('ngaycap}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Nơi cấp</div>--}}
{{--                                                <div class="content">{{getTruongTinh('noicap}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Line2 -->--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Dân tộc</div>--}}
{{--                                                <div class="content">{{getTruongTinh('dantoc}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Tôn giáo</div>--}}
{{--                                                <div class="content">{{getTruongTinh('tongiao}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Đoàn thể</div>--}}
{{--                                                <div class="content">{{getTruongTinh('doanthe}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Mã số thẻ BHYT</div>--}}
{{--                                                <div class="content">{{getTruongTinh('ma_bhyt}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- End Thông tin cá nhân -->--}}
{{--                                        <!-- Thông tin gia đình -->--}}
{{--                                        <div class="profile_title">--}}
{{--                                            <div class="col-md-12">--}}
{{--                                                <h2>Thông tin gia đình</h2>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-6 hoso_block">--}}
{{--                                                <div class="title">Họ và tên cha</div>--}}
{{--                                                <div class="content">{{getTruongTinh('hotencha}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 hoso_block">--}}
{{--                                                <div class="title">Năm sinh cha</div>--}}
{{--                                                <div class="content">{{getTruongTinh('namsinhcha}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-6 hoso_block">--}}
{{--                                                <div class="title">Họ và tên mẹ</div>--}}
{{--                                                <div class="content">{{getTruongTinh('hotenme}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-6 hoso_block">--}}
{{--                                                <div class="title">Năm sinh mẹ</div>--}}
{{--                                                <div class="content">{{getTruongTinh('namsinhme}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Line2 -->--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Hộ khẩu (Thôn xã)</div>--}}
{{--                                                <div class="content">{{getTruongTinh('thon_to}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Hộ khẩu (Xã phường)</div>--}}
{{--                                                <div class="content">{{getTruongTinh('xa_phuong}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Hộ khẩu (Quận huyện)</div>--}}
{{--                                                <div class="content">{{getTruongTinh('quan_huyen}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <!-- Line2 -->--}}
{{--                                        <div class="row pl-3 pr-3 pb-2">--}}
{{--                                            <div class="col-md-4 hoso_block">--}}
{{--                                                <div class="title">Hộ khẩu (Tính/ TP)</div>--}}
{{--                                                <div class="content">{{getTruongTinh('tinh_thanh}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                            <div class="col-md-8 hoso_block">--}}
{{--                                                <div class="title">Địa chỉ liên lạc</div>--}}
{{--                                                <div class="content">{{getTruongTinh('dia_chi_lien_lac}}</div>--', $sinhvien)}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane" id="tab_content2" aria-labelledby="anh">--}}
{{--                                            <h6>Ảnh hiện tại</h6>--}}
{{--                                            <hr/>--}}
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-3">--}}
{{--                                                    <img class="img-fluid" src="{{getTruongTinh('avatar}}"/>--', $sinhvien)}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <h6 class="mt-3">Ảnh đang chờ duyệt</h6>--}}
{{--                                            <hr/>--}}
{{--                                            @if($sinhvien->avatar_temp)--}}
{{--                                                <div class="row">--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <img class="img-fluid" src="{{asset($sinhvien->avatar_temp)}}"/>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="row mt-3">--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <a href="{{route('ad.duyetanh', ['masv' => $sinhvien->masv])}}" class="btn btn-primary">Duyệt</a>--}}
{{--                                                        <a href="#" class="btn btn-danger">Không duyệt</a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                <div>Không có ảnh nào chờ duyệt!</div>--}}
{{--                                            @endif--}}
{{--                                            <h6 class="mt-3">Ảnh đã duyệt</h6>--}}
{{--                                            <hr/>--}}
{{--                                            <div class="row">--}}
{{--                                                @forelse($anhdatailen as $item)--}}
{{--                                                    <div class="col-md-3">--}}
{{--                                                        <div class="anhhoso-container">--}}
{{--                                                            <img style="width: 100%;height: auto" src="{{asset($item->duongdan)}}"/>--}}
{{--                                                            <div--}}
{{--                                                                class="anhoso-badge">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:m')}}</div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                @empty--}}
{{--                                                    <div class="col-12">Chưa có ảnh đã tải lên!</div>--}}
{{--                                                @endforelse--}}
{{--                                            </div>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane" id="tab_content3" aria-labelledby="khen-kyluat">--}}
{{--                                        <table class="table table-striped jambo_table bulk_action">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="headings">--}}
{{--                                                <th class="column-title">STT</th>--}}
{{--                                                <th class="column-title">Cấp khen thưởng</th>--}}
{{--                                                <th class="column-title">Số quyết định</th>--}}
{{--                                                <th class="column-title">Nội dung</th>--}}
{{--                                                <th class="column-title">Thời gian</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @php--}}
{{--                                                $i = 0;--}}
{{--                                            @endphp--}}
{{--                                            @foreach ($khenthuong as $item)--}}
{{--                                                <tr role="row" class="odd">--}}
{{--                                                    <td class="sorting_1">{{ $i += 1 }}</td>--}}
{{--                                                    <td>{{ $item->capkhenthuong }}</td>--}}
{{--                                                    <td>{{ $item->soquyetdinh }}</td>--}}
{{--                                                    <td>{{ $item->noidung }}</td>--}}
{{--                                                    <td>{{ $item->thoigian }}</td>--}}
{{--                                                </tr>--}}
{{--                                                @endforeach--}}
{{--                                                </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="kyluat">--}}
{{--                                        <table class="table table-striped jambo_table bulk_action">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="headings">--}}
{{--                                                <th class="column-title">STT</th>--}}
{{--                                                <th class="column-title">Cấp quyết định</th>--}}
{{--                                                <th class="column-title">Số quyết định</th>--}}
{{--                                                <th class="column-title">Nội dung</th>--}}
{{--                                                <th class="column-title">Hình thức</th>--}}
{{--                                                <th class="column-title">Thời gian</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @php--}}
{{--                                                $i = 0;--}}
{{--                                            @endphp--}}
{{--                                            @forelse ($kyluat as $item)--}}
{{--                                                <tr role="row" class="odd">--}}
{{--                                                    <td class="sorting_1">{{ $i += 1 }}</td>--}}
{{--                                                    <td>{{ $item->capquyetdinh }}</td>--}}
{{--                                                    <td>{{ $item->soquyetdinh }}</td>--}}
{{--                                                    <td>{{ $item->noidung }}</td>--}}
{{--                                                    <td>{{ $item->hinhthuckyluat }}</td>--}}
{{--                                                    <td>{{ $item->thoigian }}</td>--}}
{{--                                                </tr>--}}
{{--                                            @empty--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="7">--}}
{{--                                                        Sinh viên này không có thông tin kỷ luật!--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                @endforelse--}}
{{--                                                </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="renluyen">--}}
{{--                                        <h6>Điểm rèn luyện</h6>--}}
{{--                                        <table class="table table-striped jambo_table bulk_action">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="headings">--}}
{{--                                                <th class="column-title">STT</th>--}}
{{--                                                <th class="column-title">Năm học</th>--}}
{{--                                                <th class="column-title">Học kì</th>--}}
{{--                                                <th class="column-title">Điểm</th>--}}
{{--                                                <th class="column-title">Xếp loại</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @php--}}
{{--                                                $i = 0--}}
{{--                                            @endphp--}}

{{--                                            @forelse($renluyen as $item)--}}
{{--                                                <tr role="row" class="odd">--}}
{{--                                                    <td class="sorting_1">{{ $i += 1 }}</td>--}}
{{--                                                    <td>{{ $item->namhoc}}</td>--}}
{{--                                                    <td>{{ $item->hocky }}</td>--}}
{{--                                                    <td>{{ $item->diem }}</td>--}}
{{--                                                    <td>{{ $item->xeploai }}</td>--}}
{{--                                                </tr>--}}
{{--                                            @empty--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="7">--}}
{{--                                                        <div class="alert alert-danger">--}}
{{--                                                            Chưa có đánh giá rèn luyện--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                @endforelse--}}
{{--                                                </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="tamtru">--}}
{{--                                        <table class="table table-striped jambo_table bulk_action">--}}
{{--                                            <thead>--}}
{{--                                            <tr class="headings">--}}
{{--                                                <th>--}}
{{--                                                    <div class="icheckbox_flat-green" style="position: relative;"><input--}}
{{--                                                            type="checkbox" id="check-all" class="flat"--}}
{{--                                                            style="position: absolute; opacity: 0;">--}}
{{--                                                        <ins class="iCheck-helper"--}}
{{--                                                             style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins>--}}
{{--                                                    </div>--}}
{{--                                                </th>--}}
{{--                                                <th class="column-title">Địa chỉ</th>--}}
{{--                                                <th class="column-title">Tên chủ hộ</th>--}}
{{--                                                <th class="column-title">SĐT chủ hộ</th>--}}
{{--                                                <th class="column-title">Thời gian</th>--}}
{{--                                                <th class="column-title">Học kỳ</th>--}}
{{--                                                <th class="column-title">Năm học</th>--}}
{{--                                            </tr>--}}
{{--                                            </thead>--}}
{{--                                            <tbody>--}}
{{--                                            @php--}}
{{--                                                $i = 0--}}
{{--                                            @endphp--}}

{{--                                            @forelse($tamtru as $item)--}}
{{--                                                <tr role="row" class="odd">--}}
{{--                                                    <td class="sorting_1">{{ $i += 1 }}</td>--}}
{{--                                                    <td>{{ $item->so_nha.", ". $item->thon_to.", ".$item->xa_phuong.", ".$item->quan_huyen.", ".$item->tinh_thanh}}</td>--}}
{{--                                                    <td>{{ $item->tenchuho }}</td>--}}
{{--                                                    <td>{{ $item->sdtchuho }}</td>--}}
{{--                                                    <td>{{ $item->thoigian }}</td>--}}
{{--                                                    <td>{{ $item->hocky }}</td>--}}
{{--                                                    <td>{{ $item->nambatdau."-".$item->namketthuc }}</td>--}}
{{--                                                </tr>--}}
{{--                                            @empty--}}
{{--                                                <tr>--}}
{{--                                                    <td colspan="7">--}}
{{--                                                        <div class="alert alert-danger">--}}
{{--                                                            Bạn chưa khai báo trong học kì này! Vui lòng bổ sung khai báo tạm trú trong chỉnh sửa hồ sơ!--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                                @endforelse--}}
{{--                                                </tr>--}}
{{--                                            </tbody>--}}
{{--                                        </table>--}}
{{--                                    </div>--}}
{{--                                    <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="dongthoigian">--}}
{{--                                        <h6>Nhật kí hoạt động</h6>--}}
{{--                                        <ul class="list-unstyled timeline">--}}
{{--                                            @forelse($timeline as $item)--}}
{{--                                                <li>--}}
{{--                                                    <div class="block">--}}
{{--                                                        <div class="tags">--}}
{{--                                                            <a href="" class="tag">--}}
{{--                                                                <span>{{$item->danhmuc}}</span>--}}
{{--                                                            </a>--}}
{{--                                                        </div>--}}
{{--                                                        <div class="block_content">--}}
{{--                                                            <h2 class="title">--}}
{{--                                                                <a>{{$item->tieude}}</a>--}}
{{--                                                            </h2>--}}
{{--                                                            <div class="byline">--}}
{{--                                                                <span>{{\Carbon\Carbon::create($item->thoigian)->format('d-m-Y')}}</span>--}}
{{--                                                            </div>--}}
{{--                                                            <p class="excerpt">{{$item->noidung}}</p>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </li>--}}
{{--                                            @empty--}}
{{--                                            @endforelse--}}
{{--                                        </ul>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    </form>--}}
@endsection
@section('custom-css')
    <style>
        .img-account-profile {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
        .image_area {
            position: relative;
        }</style>
@endsection
