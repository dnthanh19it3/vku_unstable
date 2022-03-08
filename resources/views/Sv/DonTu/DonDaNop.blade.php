@extends('layout.sv_layout')
@section('body')
    <style>
        #leftmenu > li.active > a {
            border-left: 2px solid #5b9bd1;
            border-radius: unset;
            background: #f6f9fb !important;
            color: #5b9bd1 !important;
        }
        .equal {
            display: flex;
            display: -webkit-flex;
            flex-wrap: wrap;
        }
        @media (min-width: 768px) {
            .row.equal {
                display: flex;
                flex-wrap: wrap;
            }
        }
        .margin-bottom-3px {
            margin-bottom: 3px;
        }
        .profile_main_block {
            background: #fff;
            padding: 2rem;
            margin-bottom: 1rem;
        }
        .title-text {
            font-weight: 500;
        }
        .mr-2 {
            margin-right: 8px;
        }
    </style>
    <div class="row">
        <div class="col-xs-12 col-lg-12">
            <div class="profile_main_block p-4 bg-white mt-3">
                <h4><i class="fa fa-star-half-full mr-2" aria-hidden="true"></i>Theo dõi tiến độ</h4>
                <hr/>
                <div class="table-responsive">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5">
                                    <h5>Danh sách đơn đã nộp</h5>
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
                                    <?php
                                    $temp_css = "";
                                    if($item->trangthai == 0){
                                        $temp_css = "bg-gray";
                                    }elseif ($item->trangthai == 1){
                                        $temp_css = "bg-blue";
                                    }elseif ($item->trangthai == 2){
                                        $temp_css = "bg-orange";
                                    }elseif ($item->trangthai == 3){
                                        $temp_css = "bg-green";
                                    }elseif ($item->trangthai == 4){
                                        $temp_css = "bg-green";
                                    }elseif ($item->trangthai == 5){
                                        $temp_css = "bg-red";
                                    }
                                    ?>
                                    <td><span class="badge {{$temp_css}}">{{ $item->tentrangthai }}</span></td>
                                    <td>
                                        <a href="{{ route('sv.theodoidon.chitiet', ['don_id' => $item->don_id]) }}">
                                            <i class="fa fa-eye"></i>
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
