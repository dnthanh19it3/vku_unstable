@switch($item['loai'])
    @case(1)
    <div class="row">
        <div class="col-md-7 d-flex align-items-center">
            <h5 class="text-red-soft">{{$item['cauhoi']}}</h5>
        </div>
        <div class="col-md-5 hailong_wrapper">
            <div class="hailong_item">
                <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">
                <div class="chuthich">Hoàn toàn không dồng ý</div>
            </div>
            <div class="hailong_item">
                <img title="Không đồng ý" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">
                <div class="chuthich">Không dồng ý</div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý một phần" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">
                <div class="chuthich">Đồng ý một phần</div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý" src="{{asset('img/khaosat/dongy.png')}}" alt="">
                <div class="chuthich">Đồng ý</div>
            </div>
            <div class="hailong_item">
                <img title="Hoàn toàn đồng ý" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">
                <div class="chuthich">Hoàn toàn dồng ý</div>
            </div>
        </div>
    </div>

{{--    <div class="form-group">--}}
{{--        <h5 style="color:red;" class="col-md-11 col-sm-11 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>--}}
{{--        </h5>--}}
{{--        <div class="col-md-12 col-sm-12 col-xs-12">--}}
{{--            <div class="form-group">--}}
{{--                <h5 style="color:red" class="col-md-7 col-sm-7 col-xs-12" for="tenmau">--}}
{{--                </h5>--}}
{{--                <div class="col-md-1 col-sm-1 col-xs-12">--}}
{{--                    <img style="" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">&nbsp;&nbsp;<span--}}
{{--                            style="text-align:left;" for="traloi">Hoàn toàn không đồng ý</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-1 col-sm-1 col-xs-12">--}}
{{--                    <img style="" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">&nbsp;&nbsp;<span--}}
{{--                            style="text-align:left;" for="traloi">Không đồng ý</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-1 col-sm-1 col-xs-12">--}}
{{--                    <img style="" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">&nbsp;&nbsp;<span--}}
{{--                            style="text-align:left;" for="traloi">Đồng ý một phần</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-1 col-sm-1 col-xs-12">--}}
{{--                    <img style="" src="{{asset('img/khaosat/dongy.png')}}" alt="">&nbsp;&nbsp;<span--}}
{{--                            style="text-align:left;" for="traloi">Đồng ý</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-1 col-sm-1 col-xs-12">--}}
{{--                    <img style="" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">&nbsp;&nbsp;<span--}}
{{--                            style="text-align:left;" for="traloi">Hoàn toàn đồng ý</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    @break
    @case(2)
{{--    <div class="form-group">--}}
{{--        <label class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>--}}
{{--        </label>--}}
{{--        <textarea class="col-md-12 col-sm-12 col-xs-12" wrap="hard" name="tuluan[]" id="tuluan[]"--}}
{{--                  style="height: 80px;"></textarea>--}}
{{--    </div>--}}
    <div class="row poll-hover">
        <div class="col-md-12 d-flex align-items-center">
            <h6 class="text-red-soft"><i>{{$item['cauhoi']}}</i></h6>
        </div>
        <div class="col-md-12">
            <textarea class="form-control rounded" name="tuluan[]" id="tuluan[]">@if($item['traloi'] != null) {{$item['traloi']}} @endif</textarea>
        </div>
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
            <div class="hailong_item">
                <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="1" @if($item['traloi'] != null) {{$item['traloi'] == 1 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Không đồng ý" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="2" @if($item['traloi'] != null) {{$item['traloi'] == 2 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý một phần" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="3" @if($item['traloi'] != null) {{$item['traloi'] == 3 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý" src="{{asset('img/khaosat/dongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="4" @if($item['traloi'] != null) {{$item['traloi'] == 4 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Hoàn toàn đồng ý" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="5" @if($item['traloi'] != null) {{$item['traloi'] == 5 ? "checked" : ""}} @endif required>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="form-group">--}}
{{--        <label class="col-md-7 col-sm-7 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>--}}
{{--        </label>--}}
{{--        <div class="col-md-1 col-sm-1 col-xs-4">--}}
{{--            <div class="radio">--}}
{{--                <input type="radio" title="Hoàn toàn không đồng ý" class="flat" id="traloi1[{!! $item['id'] !!}]"--}}
{{--                       name="traloi[{!! $item['id'] !!}][]" value="1" required>&nbsp;&nbsp;--}}
{{--                <label for="traloi1[{!! $item['id'] !!}]"><img title="Hoàn toàn không đồng ý"--}}
{{--                                                               src="{{asset('img/khaosat/hoantoankhongdongy.png')}}"--}}
{{--                                                               alt=""></label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-1 col-sm-1 col-xs-4">--}}
{{--            <div class="radio">--}}
{{--                <input type="radio" title="Không đồng ý" class="flat" id="traloi2[{!! $item['id'] !!}]"--}}
{{--                       name="traloi[{!! $item['id'] !!}][]" value="2" required>&nbsp;&nbsp;--}}
{{--                <label for="traloi2[{!! $item['id'] !!}]"><img title="Không đồng ý"--}}
{{--                                                               src="{{asset('img/khaosat/khongdongy.png')}}"--}}
{{--                                                               alt=""></label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-1 col-sm-1 col-xs-4">--}}
{{--            <div class="radio">--}}
{{--                <input type="radio" class="flat" title="Đồng ý một phần" id="traloi3[{!! $item['id'] !!}]"--}}
{{--                       name="traloi[{!! $item['id'] !!}][]" value="3" required>&nbsp;&nbsp;--}}
{{--                <label for="traloi3[{!! $item['id'] !!}]"><img title="Đồng ý một phần"--}}
{{--                                                               src="{{asset('img/khaosat/dongymotphan.png')}}"--}}
{{--                                                               alt=""></label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-1 col-sm-1 col-xs-4">--}}
{{--            <div class="radio">--}}
{{--                <input type="radio" class="flat" title="Đồng ý" id="traloi4[{!! $item['id'] !!}]"--}}
{{--                       name="traloi[{!! $item['id'] !!}][]" value="4" required>&nbsp;&nbsp;--}}
{{--                <label for="traloi4[{!! $item['id'] !!}]"><img title="Đồng ý"--}}
{{--                                                               src="{{asset('img/khaosat/dongy.png')}}"--}}
{{--                                                               alt=""></input></label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-1 col-sm-1 col-xs-4">--}}
{{--            <div class="radio">--}}
{{--                <input type="radio" class="flat" title="Hoàn toàn đồng ý" id="traloi5[{!! $item['id'] !!}]"--}}
{{--                       name="traloi[{!! $item['id'] !!}][]" value="5" required>&nbsp;&nbsp;--}}
{{--                <label for="traloi5[{!! $item['id'] !!}]"><img title="Hoàn toàn đồng ý"--}}
{{--                                                               src="{{asset('img/khaosat/hoantoandongy.png')}}"--}}
{{--                                                               alt=""></label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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