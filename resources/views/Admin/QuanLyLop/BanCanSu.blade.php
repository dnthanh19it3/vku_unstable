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
                                <th>Họ đệm</th>
                                <th>Tên</th>
                                <th>Mã sinh viên</th>
                                <th>Vai trò</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bancansu as $key => $item)
                                <tr>
                                    <td>{{$key+=1}}</td>
                                    <td>{{$item->hodem}}</td>
                                    <td>{{$item->ten}}</td>
                                    <td>{{$item->masv}}</td>
                                    <td>{{$item->chucvu}}</td>
                                </tr>
                            @endforeach
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
    </div>
@endsection