@extends('layout.admin_layout')
@section('body')
    @php
        \Carbon\Carbon::setLocale('vi');
    @endphp
    <style>
        .mb-3 {
            margin-bottom: 8px;
        }
        .p-3 {
            padding: 12px;
        }
    </style>
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="x_panel" style="height: 100%">
                <div class="bg-white"><h6>Tổng quan</h6></div>
                <hr/>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 hidden-small">
                            <h6>Danh sách chưa hoàn thành</h6>
                            <table class="countries_list">
                                <tbody>
                                <tr>
                                    <td style="font-size: 16px">Tổng số</td>
                                    <td class="fs15 fw700 text-right font-weight-bolder">{{$stats->tongso}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px">Đã hoàn thành</td>
                                    <td class="fs15 fw700 text-right font-weight-bolder">{{$stats->dahoanthanh}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px">Chưa hoàn thành</td>
                                    <td class="fs15 fw700 text-right font-weight-bolder">{{$stats->chuahoanthanh}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px">Hoàn thành đúng hạn</td>
                                    <td class="fs15 fw700 text-right font-weight-bolder">{{$stats->dunghan}} ({{$stats->dunghan_percent}}%)</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px">Quá hạn</td>
                                    <td class="fs15 fw700 text-right font-weight-bolder">{{$stats->quahan}} ({{$stats->quahan_percent}}%)</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="x_panel">
                <div class="bg-white"><h6>Mục tiêu</h6></div>
                <hr/>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-6 hidden-small">
                            <h6>Danh sách chưa hoàn thành</h6>
                            <table class="countries_list">
                                <tbody>
                                @forelse($listphongban as $item)
                                    <tr>
                                        <td style="font-size: 16px">{{$item->tenphongkhoa}}</td>
                                        <td class="fs15 fw700 text-right">{{$item->soluong}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Chưa có dữ liệu</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="xulyphong"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row"><div class="col mb-3"><h5>TIẾN ĐỘ XỬ LÝ</h5></div></div>
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="bg-white p-3">
                <h6 class="title_danhmuc title_danhmuc-grey">Đang chờ tiếp nhận</h6>
                @foreach($listphongban as $key1 => $value1)
                    <h6>{{$value1->tenphongkhoa}}</h6>
                    @php $count = 0; @endphp
                    @foreach($chotiepnhan as $key2 => $value2)
                        @if($value2->phongban_xuly == $value1->id)
                            @php $count++; @endphp
                            <a class="itemdon itemdon-normal" href="{{route('xem_hs', ['don_id' => $value2->id])}}">
                                <div class="dinhdanh">
                                    <div class="tennguoinop"><i class="fas fa-user-alt mr-1" style="font-size: 10px"></i>{{$value2->hodem. " " . $value2->ten . " - " . $value2->masv}}</div>
                                    <div class="tendon">{{$value2->tenmaudon . ($value2->chuyentiep ? " (Đơn chuyển tiếp)" : "")}}</div>
                                    <div class="tendon">Mã đơn: </i>{{$value2->id}}</div>
                                </div>
                                <div class="thongtin">
                                    <i class="fas fa-hourglass-half"></i><span class="ml-1">{{\Carbon\Carbon::make($value2->thoigianhethan)->diffForHumans()}}</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if($count == 0)
                        <div><i>Không có thông tin</i></div>
                    @else
                        <div><i>Tổng: {{$count}}</i></div>
                    @endif
                    <hr/>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white p-3">
                <h6 class="title_danhmuc title_danhmuc-blue">Đang xử lý</h6>
                @foreach($listphongban as $key1 => $value1)
                    <h6>{{$value1->tenphongkhoa}}</h6>
                    @php $count = 0; @endphp
                    @foreach($dangxuly as $key2 => $value2)
                        @if($value2->phongban_xuly == $value1->id)
                            @php $count++; @endphp
                            <a class="itemdon itemdon-normal" href="{{route('xem_hs', ['don_id' => $value2->id])}}">
                                <div class="dinhdanh">
                                    <div class="tennguoinop"><i class="fas fa-user-alt mr-1" style="font-size: 10px"></i>{{$value2->hodem. " " . $value2->ten . " - " . $value2->masv}}</div>
                                    <div class="tendon">{{$value2->tenmaudon . ($value2->chuyentiep ? " (Đơn chuyển tiếp)" : "")}}</div>
                                    <div class="tendon">Mã đơn: </i>{{$value2->id}}</div>
                                </div>
                                <div class="thongtin">
                                    <i class="fas fa-hourglass-half"></i><span class="ml-1">{{\Carbon\Carbon::make($value2->thoigianhethan)->diffForHumans()}}</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if($count == 0)
                    <div><i>Không có thông tin</i></div>
                    @endif
                    <hr/>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white p-3">
                <h6 class="title_danhmuc title_danhmuc-orange">Phải xử lý hôm nay</h6>
                @foreach($listphongban as $key1 => $value1)
                    <h6>{{$value1->tenphongkhoa}}</h6>
                    @php $count = 0; @endphp
                    @foreach($hethanhomnay as $key2 => $value2)
                        @if($value2->phongban_xuly == $value1->id)
                            @php $count++; @endphp
                            <a class="itemdon itemdon-warm" href="{{route('xem_hs', ['don_id' => $value2->id])}}">
                                <div class="dinhdanh">
                                    <div class="tennguoinop"><i class="fas fa-user-alt mr-1" style="font-size: 10px"></i>{{$value2->hodem. " " . $value2->ten . " - " . $value2->masv}}</div>
                                    <div class="tendon">{{$value2->tenmaudon . ($value2->chuyentiep ? " (Đơn chuyển tiếp)" : "")}}</div>
                                    <div class="tendon">Mã đơn: </i>{{$value2->id}}</div>
                                </div>
                                <div class="thongtin">
                                    <i class="fas fa-hourglass-half"></i><span class="ml-1">{{\Carbon\Carbon::make($value2->thoigianhethan)->diffForHumans()}}</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if($count == 0)
                        <div><i>Không có thông tin</i></div>
                    @endif
                    <hr/>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white p-3">
                <h6 class="title_danhmuc title_danhmuc-red">Đã hết hạn</h6>
                @foreach($listphongban as $key1 => $value1)
                    <h6>{{$value1->tenphongkhoa}}</h6>
                    @php $count = 0; @endphp
                    @foreach($dahethan as $key2 => $value2)
                        @if($value2->phongban_xuly == $value1->id)
                            @php $count++; @endphp
                            <a class="itemdon itemdon-danger" href="{{route('xem_hs', ['don_id' => $value2->id])}}">
                                <div class="dinhdanh">
                                    <div class="tennguoinop"><i class="fas fa-user-alt mr-1" style="font-size: 10px"></i>{{$value2->hodem. " " . $value2->ten . " - " . $value2->masv}}</div>
                                    <div class="tendon">{{$value2->tenmaudon . ($value2->chuyentiep ? " (Đơn chuyển tiếp)" : "")}}</div>
                                    <div class="tendon">Mã đơn: </i>{{$value2->id}}</div>
                                </div>
                                <div class="thongtin">
                                    <i class="fas fa-hourglass-half"></i><span class="ml-1">{{\Carbon\Carbon::make($value2->thoigianhethan)->diffForHumans()}}</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if($count == 0)
                        <div><i>Không có thông tin</i></div>
                    @endif
                    <hr/>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="bg-white p-3">
                <h6 class="title_danhmuc title_danhmuc-grey">Hết hạn tuần này</h6>
                @foreach($listphongban as $key1 => $value1)
                    <h6>{{$value1->tenphongkhoa}}</h6>
                    @php $count = 0; @endphp
                    @foreach($hethantuannay as $key2 => $value2)
                        @if($value2->phongban_xuly == $value1->id)
                            @php $count++; @endphp
                            <a class="itemdon itemdon-normal" href="{{route('xem_hs', ['don_id' => $value2->id])}}">
                                <div class="dinhdanh">
                                    <div class="tennguoinop"><i class="fas fa-user-alt mr-1" style="font-size: 10px"></i>{{$value2->hodem. " " . $value2->ten . " - " . $value2->masv}}</div>
                                    <div class="tendon">{{$value2->tenmaudon . ($value2->chuyentiep ? " (Đơn chuyển tiếp)" : "")}}</div>
                                    <div class="tendon">Mã đơn: </i>{{$value2->id}}</div>
                                </div>
                                <div class="thongtin">
                                    <i class="fas fa-hourglass-half"></i><span class="ml-1">{{\Carbon\Carbon::make($value2->thoigianhethan)->diffForHumans()}}</span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                    @if($count == 0)
                        <div><i>Không có thông tin</i></div>
                    @endif
                    <hr/>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>

        <script>
            var string1 = JSON.stringify(@json($listphongban_chart));
            var cData = JSON.parse(string1);
            var config = {
                type: 'pie',
                data: {
                    labels: cData.tenphongkhoa,
                    datasets: [{
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'

                        ],
                        data: cData.soluong,
                    }]
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                        labels: {
                            fontColor: "black",
                            boxWidth: 20,
                            padding: 20
                        }
                    }
                }
            };

            $(document).ready(()=>{
                var ctx = document.getElementById('xulyphong').getContext('2d');
                window.myPie = new Chart(ctx, config);
            })
        </script>
@endsection
