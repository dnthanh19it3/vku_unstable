@extends('layout.sv_layout')
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img id="avatar_round" src="{{asset($sinhvien->avatar)}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{getTruongTinh('hoten',  $sinhvien)}}
                    </div>
                    <div class="profile-usertitle-job">
                         <i class="fas fa-id-card-alt mr-2"></i> MSV {{getTruongTinh('masv', $sinhvien)}} LỚP {{getTruongTinh('tenlop', $sinhvien)}}
                    </div>
                    <div class="profile-usertitle-job">
                        <i class="fas fa-briefcase mr-2"></i>NGÀNH {{getTruongTinh('tennganh', $sinhvien)}}
                    </div>
                    @if(getTruongTinh('tenchuyennganh', $sinhvien))
                        <div class="profile-usertitle-job">
                            <i class="fas fa-briefcase mr-2"></i>{{getTruongTinh('tenchuyennganh', $sinhvien)}}
                        </div>
                    @endif
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <a href="{{route('suahoso')}}" class="btn btn-success btn-sm"><i
                                class="fa fa-edit m-right-xs mr-1"></i>Sửa hồ sơ</a>
                    <a href="{{route('sv.getlylich', ['masv' => session('masv')])}}" class="btn btn-danger btn-sm"><i
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
                                Nhật ký hoạt động
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
                                            <div class="value">{{getTruongTinh('hodem." ".$sinhvien->ten', $sinhvien)}}</div>
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
                                            <div class="value">{{getTruongTinh('doanthe', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Ngày kết nạp</div>
                                            <div class="value">{{getTruongTinh('ngayketnap', $sinhvien)}}</div>
                                        </div>
                                        <div class="col-md-4 info_group">
                                            <div class="label">Tôn giáo</div>
                                            <div class="value">{{getTruongTinh('tongiao', $sinhvien)}}</div>
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
                                    <h6><i class="fas fa-map-marker-alt mr-2"></i>Thường trú và địa chỉ</h6>
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
                                <div>
                                    <div class="profile_main_block p-4 bg-white mt-3">
                                        <h6><i class="fas fa-address-card mr-2"></i>Thông tin liên hệ</h6>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-4 info_group">
                                                <div class="label">Email khác</div>
                                                <div class="value">{{getTruongTinh('email_khac', $sinhvien)}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Điện thoại</div>
                                                <div class="value">{{getTruongTinh('dienthoai', $sinhvien)}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Zalo</div>
                                                <div class="value">{{getTruongTinh('zalo', $sinhvien)}}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 info_group">
                                                <div class="label">Điện thoại gia đình</div>
                                                <div class="value">{{getTruongTinh('dienthoaigiadinh', $sinhvien)}}</div>
                                            </div>
                                            <div class="col-md-4 info_group">
                                                <div class="label">Facebook</div>
                                                <div class="value">{{getTruongTinh('facebook', $sinhvien)}}</div>
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
                                                <h5>Thông tin khen thưởng</h5>
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
                                                <td>{{ \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') }}</td>
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
                                                <h5>Thông tin kỷ luật</h5>
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
                                                <td>{{ \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') }}</td>
                                                <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                                <td>{{ $item->hocky }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8">
                                                    <center>Sinh viên này không có thông tin kỷ luật!</center>
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
                            <div class="mb-3 bg-white p-3" style="width: 100%; height: 30vh; position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                <canvas id="line-chart"></canvas>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="timeline" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="bg-white p-3">
                                <h6>Nhật kí hoạt động</h6>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
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
    <script>
        let label = @json($renluyen_chart['label']);
        let data = @json($renluyen_chart['value']);
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
