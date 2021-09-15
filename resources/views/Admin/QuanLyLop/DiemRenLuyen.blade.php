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
                        <li  class="active">
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
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>Đánh giá rèn luyện</h5>
                            </div>
                            <div class="col-sm-7">
                                <form id="formhocky" method="get" action="" onchange="this.submit()">
                                    <select name="hocky" class="form-control rounded">
                                        <option readonly>Chọn học kỳ</option>
                                        @forelse($danhsachhocky as $item)
                                            <option value="{{$item->namhoc."_".$item ->hocky}}">HK{{$item ->hocky}} {{$item->nambatdau."-"."$item->namketthuc"}}</option>
                                        @empty
                                            <option disabled>Chưa có kết quả</option>
                                        @endforelse
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="column-title">Họ và tên</th>
                            <th class="column-title">Mã sinh viên</th>
                            <th class="column-title">Ngày sinh</th>
                            <th class="column-title">Điểm</th>
                            <th class="column-title">Xếp loại</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($ketquadanhgia as $key => $item)
                                <tr>
                                <td>{{$key+=1}}</td>
                                <td>{{$item->hodem ." ". $item->ten}}</td>
                                <td>{{$item->masv}}</td>
                                <td>{{$item->ngaysinh}}</td>
                                <td>{{$item->diem}}</td>
                                <td>{{$item->xeploai}}</td>
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

{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="x_panel">--}}
{{--                <div class="x_title">--}}
{{--                    <h5>Danh sách sinh viên</h5>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}
{{--                    <form class="row" action="" method="get" onchange="this.submit()">--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label>Lớp sinh hoạt</label>--}}
{{--                            <select name="lop" class="form-control">--}}
{{--                                <option>Chọn lớp</option>--}}
{{--                                @forelse($lop as $item)--}}
{{--                                    <option @if($lop_dangchon == $item->id) selected--}}
{{--                                            @endif value="{{$item->id}}">{{$item->tenlop}}</option>--}}
{{--                                @empty--}}
{{--                                    <option>Không có thông tin</option>--}}
{{--                                @endforelse--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label>Năm học</label>--}}
{{--                            <select name=namhoc class="form-control">--}}
{{--                                <option>Chọn năm học</option>--}}
{{--                                @isset($namhoc)--}}
{{--                                    @forelse($namhoc as $item)--}}
{{--                                        <option value="{{$item->namhoc_id}}" {{$selected_namhoc == $item->namhoc_id ? "selected" : ""}}>{{$item->nambatdau."-".$item->namketthuc}}</option>--}}
{{--                                    @empty--}}
{{--                                        <option>Vui lòng chọn lớp</option>--}}
{{--                                    @endforelse--}}
{{--                                @endisset--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label>Học kỳ</label>--}}
{{--                            <select name="hocky" class="form-control">--}}
{{--                                <option>Chọn học kỳ</option>--}}
{{--                                <option value="1" {{$selected_hocky == 1 ? "selected" : ""}}>Học kỳ 1</option>--}}
{{--                                <option value="2" {{$selected_hocky == 2 ? "selected" : ""}}>Học kỳ 2</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3">--}}
{{--                            <label>Tìm kiếm</label>--}}
{{--                            <button class="btn btn-sm btn-primary form-control">Tìm kiểm</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="x_panel">--}}
{{--                <div class="x_content">--}}
{{--                    <table class="table table-striped jambo_table bulk_action">--}}
{{--                        <thead>--}}
{{--                        <tr class="headings">--}}
{{--                            <th class="column-title">ID</th>--}}
{{--                            <th class="column-title">Mã sinh viên</th>--}}
{{--                            <th class="column-title">Họ đệm</th>--}}
{{--                            <th class="column-title">Tên</th>--}}
{{--                            <th class="column-title">Ngày sinh</th>--}}
{{--                            <th class="column-title">Điểm</th>--}}
{{--                            <th class="column-title">Xếp loại</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @isset($danhsach)--}}
{{--                            @forelse($danhsach as $key => $item)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$key+=1}}</td>--}}
{{--                                    <td>{{$item->hodem}}</td>--}}
{{--                                    <td>{{$item->ten}}</td>--}}
{{--                                    <td>{{$item->masv}}</td>--}}
{{--                                    <td>{{\Carbon\Carbon::make($item->ngaysinh)->format("d-m-Y")}}</td>--}}
{{--                                    <td>{{$item->diem}}</td>--}}
{{--                                    <td>{{$item->xeploai}}</td>--}}
{{--                                </tr>--}}
{{--                            @empty--}}
{{--                                <tr><td colspan="7">Không có dữ liệu</td></tr>--}}
{{--                            @endforelse--}}
{{--                        @endisset--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

@endsection
