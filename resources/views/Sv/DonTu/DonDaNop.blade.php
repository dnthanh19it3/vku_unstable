@extends('layout.sv_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h6>Danh sách đơn đã nộp</h6>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Danh sách đơn</h5>
                                </div>
                                <div class="col-sm-7">
                                    <a href="{{route('sv.danhsachthutuc')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Nộp đơn mới</span></a>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên đơn</th>
                                <th>Loại</th>
                                <th>Thời gian nộp</th>
                                <th>Thời gian hết hạn</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
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
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
