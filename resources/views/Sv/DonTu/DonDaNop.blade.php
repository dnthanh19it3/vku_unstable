@extends('layout.sv_layout')
@section('body')
<div class="row">
    <div class="col-md-3">
        <div class="x_panel">
            <div class="x_title"><h6>Thống kê</h6></div>
            <div class="x_content">
                <img class="img-fluid" src="{{asset('images/stat.jpeg')}}"/>
                <div class="row">
                    <div class="col-4" style="text-align: center"><h3 class="text-primary mb-0">100</h3><span>Đã nộp</span></div>
                    <div class="col-4" style="text-align: center"><h3 class="text-success mb-0">100</h3><span>Đã duyệt</span></div>
                    <div class="col-4" style="text-align: center"><h3 class="text-danger mb-0">100</h3><span>Bị từ chối</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="x_panel">
            <div class="x_title mb-0">
                <h6>Danh sách đơn</h6>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <div class="row mb-2">
                    <div class="col-12">
                        <ul class="list-widget-container">
                            <li><a href="{{route('sv.theodoidon', ['trangthai' => "tatca"])}}">Tất cả</a></li>
                            <li><a href="{{route('sv.theodoidon', ['trangthai' => "chuatiepnhan"])}}">Chưa tiếp nhận</a></li>
                            <li><a href="{{route('sv.theodoidon', ['trangthai' => "choxacnhan"])}}">Chờ xác nhận</a></li>
                            <li><a href="{{route('sv.theodoidon', ['trangthai' => "datiepnhan"])}}">Đã xác nhận</a></li>
                            <li><a href="{{route('sv.theodoidon', ['trangthai' => "hoanthanh"])}}">Hoàn thành</a></li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th>
                                <div class="icheckbox_flat-green" style="position: relative;"><input type="checkbox" id="check-all" class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                            </th>
                            <th class="column-title">Tên đơn</th>
                            <th class="column-title">Loại</th>
                            <th class="column-title">Thời gian nộp</th>
                            <th class="column-title">Thời gian hết hạn</th>
                            <th class="column-title">Trạng thái</th>
                            <th class="column-title no-link last"><span class="nobr">Hành động</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                                <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                        @php
                            $i = 0;
                        @endphp

                        @forelse ($dondanop as $item)
                            <tr role="row" class="odd">
                                <td class="sorting_1">{{ $i += 1 }}</td>
                                <td>{{ $item->tenmaudon }}</td>
                                <td>
                                    @if($item->loai_id == 1)
                                        Yêu cầu
                                    @else
                                        Đơn
                                    @endif
                                </td>
                                <td>{{ $item->thoigiantao }}</td>
                                <td>{{ $item->thoigianhethan }}</td>
                                <td><span class="badge">{{ $item->tentrangthai }}</span></td>
                                <td>
                                    <a class=""
                                       href="{{ route('sv.theodoidon.chitiet', ['don_id' => $item->don_id]) }}"
                                    >
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td style="text-align: center" colspan="7">Bạn chưa thực hiện thủ tục nào!</td>
                            </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-script')
    <script>
        $(document).ready(() => {
            $("a[href*='{{\Request::fullUrl()}}']").addClass("current");
        });
    </script>
@endsection
