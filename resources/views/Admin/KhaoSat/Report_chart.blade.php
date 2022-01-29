@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <input name="mau_id" value="{{$mau->id}}" hidden/>
        <div class="col-md-12">
            <div class="view-option mb-3 d-flex justify-content-end">
                <a href="{{route('admin.khaosat.baocao', ['id' => $mau->id, 'xem' => "report"])}}" class="btn btn-sm btn-primary"><i class="fa fa-book mr-2"></i>Xem báo cáo</a>
                <a href="{{route('admin.khaosat.baocao', ['id' => $mau->id, 'xem' => "chart"])}}" class="btn btn-sm btn-secondary disabled"><i class="fa fa-chart-pie mr-2"></i>Xem biểu đồ</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-success"><i class="fa fa-print mr-2 disabled"></i>In báo cáo</a>
            </div>
            <div class="bg-white p-3">
                <div class="header_block" style="background-color: #0c5460; color: white; padding: 16px; text-transform: uppercase">
                    <h5><i class="fas fa-poll mr-2"></i>biểu đồ Báo cáo khảo sát {{$mau->tenmau}}</h5>
                </div>
                <div class="info_block mb-3" style="background-color: rgba(241,176,183,0.36); padding: 24px;font-size: 16px">
                    <div class="info_line">
                        <span>Năm học <b>2021-2022</b></span>
                        <span>Học kỳ <b>2</b></span>
                    </div>
                    <div class="info_line">
                        <span>Số sinh viên tham gia khảo sát <b>{{$thamgia ."/". $tongso}}</b></span>
                        <span>Tỉ lể tham gia khảo sát <b>{{$tile}}%</b></span>
                    </div>
                    <div class="info_line">
                        <span>Điểm đánh giá trung bình <b>{{$tb_khaosat}}/5</b></span>
                    </div>
                    <div class="info_line">
                        <span>Chi tiết đánh giá khảo sát</span>
                    </div>
                </div>
                <div class="container-cauhoi">
                    @foreach($cauhoi as $item)
                        @include('Admin.KhaoSat.Render.RenderChart', ['item' => (array) $item])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- var a = document.getElementsByClassName('flat')  for(i=0; i < a.length; i++){a[i].value = 5} for(i=0; i < a.length; i++){a[i].checked = true} -->

@endsection
@section('custom-css')
    <style>
        .hailong_wrapper {
            padding: 0;
            margin: 0;
            list-style: none;

            -ms-box-orient: horizontal;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -moz-flex;
            display: -webkit-flex;
            display: flex;

            -webkit-justify-content: space-around;
            justify-content: space-around;
            -webkit-flex-flow: row wrap;
            flex-flow: row wrap;
            -webkit-align-items: stretch;
            align-items: stretch;
        }

        .hailong_item {
            display: flex;
            text-align: center;
            flex-direction: column;
            flex-wrap: wrap;
            flex-grow: 1;
            align-content: center;
            width: 100px;
        }

        .hailong_item .chuthich {
            /*white-space: nowrap;*/
            /*width: 0px;*/
            /*overflow: hidden;*/
            /*text-overflow: ellipsis;*/
            /*border: 1px solid #000000;*/
        }

        .hailong_item img {
            width: 25px;
            height: 25px;
            align-self: center;
        }

        .noidungcauhoi {
            font-size: 16px;
            font-weight: 500;
            padding-left: 16px
        }

        .poll-hover:hover {
            background: rgba(205, 205, 205, 0.2);
        }

        .poll-hover {
            border-radius: 8px;
            padding: 8px;
        }
    </style>
@endsection
@section('custom-script')
       <script src="{{asset('vendors/Chart.js/dist/Chart.min.js')}}"></script>
       <?php // Bổ sung (thay cả đoạn foreach mới) ?>
    @foreach($cauhoi as $item)
        @if($item->loai == 4)
            <script>
                var cData = [{{implode(',', $item->traloi)}}];
                var config{{$item->id}} = {
                    type: 'pie',
                    data: {
                        labels: ['Hoàn toàn không đồng ý', 'Không đồng ý', 'Phân vân', 'Đồng ý', 'Hoàn toàn không đồng ý'],
                        datasets: [{
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            data: cData,
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
                    var ctx{{$item->id}} = document.getElementById('chart{{$item->id}}').getContext('2d');
                    window.myPie{{$item->id}} = new Chart(ctx{{$item->id}}, config{{$item->id}});
                })
            </script>
        @elseif($item->loai == 8)
            <script>
                var cData = [{{implode(',', $item->traloi)}}];
                var config{{$item->id}} = {
                    type: 'pie',
                    data: {
                        labels: @json(array_values($item->label)),
                        datasets: [{
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                            ],
                            data: cData,
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
                    var ctx{{$item->id}} = document.getElementById('chart{{$item->id}}').getContext('2d');
                    window.myPie{{$item->id}} = new Chart(ctx{{$item->id}}, config{{$item->id}});
                })
            </script>
        @endif
    @endforeach
@endsection
