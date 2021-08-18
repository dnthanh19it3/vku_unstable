@extends('layout.admin_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Hồ sơ sinh viên</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Settings 1</a>
                                <a class="dropdown-item" href="#">Settings 2</a>
                            </div>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                        <div class="profile_img">
                            <div id="crop-avatar d-flex">
                                <img class="img-account-profile rounded-circle mb-2 " src="{{$sinhvien->avatar}}" alt="Avatar" title="Change the avatar">
                            </div>
                        </div>
                        <!-- Thông tin cá nhân -->
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

                        <a class="btn btn-primary" style="color: #fff" href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}"><i class="fa fa-edit m-right-xs"></i>Sửa hồ sơ</a>
                        <br>

                    </div>
                    <div class="col-md-9 col-sm-9 ">
                            <!-- Danh sách tab -->
                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="thongtincanhan" role="tab" data-toggle="tab" aria-expanded="true">Thông tin cá nhân</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content2" id="anh" role="tab" data-toggle="tab" aria-expanded="false">Ảnh</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content3" id="khen-kyluat" role="tab" data-toggle="tab" aria-expanded="false">Khen thưởng</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content4" role="tab" id="renluyen" data-toggle="tab" aria-expanded="false">Kỷ luật</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content5" role="tab" id="renluyen"
                                                                        data-toggle="tab" aria-expanded="false">Đánh giá rèn luyện</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content6" role="tab" id="tamtru" data-toggle="tab" aria-expanded="false">Tạm trú tạm vắng</a>
                                    </li>
                                    <li role="presentation" class=""><a href="#tab_content7" role="tab" id="dongthoigian"
                                                                        data-toggle="tab" aria-expanded="false">Dòng thời gian</a>
                                    </li>

                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab_content1" aria-labelledby="thongtincanhan">
                                        <div class="profile_title"><!-- Thông tin cá nhân -->
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
                                                <div class="content">{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}</div>
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
                                    <div role="tabpanel" class="tab-pane" id="tab_content2" aria-labelledby="anh">
                                            <h6>Ảnh hiện tại</h6>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <img class="img-fluid" src="{{$sinhvien->avatar}}"/>
                                                </div>
                                            </div>
                                            <h6 class="mt-3">Ảnh đang chờ duyệt</h6>
                                            <hr/>
                                            @if($sinhvien->avatar_temp)
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <img class="img-fluid" src="{{asset($sinhvien->avatar_temp)}}"/>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-3">
                                                        <a href="{{route('ad.duyetanh', ['masv' => $sinhvien->masv])}}" class="btn btn-primary">Duyệt</a>
                                                        <a href="#" class="btn btn-danger">Không duyệt</a>
                                                    </div>
                                                </div>
                                            @else
                                                <div>Không có ảnh nào chờ duyệt!</div>
                                            @endif
                                            <h6 class="mt-3">Ảnh đã duyệt</h6>
                                            <hr/>
                                            <div class="row">
                                                @forelse($anhdatailen as $item)
                                                    <div class="col-md-3">
                                                        <div class="anhhoso-container">
                                                            <img style="width: 100%;height: auto" src="{{asset($item->duongdan)}}"/>
                                                            <div
                                                                class="anhoso-badge">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:m')}}</div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">Chưa có ảnh đã tải lên!</div>
                                                @endforelse
                                            </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="tab_content3" aria-labelledby="khen-kyluat">
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                            <tr class="headings">
                                                <th class="column-title">STT</th>
                                                <th class="column-title">Cấp khen thưởng</th>
                                                <th class="column-title">Số quyết định</th>
                                                <th class="column-title">Nội dung</th>
                                                <th class="column-title">Thời gian</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $i = 0;
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
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="kyluat">
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
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="tamtru">
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
                                                            Bạn chưa khai báo trong học kì này! Vui lòng bổ sung khai báo tạm trú trong chỉnh sửa hồ sơ!
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforelse
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="dongthoigian">
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

                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
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
