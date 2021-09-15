@extends('layout.sv_layout')
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
                         <i class="fas fa-id-card-alt mr-2"></i> MSV {{$sinhvien->masv}} LỚP {{$sinhvien->tenlop}}
                    </div>
                    <div class="profile-usertitle-job">
                        <i class="fas fa-briefcase mr-2"></i>NGÀNH {{$sinhvien->tennganh}}
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
                    <div class="profile-usermenu">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="canhan-tab" data-toggle="pill" href="#canhan" role="tab" aria-controls="canhan" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Cá nhân
                            </a>
                            <a class="nav-link" id="khenthuong-tab" data-toggle="pill" href="#khenthuong" role="tab" aria-controls="khenthuong" aria-selected="false">
                                <i class="fas fa-star-half-alt"></i>
                                Khen thưởng kỷ luât
                            </a>
                            <a class="nav-link" id="renluyen-tab" data-toggle="pill" href="#renluyen" role="tab" aria-controls="renluyen" aria-selected="false">
                                <i class="fas fa-user-check mr-1"></i>
                                Rèn luyện
                            </a>
                            <a class="nav-link" id="timeline-tab" data-toggle="pill" href="#timeline" role="tab" aria-controls="timeline" aria-selected="false">
                                <i class="fas fa-stream mr-1"></i>
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
                                    <h6><i class="fas fa-info-circle mr-2"></i>Thông tin cá nhân</h6>
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
                                            <div class="value">{{getTruongTinh('doanthe', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Ngày kết nạp</div>
                                            <div class="value">{{$sinhvien->ngayketnap}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Tôn giáo</div>
                                            <div class="value">{{$sinhvien->tongiao}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="profile_main_block p-4 bg-white">
                                            <h6><i class="fas fa-users mr-2"></i>Thông tin gia đình</h6>
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
                                    <h6><i class="fas fa-map-marker-alt mr-2"></i>Thường trú và địa chỉ</h6>
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
                                <div>
                                    <div class="profile_main_block p-4 bg-white mt-3">
                                        <h6><i class="fas fa-address-card mr-2"></i>Thông tin liên hệ</h6>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-4 info_group">
                                                <div class="label">Email khác</div>
                                                <div class="value">{{$sinhvien->email_khac}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Điện thoại</div>
                                                <div class="value">{{$sinhvien->dienthoai}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Zalo</div>
                                                <div class="value">{{$sinhvien->zalo}}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 info_group">
                                                <div class="label">Điện thoại gia đình</div>
                                                <div class="value">{{$sinhvien->dienthoaigiadinh}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Email khác</div>
                                                <div class="value">{{$sinhvien->facebook}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="khenthuong" role="tabpanel" aria-labelledby="khenthuong-tab">
                            <div class="table-responsive mb-3">
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
                                            <th>Hình thức kỷ luật</th>
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
                                                <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
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
                            <div class="table-responsive mb-3">
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
                                            <th>Hình thức kỷ luật</th>
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
                                                <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                                <td>{{ $item->hocky }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    Sinh viên này không có thông tin kỷ luật!
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="kyluat" role="tabpanel" aria-labelledby="kyluat-tab">
                            <div>

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
