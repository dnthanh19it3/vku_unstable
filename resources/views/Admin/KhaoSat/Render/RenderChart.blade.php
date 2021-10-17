@switch($item['loai'])
    @case(1)
{{--    <div class="row">--}}
{{--        <div class="col-md-7 d-flex align-items-center">--}}
{{--            <h5 class="text-red-soft">{{$item['cauhoi']}}</h5>--}}
{{--        </div>--}}
{{--        <div class="col-md-5 hailong_wrapper">--}}
{{--            <div class="hailong_item">--}}
{{--                <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">--}}
{{--                <div class="chuthich">Hoàn toàn không dồng ý</div>--}}
{{--            </div>--}}
{{--            <div class="hailong_item">--}}
{{--                <img title="Không đồng ý" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">--}}
{{--                <div class="chuthich">Không dồng ý</div>--}}
{{--            </div>--}}
{{--            <div class="hailong_item">--}}
{{--                <img title="Đồng ý một phần" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">--}}
{{--                <div class="chuthich">Đồng ý một phần</div>--}}
{{--            </div>--}}
{{--            <div class="hailong_item">--}}
{{--                <img title="Đồng ý" src="{{asset('img/khaosat/dongy.png')}}" alt="">--}}
{{--                <div class="chuthich">Đồng ý</div>--}}
{{--            </div>--}}
{{--            <div class="hailong_item">--}}
{{--                <img title="Hoàn toàn đồng ý" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">--}}
{{--                <div class="chuthich">Hoàn toàn dồng ý</div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @break
    @case(2)
    <div class="row poll-hover">
        <div class="col-md-12 d-flex align-items-center">
            <h6 class="text-red-soft"><i>{{$item['cauhoi']}}</i></h6>
        </div>
        <ul class="col-md-12" style="height: 300px; overflow: scroll">
            @foreach($item['traloi'] as $value) @if($value != null) <li class="">{{$value}}<hr/></li>@endif @endforeach
        </ul>
    </div>
    @break
    @case(3)
    {{--    <div class="form-group">--}}
    {{--        <h5 style="color:red" class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>--}}
    {{--        </h5>--}}
    {{--    </div>--}}
    @break
    @case(4)
    <div class="row poll-hover">
        <div class="col-md-7 d-flex align-items-center">
            <h6 class="text-red-soft"><i>{{$item['cauhoi']}}</i></h6>
        </div>
        <div class="col-md-5 hailong_wrapper">
            <div class="hailong_item" style="flex-direction: row; alignment-baseline: center">
                <canvas id="chart{{$item['id']}}" style="max-width: 360px"></canvas>
                <div style="display: flex; flex-direction: row; alignment-baseline: center; ">
                    <ul style="text-align: left; display: flex; flex-direction: column; align-items: flex-start;
                     justify-content: center; alignment-baseline: center; vertical-align: center; list-style: none; padding: 0; margin: 0">
                        <li><i class="fa fa-circle mr-2" style="color: rgba(255, 99, 132, 0.8)"></i><div style="width: 52px; display: inline-block">{{$item['traloi'][1]." (".$item['traloi_percent'][1]}}%)</div> Hoàn toàn không đồng ý</li>
                        <li><i class="fa fa-circle mr-2" style="color: rgba(54, 162, 235, 0.8)"></i><div style="width: 52px; display: inline-block">{{$item['traloi'][2]." (".$item['traloi_percent'][2]}}%)</div> Không đồng ý</li>
                        <li><i class="fa fa-circle mr-2" style="color: rgba(255, 206, 86, 0.8)"></i><div style="width: 52px; display: inline-block">{{$item['traloi'][3]." (".$item['traloi_percent'][3]}}%)</div> Phân vân</li>
                        <li><i class="fa fa-circle mr-2" style="color: rgba(75, 192, 192, 0.8)"></i><div style="width: 52px; display: inline-block">{{$item['traloi'][4]." (".$item['traloi_percent'][4]}}%)</div> Đồng ý</li>
                        <li><i class="fa fa-circle mr-2" style="color: rgba(153, 102, 255, 0.8)"></i><div style="width: 52px; display: inline-block">{{$item['traloi'][5]." (".$item['traloi_percent'][5]}}%)</div> Hoàn toàn đồng ý</li>
                        <li><i class="fa fa-calculator mr-2" style="color: #cdcdcd"></i><b><div style="width: 52px; display: inline-block">{{$item['avg']}}</div> Trung bình</b></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @break
    @case(5)
    <div class="row">
        <div class="col-md-12 d-flex align-items-center">
            <h5 class="text-red-soft">{{$item['cauhoi']}}</h5>
        </div>
    </div>
    @break
@endswitch
<hr/>