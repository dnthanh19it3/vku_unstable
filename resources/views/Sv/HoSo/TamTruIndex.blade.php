@extends('layout.sv_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <div class="table-wrapper">
                    <div class="table-title">
                        <div class="row">
                            <div class="col-sm-5">
                                <h5>Thông tin tạm trú</h5>
                            </div>
                            <div class="col-sm-7">
                                <a href="{{route('taotamtru')}}" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Khai báo</span></a>
{{--                                <a href="{{route('taotamtru')}}" class="btn btn-secondary"><i class="material-icons">&#xE24D;</i> <span>Tạo tạm trú</span></a>--}}
                            </div>
                        </div>
                    </div>
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
                                <td>@if($item->trangthai)<span class="status text-success">&bull;</span> Hiện tại @else <span class="status text-danger">&bull;</span> Chỗ ở cũ @endif</td>
                                <td>{{\Carbon\Carbon::make($item->created_at)->format('d-m-Y')}}</td>
                            </tr>
                        @empty
                        @endforelse
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
@endsection
