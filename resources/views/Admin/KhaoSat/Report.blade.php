@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <input name="mau_id" value="{{$mau->id}}" hidden/>
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h5><i class="fas fa-poll mr-2"></i>Báo cáo khảo sát {{$mau->tenmau}}</h5>
                <div class="motakhaosat" style="font-size: 16px">
                    {!! $mau->mota !!}
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
        @endif
    @endforeach
@endsection
