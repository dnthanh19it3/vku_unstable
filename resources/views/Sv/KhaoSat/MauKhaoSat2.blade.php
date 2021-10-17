@extends('layout.sv_layout')
@section('body')
    <form method="post" action="" class="row">
        {{csrf_field()}}
        <input name="mau_id" value="{{$khaosat['mau']->id}}" hidden/>
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h5><i class="fas fa-poll mr-2"></i>{{$khaosat['mau']->tenmau}}</h5>
                <div class="motakhaosat">
                    {!! $khaosat['mau']->mota !!}
                </div>
                <div class="container-cauhoi">
                    @foreach($khaosat['cauhoi'] as $key => $item)
                        @include('Sv.KhaoSat.RenderTraLoi.RenderTracNghiem', ['cauhoi' => $item])
                    @endforeach
                </div>
            </div>
        </div>
        <button type="submit">Lưu</button>
    </form>
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
            text-align: center;
            flex-grow: 1;
        }
        .noidungcauhoi {
            font-size: 16px;
            font-weight:500;
            padding-left: 16px
        }
    </style>
@endsection
@section('custom-script')
<script>
    let msg = "Không khuyến khích dùng Developer mode ở đây!";
    // document.addEventListener('keydown', function() {
    //     if (event.keyCode == 123) {
    //         alert(msg);
    //         return false;
    //     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) {
    //         alert();
    //         return false;
    //     } else if (event.ctrlKey && event.keyCode == 85) {
    //         alert(msg);
    //         return false;
    //     }
    // }, false);

    // if (document.addEventListener) {
    //     document.addEventListener('contextmenu', function(e) {
    //         alert(msg);
    //         e.preventDefault();
    //     }, false);
    // } else {
    //     document.attachEvent('oncontextmenu', function() {
    //         alert(msg);
    //         window.event.returnValue = false;
    //     });
    // }
</script>
@endsection
