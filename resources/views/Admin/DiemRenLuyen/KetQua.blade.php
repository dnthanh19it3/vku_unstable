@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="x_panel" style="width: 100%">
                <div class="x_title">
                    <h6>Kết quả tổng hộp</h6>
                </div>
                <div class="x_content">
                    <div class="tile_count">
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Tác vụ phải hoàn thành</span>
                            <div class="count">{{$tongcong}}</div>
                        </div>
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-clock-o"></i>Tạo mới</span>
                            <div class="count green">{{$taomoi}}</div>
                        </div>
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Cập nhật</span>
                            <div class="count red">{{$capnhat}}</div>
                        </div>
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Thất bại</span>
                            <div class="count">{{$loi}}</div>
                        </div>
                        <div class="col-md-2 col-sm-4  tile_stats_count">
                            <span class="count_top"><i class="fa fa-user"></i> Bỏ qua</span>
                            <div class="count">{{$boqua}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách bản ghi thành công</h6>
                </div>
                <div class="x_content">
                    <table class="table scroll-log">
                        <thead>
                        <th>STT</th>
                        <th>Mã sinh viên</th>
                        <th>Điểm</th>
                        <th>Xếp loại</th>
                        </thead>
                        <tbody>
                            @forelse($list_tao as $key => $item)
                                <tr>
                                <td>{{$key += 1}}</td>
                                <td>{{$item['masv']}}</td>
                                <td>{{$item['diem']}}</td>
                                <td>{{$item['xeploai']}}</td>
                                </tr>
                            @empty
                                <td colspan="4">Không có bản ghi</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách bản cập nhật</h6>
                </div>
                <div class="x_content">
                    <table class="table scroll-log">
                        <thead>
                            <th>STT</th>
                            <th>Họ tên</th>
                            <th>Mã sinh viên</th>
                            <th>Điểm</th>
                        </thead>
                        <tbody>
                        @forelse($list_capnhat as $key => $item)
                            <tr>
                            <td>{{$key += 1}}</td>
                            <td>{{$item['masv']}}</td>
                            <td>{{$item['diem']}}</td>
                            <td>{{$item['xeploai']}}</td>
                            </tr>
                        @empty
                            <td colspan="4">Không có bản ghi</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách bản ghi lỗi</h6>
                </div>
                <div class="x_content">
                    <table class="table scroll-log">
                        <thead>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Điểm</th>
                            <th>Xếp loại</th>
                        </thead>
                        <tbody>
                        @forelse($list_loi as $key => $item)
                            <tr>
                            <td>{{$key += 1}}</td>
                            <td>{{$item['masv']}}</td>
                            <td>{{$item['diem']}}</td>
                            <td>{{$item['xeploai']}}</td>
                            </tr>
                        @empty
                            <td colspan="4">Không có bản ghi</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="x_panel">
                <div class="x_title">
                    <h6>Danh sách bản bỏ qua</h6>
                </div>
                <div class="x_content">
                    <table class="table scroll-log">
                        <thead>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Điểm</th>
                            <th>Xếp loại</th>
                        </thead>
                        <tbody>
                        @forelse($list_boqua as $key => $item)
                            <tr>
                            <td>{{$key += 1}}</td>
                            <td>{{$item['masv']}}</td>
                            <td>{{$item['diem']}}</td>
                            <td>{{$item['xeploai']}}</td>
                            </tr>
                        @empty
                            <td colspan="4">Không có bản ghi</td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="#" class="btn btn-primary">Quay về tổng hợp điểm rèn luyện</a>
            <a href="#" class="btn btn-success">Nhập thêm kết quả</a>
        </div>
    </div>
@endsection
@section('custom-css')
    <style>
        .scroll-log {
            overflow-y:scroll;
            height:500px;
            display:block;
        }
    </style>
@endsection
