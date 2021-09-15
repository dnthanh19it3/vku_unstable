@extends('layout.admin_layout')
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
                        {{$sinhvien->hodem." ".$sinhvien->ten}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{$sinhvien->tenlop}} MSV {{$sinhvien->masv}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->

                <div class="profile-usermenu">
                    <ul class="nav">
                        <li >
                            <a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Thông tin cá nhân </a>
                        </li>
                        <li class="active">
                            <a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}">
                                <i class="fas fa-star-half-alt"></i>
                                Khen thưởng và kỷ luật </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
           <div class="table-responsive mb-3">
               <div class="table-wrapper">
                   <div class="table-title">
                       <div class="row">
                           <div class="col-sm-5">
                               <h5>Thông tin khen thưởng</h5>
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
                               <td>{{ \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') }}</td>
                               <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                               <td>{{ $item->hocky }}</td>
                               <td>{{ \Carbon\Carbon::make($item->created_at)->format('d-m-Y') }}</td>
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
                                <h5>Thông tin kỷ luật</h5>
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
                                <td>{{ \Carbon\Carbon::make($item->thoigian)->format('d-m-Y') }}</td>
                                <td>{{ $item->nambatdau . "-" . $item->namketthuc }}</td>
                                <td>{{ $item->hocky }}</td>
                                <td>{{ \Carbon\Carbon::make($item->created_at)->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{route('ad.suasinhvien.suakyluat', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="settings" title="Sửa" data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></a>
                                    <a href="{{route('ad.suasinhvien.xoakyluat', ['masv' => $sinhvien->masv, 'id' => $item->id])}}" class="delete" title="Xoá" data-toggle="tooltip"><i class="material-icons">&#xE5C9;</i></a>
                                </td>
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
