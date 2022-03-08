@extends('layout.admin_layout')
@section('body')
    <!-- NEW -->
    <style>
        .mr-2{margin-right: 8px}
        .ml-1{margin-left: 1px}
        .mr-1{margin-right: 1px}
        .mb-3{margin-bottom: 8px}
    </style>
    <div class="row">
        <div class="col-lg-3 col-xs-12" style="margin-bottom: 1rem">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img id="avatar_round" src="{{$sinhvien_static->anhthe}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{$sinhvien_static->hodem." ".$sinhvien_static->ten}}
                    </div>
                    <div class="profile-usertitle-job">
                        NGÀNH {{$sinhvien_static->tenNganh}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{$sinhvien_static->tenlop}} MSV {{$sinhvien_static->masv}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <div class="profile-usermenu">
                        <ul class="nav nav-pills nav-stacked" id="leftmenu">
                            <li><a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}"> Thông tin cá nhân</a></li>
                            <li class="active"><a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}"><span class="glyphicon glyphicon-star"></span> Khen thưởng kỷ luật</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-lg-9 col-xs-12" method="post" action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}">
            @if($errors->any())
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
            <div class="tab-content" style="height: 100%">
                <div class="tab-pane active" id="canhan">
                    <div class="profile_main_block p-4 bg-white">
                        <h4><i class="fa fa-info-circle mr-2"></i>Thông tin cá nhân</h4>
                        <hr/>
                        <div class="table-responsive mb-3">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <h5><i class="fa fa-star mr-2"></i>Thông tin khen thưởng</h5>
                                        </div>
                                        <div class="col-sm-7">
                                            <a href="{{route('ad.suasinhvien.khenthuong.themview', ['masv' => $sinhvien->masv])}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Thêm mới</span></a>
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
                                        <th>Ngày cập nhật</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($khenthuong as $key => $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $key += 1 }}</td>
                                            <td>{{ $item->noidung }}</td>
                                            <td>{{ $item->soquyetdinh }}</td>
                                            <td>{{ $item->capkhenthuong }}</td>
                                            <td>{{ ($item->thoigian != null) ? \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') : "" }}</td>
                                            <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                            <td>{{ $item->hocky }}</td>
                                            <td>{{ ($item->created_at != null) ? \Carbon\Carbon::make($item->created_at)->format('d-m-Y') : "" }}</td>
                                            <td>
                                                <a href="{{route('ad.suasinhvien.suakhenthuong', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="settings" title="Sửa" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                <a href="{{route('ad.suasinhvien.xoakhenthuong', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                            </td>
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
                                            <h5><i class="fa fa-star-half-full mr-2"></i>Thông tin kỷ luật</h5>
                                        </div>
                                        <div class="col-sm-7">
                                            <a href="{{route('ad.suasinhvien.kyluat.themview', ['masv' => $sinhvien->masv])}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Thêm mới</span></a>
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
                                        <th>Ngày cập nhật</th>
                                        <th>Action</th>
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
                                            <td>{{ ($item->thoigian != null) ? \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') : ""}}</td>
                                            <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                            <td>{{ $item->hocky }}</td>
                                            <td>{{ ($item->created_at != null) ? \Carbon\Carbon::make($item->created_at)->format('d-m-Y') : "" }}</td>
                                            <td>
                                                <a href="{{route('ad.suasinhvien.suakyluat', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="settings" title="Sửa" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                                <a href="{{route('ad.suasinhvien.xoakyluat', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
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
                    font-size: 16px;
                    margin-bottom: 3px;
                }
                .rounded {
                    border-radius: 4px;
                }

            </style>
        </div>
    </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
<script>
    $(document).ready(function (){
        $('#khenthuong-form').hide();
        $('#btnthem').click(function (){
            $('#khenthuong-form').show();
        })
    })
</script>
@endsection
