@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-7">
            <div class="card mb-3">
                <div class="card-header border-bottom">Thông tin chung</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 ml-3">
                            <p>Tên đơn: <span>{{$don->tenmaudon}}</span></p>
                            <p>Thời gian xử lý: <span>{{$don->thoigianxuly}}</span></p>
                            <p>Điều khoản: <span>{{$don->dieukhoan}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">Trường dữ liệu</div>
                <div class="card-body">
                    <ol>
                    @foreach ($mangTruong as $item)
                        <li class="row">
                            {{$item->tentruong}}
                        </li>
                    @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header border-bottom">Thống kê</div>
                <div class="card-body">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
