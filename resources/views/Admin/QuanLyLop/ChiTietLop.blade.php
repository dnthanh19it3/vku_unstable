@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5 class="mb-3">Danh mục</h5>
                <hr/>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{route('admin.quanlylop.chitietlop', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Danh sách lớp </a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.khenthuongkyluat', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Khen thưởng kỷ luật</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.diemrenluyen', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Kết quả rèn luyện</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.bancansu', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Ban cán sự</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h5>Danh sách</h5>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Danh sách lớp</h5>
                                </div>
                                <div class="col-sm-7">

                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Mã sinh viên</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($listsinhvien as $key => $item)
                                <tr>
                                    <td>{{$key+=1}}</td>
                                    <td><img src="{{asset($item->avatar)}}" class="avatar"/>{{$item->hodem}} {{$item->ten}}</td>
                                    <td>{{$item->gioitinh ? "Nữ" : "Nam"}}</td>
                                    <td>{{\Carbon\Carbon::make($item->ngaysinh)->format("d-m-Y")}}</td>
                                    <td>{{$item->masv}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>
                                        <a href="{{route('ad.chitietsv', ['masv' => $item->masv])}}"><i class="fa fa-eye mr-3"></i> <span> </span></a>
                                        <a href="{{route('ad.suasinhvien.canhan', ['masv' => $item->masv])}}"><i class="fa fa-pen"></i> <span> </span></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection