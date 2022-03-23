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
                            <li><a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}"><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</a></li>
                            <li><a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}"><span class="glyphicon glyphicon-star"></span> Khen thưởng kỷ luật</a></li>
                            <li class="active"><a href="{{route('ad.suasinhvien.tamtru', ['masv' => $sinhvien->masv])}}"><span class="glyphicon glyphicon-plane"></span> Tạm trú</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-lg-9 col-xs-12" method="post" action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}">
            <div class="tab-content" style="height: 100%">
                <div class="tab-pane active" id="canhan">
                    <div class="profile_main_block p-4 bg-white">
                        <div class="row">
                            <div class="col-md-8"><h4><i class="fa fa-info-circle mr-2"></i>Thông tin tạm trú</h4></div>
                            <div class="col-md-4"><a href="{{route('ad.suasinhvien.themtamtru', ['masv' => $sinhvien_static->masv])}}" style="float: right" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Thêm tạm trú</a></div>
                        </div>
                        <hr/>
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert" style="color: red !important;">
                                <b>Có lỗi xảy ra</b>
                                <ul style="margin-left: 8px">
                                    @if(is_array(session('error')))
                                        @forelse(session('error') as $key => $value)
                                            <li>{{ $value }}</li>
                                        @empty
                                            Lỗi không xác định!
                                        @endforelse
                                    @else
                                        {{session('error')}}
                                    @endif
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
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
                                    <th>Hành động</th>
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
                                        <td>@if($item->hienhanh)<span class="status text-success">&bull;</span> Hiện tại @else <span class="status text-danger">&bull;</span> Chỗ ở cũ @endif</td>
                                        <td>{{\Carbon\Carbon::make($item->created_at)->format('d-m-Y')}}</td>
                                        <td>
                                            <a href="{{route('ad.suasinhvien.suatamtru', ['masv' => $sinhvien_static->masv, 'id' => $item->id])}}"><i class="fa fa-pencil"></i></a>
                                            <a href="#" onclick="deleteModal('{{route('ad.suasinhvien.xoatamtru', ['masv' => $sinhvien_static->masv, 'id' => $item->id])}}')"><i class="fa fa-times-circle"></i></a>
                                        </td>
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
                    font-size: 16px;
                    margin-bottom: 3px;
                }
                .rounded {
                    border-radius: 4px;
                }

            </style>
        </div>
    </div>
    <div class="modal" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xoá bản ghi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Xoá bản ghi tạm trú</p>
                </div>
                <div class="modal-footer">
                    <a id="delete_link" class="btn btn-primary">Xoá</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
@endsection
@section('custom-script')
<script>
    function deleteModal(url) {
        $('#deleteModal').modal();
        $('#delete_link').attr('href', url);

        console.log(url);
    }
</script>
@endsection
