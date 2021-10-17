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
                        <li class="active">
                            <a href="{{route('admin.quanlylop.khenthuongkyluat', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-star"></i>
                                Khen thưởng kỷ luật</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.diemrenluyen', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-random"></i>
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
                <div>
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
                                <th>Năm học</th>
                                <th>Học kỳ</th>
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
                                    <td>{{ $item->nambatdau ."-".$item->namketthuc }}</td>
                                    <td>{{ $item->hocky }}</td>
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

                    </div>
                </div>
                <div>
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
                                <th>Năm học</th>
                                <th>Học kỳ</th>
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
                                    <td>{{ $item->nambatdau ."-".$item->namketthuc }}</td>
                                    <td>{{ $item->hocky }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Chưa có thông tin khen thưởng!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection