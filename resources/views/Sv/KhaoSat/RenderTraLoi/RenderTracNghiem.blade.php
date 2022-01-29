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
    @break
    @case(2)
    <div class="row poll-hover">
        <div class="col-lg-12 col-xs-12 d-flex align-items-center">
            <h6 class="text-red-soft"><i>{{$item['cauhoi']}}</i></h6>
        </div>
        <div class="col-lg-12 col-xs-12">
            <textarea class="form-control rounded" name="tuluan[]" id="tuluan[]">@if(isset($item['traloi'])) {{$item['traloi']}} @endif</textarea>
        </div>
    </div>
    @break
    @case(3)
    <div class="row">
        <div class="col-md-12 d-flex align-items-center">
            <h5 class="text-red-soft">{{$item['cauhoi']}}</h5>
        </div>
    </div>
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
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="1" @if(isset($item['traloi'])) {{$item['traloi'] == 1 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Không đồng ý" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="2" @if(isset($item['traloi'])) {{$item['traloi'] == 2 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý một phần" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="3" @if(isset($item['traloi'])) {{$item['traloi'] == 3 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Đồng ý" src="{{asset('img/khaosat/dongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="4" @if(isset($item['traloi'])) {{$item['traloi'] == 4 ? "checked" : ""}} @endif required>
                </div>
            </div>
            <div class="hailong_item">
                <img title="Hoàn toàn đồng ý" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">
                <div class="radio radio-inline icheck-primary">
                    <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="5" @if(isset($item['traloi'])) {{$item['traloi'] == 5 ? "checked" : ""}} @endif required>
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
    <?php // Bổ sung ?>
    @case(8)
    <div class="row poll-hover">
        <div class="col-lg-7 col-xs-12 d-flex align-items-center">
            <h6 class="text-red-soft"><i>{{$item['cauhoi']}}</i></h6>
        </div>
        <div class="col-lg-5 col-xs-12" style="padding-left: 8px">
            @forelse($item['dapan'] as $key => $value)
                <div class="row">
                    <div class="col-lg-12 col-xs-12">
                        <input type="radio" class="flat" name="traloi[{!! $item['id'] !!}]" value="{{$value->id}}" @if(isset($item['traloi'])) {{$item['traloi'] == $value->id ? "checked" : ""}}@endif>
                        <span>{{$value->dapan}}</span>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    @break
@endswitch
<hr/>