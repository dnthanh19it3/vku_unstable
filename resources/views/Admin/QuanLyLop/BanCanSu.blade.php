@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5 class="mb-3">Danh mục</h5>
                <hr/>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
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
                        <li class="active">
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
                                    <h5>Danh sách ban cán sự</h5>
                                </div>
                                <div class="col-sm-7">
                                    <a href="{{route('admin.quanlylop.bonhiembancansu', ['lop_id' => $lop_id])}}" class="btn btn-secondary"><i class="material-icons"></i> <span>Bổ nhiệm BCS</span></a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ và tên</th>
                                <th>Mã sinh viên</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Vai trò</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bancansu as $key => $item)
                                <tr>
                                    <td>{{$key+=1}}</td>
                                    <td><img src="{{asset($item->avatar)}}" class="avatar"/>{{$item->hodem}} {{$item->ten}}</td>
                                    <td>{{$item->masv}}</td>
                                    <td>{{$item->dienthoai}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->chucvu}}</td>
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