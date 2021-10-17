@switch($cauhoi->loai)
    @case(1)
        <div class="row border-bottom">
            <div class="col-md-8 p-2"><div class="noidungcauhoi">{{$item->cauhoi}}</div></div>
            <div class="col-md-4 p-2 hailong_wrapper">
                <div class="hailong_item">
                    <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/hoantoankhongdongy.png')}}" alt="">
                    <input type="radio" name="tracnghiem[{{$item->id}}]" value="1">
                </div>
                <div class="hailong_item">
                    <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/khongdongy.png')}}" alt="">
                    <input type="radio" name="tracnghiem[{{$item->id}}]" value="2">
                </div>
                <div class="hailong_item">
                    <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/dongymotphan.png')}}" alt="">
                    <input type="radio" name="tracnghiem[{{$item->id}}]" value="3">
                </div>
                <div class="hailong_item">
                    <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/dongy.png')}}" alt="">
                    <input type="radio" name="tracnghiem[{{$item->id}}]" value="4">
                </div>
                <div class="hailong_item">
                    <img title="Hoàn toàn không đồng ý" src="{{asset('img/khaosat/hoantoandongy.png')}}" alt="">
                    <input type="radio" name="tracnghiem[{{$item->id}}]" value="5">
                </div>
            </div>
        </div>
        @break
    @case(2)
        <div class="row border-bottom">
            <div class="col-md-12 p-2">
                <div class="noidungcauhoi">{{$item->cauhoi}}
                    <div class="pl-3">
                        @foreach($cauhoi->dapan as $key => $item2)
                            <div>
                                <input type="radio" name="tracnghiem[{{$item->id}}]" value="{{$item2->id}}" class="mr-2"><label>{{$item2->noidung}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @break
    @case(3)
        <div class="row border-bottom">
            <div class="col-md-12 p-2">
                <div class="noidungcauhoi">{{$item->cauhoi}}
                    <div class="pl-3">
                        @foreach($cauhoi->dapan as $key => $item2)
                            <div>
                                <input type="checkbox" name="tracnghiem[{{$item->id}}][]" value="{{$item2->id}}" class="mr-2"><label>{{$item2->noidung}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        @break
    @case(4)
        <div class="row border-bottom">
            <div class="col-md-12 p-2">
                <div class="noidungcauhoi">{{$item->cauhoi}}
                    <div class="pl-3">
                        <input type="text" name="tuluan{{$item->id}}]" class="form-control rounded mr-2">
                    </div>
                </div>

            </div>
        </div>
        @break
    @case(5)
        <div class="row border-bottom">
            <div class="col-md-12 p-2">
                <div class="noidungcauhoi">{{$item->cauhoi}}
                    <div class="pl-3">
                        <textarea name="tuluan[{{$item->id}}]" class="form-control rounded"></textarea>
                    </div>
                </div>

            </div>
        </div>
        @break
    @case(6)
        <div class="row">
            <div class="col-md-12 p-2">
                <div class="khaosat_heading1">{{$item->cauhoi}}</div>
            </div>
        </div>
        @break
    @case(7)
        <div class="row">
            <div class="col-md-12 p-2">
                <div class="khaosat_heading2">{{$item->cauhoi}}</div>
            </div>
        </div>
        @break
@endswitch