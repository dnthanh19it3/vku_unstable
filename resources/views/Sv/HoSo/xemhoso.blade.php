@extends('layout.sv_layout')
@section('body')

    <div class="col-lg-3 col-xs-12">
        <div class="profile-sidebar">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic">
                <img id="avatar_round" src="{{$sinhvien->anhthe}}" class="img-responsive" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">
                    {{$sinhvien->hodem . " " . $sinhvien->ten}}
                </div>
                <div class="profile-usertitle-job">
                    <i class="fas fa-id-card-alt mr-2"></i> MSV {{$sinhvien->masv}} <i class="fas fa-briefcase mr-2"></i> LỚP {{$sinhvien->tenlop}}<i class="fas fa-briefcase mr-2"></i> KHOÁ {{$sinhvien->khoahoc}}
                </div>
                <div class="profile-usertitle-job">
                    <i class="fas fa-briefcase mr-2"></i>NGÀNH {{$sinhvien->tenNganh}}
                </div>
                <div class="profile-usertitle-job">
                    <i class="fas fa-briefcase mr-2"></i>{{$sinhvien->tenKhoa}}
                </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
                <a href="{{route('suahoso')}}" class="btn btn-success btn-sm"><i
                            class="fa fa-edit m-right-xs mr-1"></i>Sửa hồ sơ</a>
                <a href="{{route('getlylich', ['masv' => session('masv')])}}" class="btn btn-danger btn-sm"><i
                            class="fa fa-file-export m-right-xs mr-1"></i>Xuất lý lịch</a>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->

            <div class="profile-usermenu">
                <div class="profile-usermenu">
                    <ul class="nav nav-pills nav-stacked" id="leftmenu">
                        <li class="active"><a href="#canhan" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Cá nhân</a></li>
                        <li><a href="#khenthuongkyluat" data-toggle="tab"><span class="glyphicon glyphicon-star"></span> Khen thưởng kỷ luật</a></li>
                        <li><a href="#renluyen" data-toggle="tab"><span class="glyphicon glyphicon-ok"></span> Rèn luyện</a></li>
                        <li><a href="#tamtru" data-toggle="tab"><span class="glyphicon glyphicon-send"></span> Tạm trú</a></li>
                        <li><a href="#nhatkyhoatdong" data-toggle="tab"><span class="glyphicon glyphicon-record"></span>  Nhật ký hoạt động</a></li>
                    </ul>
                </div>
            </div>
            <!-- END MENU -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content" style="height: 100%">
            <div class="tab-pane active" id="canhan">
                <!-- Cá nhân -->
                <div>
                    <div class="profile_main_block bg-white margin-bottom-3px">
                        <h4><i class="fa fa-user-md" aria-hidden="true"></i> Thông tin cá nhân</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Họ và tên</div>
                                <div class="col-md-6">{{$sinhvien->hodem . " " . $sinhvien->ten}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Giới tính</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien->gioitinh ? "Nữ" : "Nam"}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Ngày sinh</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Nơi sinh</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->noisinh}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Dân tộc</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dantoc}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">CMND/CCCD</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->cmnd}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Ngày cấp</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->ngaycap}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Nơi cấp</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->noicap}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Đoàn thể</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{ $sinhvien_chitiet->doanthe }}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Ngày kết nạp</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->ngayketnap}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Tôn giáo</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->tongiao}}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Mã BHYT</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{ $sinhvien_chitiet->ma_bhyt }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="profile_main_block p-4 bg-white">
                        <h4><i class="fa fa-users mr-2"></i>Thông tin gia đình</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 ">
                                <h4 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h4>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Họ tên</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->hotencha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Ngày sinh</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->namsinhcha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Dân tộc</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dantoc_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">CMND/CCCD</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->cmnd_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Nghề nghiệp</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->nghenghiep_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Nơi ở</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->diachi_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Email</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->email_cha}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">SĐT</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->sdt_cha}}</div>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h4>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Họ tên</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->hotenme}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Ngày sinh</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->namsinhme}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Dân tộc</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dantoc_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">CMND/CCCD</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->cmnd_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Nghề nghiệp</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->nghenghiep_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Nơi ở</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->diachi_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">Email</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->email_me}}</div>
                                </div>
                                <div class="info_group">
                                    <div class="col-lg-4 col-xs-6 title-text">SĐT</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->sdt_me}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h4>
                                @if($sinhvien_chitiet->thanhphangiadinh != null)
                                    @foreach($sinhvien_chitiet->thanhphangiadinh as $value)
                                        <div class="info_group">
                                            {{$value}}
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="profile_main_block p-4 bg-white mt-3">
                        <h4><i class="fa fa-paper-plane mr-2"></i>Thường trú và địa chỉ</h4>
                        <hr/>
                        <i>Hộ khẩu thường trú</i>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Thôn tổ</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->thon_to}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Xã phường</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->xa_phuong}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Quận huyện</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->quan_huyen}}</div>
                            </div>
                            <div class="col-md-4 col-xs-12 info_group row">
                                <div class="col-lg-4 col-xs-6 title-text">Tỉnh/ Thành phố</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->tinh_thanh}}</div>
                            </div>
                        </div>
                        <i>Địa chỉ liên lạc</i>
                        <div class="row">
                            <div class="col-md-12 info_group">
                                <div class="col-lg-4 col-xs-6 title-text">Địa chỉ</div>
                                <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dia_chi_lien_lac}}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="profile_main_block p-4 bg-white mt-3">
                            <h4><i class="fa fa-phone mr-2"></i>Thông tin liên hệ</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-md-4 col-xs-12 info_group row">
                                    <div class="col-lg-4 col-xs-6 title-text">Email khác</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->email_khac}}</div>
                                </div>
                                <div class="col-md-4 col-xs-12 info_group row">
                                    <div class="col-lg-4 col-xs-6 title-text">Điện thoại</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dienthoai}}</div>
                                </div>
                                <div class="col-md-4 col-xs-12 info_group row">
                                    <div class="col-lg-4 col-xs-6 title-text">Zalo</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->zalo}}</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-xs-12 info_group row">
                                    <div class="col-lg-4 col-xs-6 title-text">Điện thoại gia đình</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->dienthoaigiadinh}}</div>
                                </div>
                                <div class="col-md-4 col-xs-12 info_group row">
                                    <div class="col-lg-4 col-xs-6 title-text">Facebook</div>
                                    <div class="col-lg-8 col-xs-6 content-text">{{$sinhvien_chitiet->facebook}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="khenthuongkyluat">
                <div class="profile_main_block p-4 bg-white mt-3">
                    <h4><i class="fa fa-star-half-full mr-2" aria-hidden="true"></i>Khen thưởng và kỷ luật</h4>
                    <hr/>
                    <div class="table-responsive mb-3">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h4><i class="fa fa-star mr-2" aria-hidden="true"></i>Thông tin khen thưởng</h4>
                                    </div>
                                    <div class="col-sm-7">

                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nội dung khen thưởng</th>
                                    <th>Số quyết định</th>
                                    <th>Cấp quyết định</th>
                                    <th>Thời gian</th>
                                    <th>Năm học</th>
                                    <th>Học kỳ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($khenthuong as $key => $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $key += 1 }}</td>
                                        <td>{{ $item->noidung }}</td>
                                        <td>{{ $item->soquyetdinh }}</td>
                                        <td>{{ $item->capkhenthuong }}</td>
                                        <td>{{ $item->thoigian ? \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') : "N/A" }}</td>
                                        <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                        <td>{{ $item->hocky }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <center>Sinh viên này không có thông tin khen thưởng!</center>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <h4><i class="fa fa-star-half-full mr-2" aria-hidden="true"></i>Thông tin kỷ luật</h4>
                                    </div>
                                    <div class="col-sm-7">
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nội dung khiển trách</th>
                                    <th>Số quyết định</th>
                                    <th>Cấp quyết định</th>
                                    <th>Hình thức</th>
                                    <th>Thời gian</th>
                                    <th>Năm học</th>
                                    <th>Học kỳ</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($kyluat as $key => $item)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ $key += 1 }}</td>
                                        <td>{{ $item->capquyetdinh }}</td>
                                        <td>{{ $item->soquyetdinh }}</td>
                                        <td>{{ $item->noidung }}</td>
                                        <td>{{ $item->hinhthuckyluat }}</td>
                                        <td>{{ $item->thoigian ? \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') : "N/A"}}</td>
                                        <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                        <td>{{ $item->hocky }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9">
                                            <center>Sinh viên này không có thông tin kỷ luật!</center>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="renluyen">
                <div class="profile_main_block p-4 bg-white mt-3">
                    <h4><i class="fa fa-check-circle mr-2" aria-hidden="true"></i>Kết quả rèn luyện</h4>
                    <hr/>
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h4>Kết quả rèn luyện</h4>
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
                                    <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
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
                    <h4 style="margin-top: 1rem"><i class="fa fa-line-chart mr-2" aria-hidden="true"></i>Biểu đồ điểm rèn luyện</h4>
                    <hr/>
                    <div class="mb-3 bg-white p-3" style="width: 100%; height: 30vh; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="nhatkyhoatdong">
                <div class="profile_main_block p-4 bg-white mt-3">
                    <h4><i class="fa fa-reorder mr-2" aria-hidden="true"></i>Nhật ký hoạt động</h4>
                    <hr/>
                    <ul class="list-unstyled timeline">
                        @forelse($log_sinhvien as $item)
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>{{$item->module}}</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                            <a>{{$item->action}}</a>
                                        </h2>
                                        <div class="byline">
                                            <span>{{\Carbon\Carbon::create($item->created_at)->format('d-m-Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li>Chưa có hoạt động được ghi nhận!</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="tab-pane" id="tamtru">
                <div class="profile_main_block p-4 bg-white mt-3">
                    <h4><i class="fa fa-map-marker mr-2" aria-hidden="true"></i>Thông tin tạm trú</h4>
                    <hr/>
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
                                <td>{{$item->thoigianbatdau ? \Carbon\Carbon::make($item->thoigianbatdau )->format('d-m-Y') : "N/A"}}</td>
                                <td>@if($item->hienhanh)<span class="status text-success">&bull;</span> Hiện tại @else <span class="status text-danger">&bull;</span> Chỗ ở cũ @endif</td>
                                <td>{{$item->created_at ? \Carbon\Carbon::make($item->created_at)->format('d-m-Y'):"N/A"}}</td>
                            </tr>
                        @empty
                        @endforelse
                        </tbody>
                    </table>
                </div>
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
        }
        .mr-2 {
            margin-right: 8px;
        }

    </style>
@endsection
@section('custom-css')
    <style>
        .nav-link {display: block !important;}
    </style>
@endsection
@section('custom-script')
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            let lmenu = $("#v-pills-tab");
            let child = lmenu.children();

            for(let i = 0; i < child.length; i++){
                console.log(child[i]);
            }
            console.log(child)
        });
        resizeAvatar();
        $(window).resize(()=>{
            resizeAvatar()
        });
        function resizeAvatar(){
            var cw = $('#avatar_round').width();
            $('#avatar_round').css({'height': + cw +'px'});
        }
    </script>
    <script>
        let label = {!! json_encode($renluyen_chart['label']) !!};
        let data = {!! json_encode($renluyen_chart['value']) !!};
        if(label.length == 1){
            label.push("");
            label.unshift("");
            data.push(null);
            data.unshift(null);
        }

        $(document).ready(()=>{
            const lineChart = new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: label,
                    datasets: [{
                        data: data,
                        label: "Điểm",
                        borderColor: "#3e95cd",
                        fill: true,
                    }                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    title: {
                        display: true,
                        text: 'Biểu đồ điểm rèn luyện'
                    },
                    response:true,
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Học kỳ'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: false,
                                steps: 10,
                                stepValue: 10,
                                max: 100,
                                min: 60,
                            },
                            scaleLabel: {
                                display: true,
                                labelString: 'Điểm'
                            },
                        }]
                    },
                }
            });
            lineChart.resize(300, 500);
        })
    </script>
@endsection
