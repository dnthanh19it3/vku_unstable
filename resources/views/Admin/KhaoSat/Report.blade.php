@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="view-option mb-3 d-flex justify-content-end">
                <a href="{{route('admin.khaosat.baocao', ['id' => $mau->id, 'xem' => "report"])}}" class="btn btn-sm btn-primary disabled"><i class="fa fa-book mr-2"></i>Xem báo cáo</a>
                <a href="{{route('admin.khaosat.baocao', ['id' => $mau->id, 'xem' => "chart"])}}" class="btn btn-sm btn-secondary"><i class="fa fa-chart-pie mr-2"></i>Xem biểu đồ</a>
                <a href="javascript:void(printDiv('section-to-print'))" class="btn btn-sm btn-success"><i class="fa fa-print mr-2"></i>In báo cáo</a>
            </div>
            <div class="bg-white p-3">
                <div class="bg-white" id="section-to-print">
                    <div class="header_block" style="background-color: #0c5460; color: white; padding: 16px; text-transform: uppercase">
                        <h5><i class="fas fa-poll mr-2"></i>Báo cáo khảo sát {{$mau->tenmau}}</h5>
                    </div>
                    <div class="info_block" style="background-color: rgba(241,176,183,0.36); padding: 24px;font-size: 16px">
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
                    @php $i = 0 @endphp
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th rowspan="2">STT</th>
                            <th rowspan="2">Nội dung lấy ý kiến</th>
                            <th colspan="5"  style="text-align: center">Mức độ hài lòng</th>
                            <th rowspan="2" style="text-align: center">Điểm</th>
                        </tr>
                        <tr style="width: 250px">
                            <th style="width: 50px; text-align: center">1</th>
                            <th style="width: 50px; text-align: center">2</th>
                            <th style="width: 50px; text-align: center">3</th>
                            <th style="width: 50px; text-align: center">4</th>
                            <th style="width: 50px; text-align: center">5</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cauhoi as $item)
                            @php if($item->loai == 4){$i+=1;} @endphp
                            @include('Admin.KhaoSat.Render.RenderTable', ['item' => (array) $item, 'i' => $i])
                        @endforeach
                        <tr>
                            <th scope="row" colspan="7"><b>Trung bình</b></th>
                            <th scope="row" style="text-align: center"><b>{{$tb_khaosat}}</b></th>
                        </tr>
                        </tbody>
                    </table>
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
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print {
                position: absolute;
                left: 0;
                top: -76px;
            }
        }
    </style>
@endsection
@section('custom-script')
    <script>
        function printDiv(divName){
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>
@endsection
