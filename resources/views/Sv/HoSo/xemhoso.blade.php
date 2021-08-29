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
            <div class="row">
                <div class="col-md-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-canhan-tab" data-toggle="tab" href="#nav-canhan" role="tab" aria-controls="nav-canhan" aria-selected="true">Cá nhân</a>
                            <a class="nav-item nav-link" id="nav-khenthuong-tab" data-toggle="tab" href="#nav-khenthuong" role="tab" aria-controls="nav-khenthuong" aria-selected="false">Khen thưởng</a>
                            <a class="nav-item nav-link" id="nav-kyluat-tab" data-toggle="tab" href="#nav-kyluat" role="tab" aria-controls="nav-kyluat" aria-selected="false">Kỷ luật</a>
                            <a class="nav-item nav-link" id="nav-renluyen-tab" data-toggle="tab" href="#nav-renluyen" role="tab" aria-controls="nav-renluyen" aria-selected="false">Rèn luyện</a>
                            <a class="nav-item nav-link" id="nav-timeline-tab" data-toggle="tab" href="#nav-timeline" role="tab" aria-controls="nav-about" aria-selected="false">Timeline</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-canhan" role="tabpanel" aria-labelledby="nav-canhan-tab">
                            <div>
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
                        <div class="tab-pane fade" id="nav-khenthuong" role="tabpanel" aria-labelledby="nav-khenthuong-tab">
                            <div>
                                <div class="table-responsive">
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
                                                <th>Thời gian</th>
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
                                                    <td>{{ $item->thoigian }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6">Chưa có thông tin khen thưởng!</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                        <div class="clearfix">
                                            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                                            <ul class="pagination">
                                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-kyluat" role="tabpanel" aria-labelledby="nav-kyluat-tab">
                            <div>
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
                                                <th>Hình thức kỷ luật</th>
                                                <th>Thời gian</th>
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
                                                    <td>{{ $item->thoigian }}</td>
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
                                        <div class="clearfix">
                                            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                                            <ul class="pagination">
                                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-renluyen" role="tabpanel" aria-labelledby="nav-renluyen-tab">
                            <div>
                                <div class="table-responsive">
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
                                            </tbody>
                                        </table>
                                        <div class="clearfix">
                                            <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                                            <ul class="pagination">
                                                <li class="page-item disabled"><a href="#">Previous</a></li>
                                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                                <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                                <li class="page-item"><a href="#" class="page-link">4</a></li>
                                                <li class="page-item"><a href="#" class="page-link">5</a></li>
                                                <li class="page-item"><a href="#" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-timeline" role="tabpanel" aria-labelledby="nav-timeline-tab">
                            <div class="bg-white p-5">
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
@section('custom-css')
<style>
    nav > .nav.nav-tabs{

        border: none;
        color:#fff;
        background:#272e38;
        border-radius:0;

    }
    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
        border: none;
        padding: 18px 25px;
        color:#000;
        font-weight: 500;
        background: #fff;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link.active:after
    {
        content: "";
        position: relative;
        bottom: -60px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #26B99A;
    }
    .tab-content{
        /*background: #fdfdfd;*/
        line-height: 25px;
        /*border: 1px solid #ddd;*/
        border-top:5px solid #26b99a;
        border-bottom:5px solid #26b99a;
        padding:30px 25px;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
        border: none;
        background: #26b99a;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
</style>
@endsection
