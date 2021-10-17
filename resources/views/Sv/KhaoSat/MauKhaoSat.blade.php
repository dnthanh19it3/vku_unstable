@extends('layout.sv_layout')
@section('body')
    <form method="post" action="{{route('sv.khaosat.lamkhaosat.post')}}" class="row">
        {{csrf_field()}}
        <input name="mau_id" value="{{$mau->id}}" hidden/>
        <div class="col-md-12">
            <div class="bg-white p-3">
                <h5><i class="fas fa-poll mr-2"></i>{{$mau->tenmau}}</h5>
                <div class="motakhaosat" style="font-size: 16px">
                    {!! $mau->mota !!}
                </div>
                <div class="container-cauhoi">
                    @foreach($cauhoi as $item)
                        @include('Sv.KhaoSat.RenderTraLoi.RenderTracNghiem', ['item' => (array) $item])
                    @endforeach
                </div>
                <button type="submit" class="btn btn-sm btn-success">Hoàn tất</button>
            </div>
        </div>
    </form>
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
