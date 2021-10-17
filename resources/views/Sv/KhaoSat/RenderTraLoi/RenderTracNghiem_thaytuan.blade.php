@switch($item['loai'])
    @case(1)



    <div class="form-group">
        <h5 style="color:red;" class="col-md-11 col-sm-11 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>
        </h5>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <h5 style="color:red" class="col-md-7 col-sm-7 col-xs-12" for="tenmau">
                </h5>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">&nbsp;&nbsp;<span
                            style="text-align:left;" for="traloi">Hoàn toàn không đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">&nbsp;&nbsp;<span
                            style="text-align:left;" for="traloi">Không đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">&nbsp;&nbsp;<span
                            style="text-align:left;" for="traloi">Đồng ý một phần</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{asset('img/khaosat/dongy.png')}}" alt="">&nbsp;&nbsp;<span
                            style="text-align:left;" for="traloi">Đồng ý</span>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-12">
                    <img style="" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">&nbsp;&nbsp;<span
                            style="text-align:left;" for="traloi">Hoàn toàn đồng ý</span>
                </div>
            </div>
        </div>
    </div>
    @break
    @case(2)
    <div class="form-group">
        <label class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>
        </label>
        <textarea class="col-md-12 col-sm-12 col-xs-12" wrap="hard" name="tuluan[]" id="tuluan[]"
                  style="height: 80px;"></textarea>
    </div>
    @break
    @case(3)
    <div class="form-group">
        <h5 style="color:red" class="col-md-12 col-sm-12 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>
        </h5>
    </div>
    @break
    @case(4)
    <div class="form-group">
        <label class="col-md-7 col-sm-7 col-xs-12" for="tenmau"><i>{!! $item['cauhoi'] !!}</i>
        </label>
        <div class="col-md-1 col-sm-1 col-xs-4">
            <div class="radio">
                <input type="radio" title="Hoàn toàn không đồng ý" class="flat" id="traloi1[{!! $item['id'] !!}]"
                       name="traloi[{!! $item['id'] !!}][]" value="1" required>&nbsp;&nbsp;
                <label for="traloi1[{!! $item['id'] !!}]"><img title="Hoàn toàn không đồng ý"
                                                               src="{{asset('img/khaosat/hoantoankhongdongy.png')}}"
                                                               alt=""></label>
            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-4">
            <div class="radio">
                <input type="radio" title="Không đồng ý" class="flat" id="traloi2[{!! $item['id'] !!}]"
                       name="traloi[{!! $item['id'] !!}][]" value="2" required>&nbsp;&nbsp;
                <label for="traloi2[{!! $item['id'] !!}]"><img title="Không đồng ý"
                                                               src="{{asset('img/khaosat/khongdongy.png')}}"
                                                               alt=""></label>
            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-4">
            <div class="radio">
                <input type="radio" class="flat" title="Đồng ý một phần" id="traloi3[{!! $item['id'] !!}]"
                       name="traloi[{!! $item['id'] !!}][]" value="3" required>&nbsp;&nbsp;
                <label for="traloi3[{!! $item['id'] !!}]"><img title="Đồng ý một phần"
                                                               src="{{asset('img/khaosat/dongymotphan.png')}}"
                                                               alt=""></label>
            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-4">
            <div class="radio">
                <input type="radio" class="flat" title="Đồng ý" id="traloi4[{!! $item['id'] !!}]"
                       name="traloi[{!! $item['id'] !!}][]" value="4" required>&nbsp;&nbsp;
                <label for="traloi4[{!! $item['id'] !!}]"><img title="Đồng ý"
                                                               src="{{asset('img/khaosat/dongy.png')}}"
                                                               alt=""></input></label>
            </div>
        </div>
        <div class="col-md-1 col-sm-1 col-xs-4">
            <div class="radio">
                <input type="radio" class="flat" title="Hoàn toàn đồng ý" id="traloi5[{!! $item['id'] !!}]"
                       name="traloi[{!! $item['id'] !!}][]" value="5" required>&nbsp;&nbsp;
                <label for="traloi5[{!! $item['id'] !!}]"><img title="Hoàn toàn đồng ý"
                                                               src="{{asset('img/khaosat/hoantoandongy.png')}}"
                                                               alt=""></label>
            </div>
        </div>
    </div>
    @break
    @case(5)
    <div class="form-group">
        <h4 style="color:red;" class="col-md-11 col-sm-11 col-xs-12" for="tenmau"><b>{!! $item['cauhoi'] !!}</b>
        </h4>
    </div>
    @break
@endswitch