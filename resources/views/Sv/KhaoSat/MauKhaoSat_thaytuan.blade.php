@extends('layout.sv_layout')
@section('body')

    <style>
        .form-group:hover {background: #d3f1d3; padding:0px  !important}
    </style>
    <!-- page content -->
    <!-- top tiles -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h3>{!! $mau->tenmau !!}</h3><br>
                <div class="ln_solid"></div>
            </div>
            <div class="x_content">
                <br/>
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="" method="POST"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">

                @foreach($cauhoi as $item)
                    @include('Sv.KhaoSat.RenderTraLoi.RenderTracNghiem', ['item' => (array) $item])
                @endforeach

                <!-- editor -->
                    <div class="form-group danhgia">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <button type="submit" class="btn btn-success btn-lg">Đánh giá</button>
                            <input type="hidden" id="idlop" name="idlop" value="{!! $mau->id !!}">
                        </div>
                    </div>

                    <style>
                        .checkbox label, .radio label {padding-left: 0px !important}
                        @media only screen and (max-width: 600px) {
                            .chuy {
                                position:fixed; bottom:0px; display: block !important; left:0px;
                                background: #FFF !important;
                                z-index:10000;

                            }
                            .chuy>div {
                                padding: 10px;
                            }

                            .danhgia {margin-bottom:70px !important}
                        }
                    </style>

                </form>

                <div class="chuy" style="display:none">
                    <div>
                        <div class="col-md-1 col-sm-1 col-xs-12" >
                            <img style=""  src="{{ url('public/img/khaosat/hoantoankhongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn không đồng ý</span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img style="" src="{{ url('public/img/khaosat/khongdongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Không đồng ý</span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img style="" src="{{ url('public/img/khaosat/dongymotphan.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý một phần</span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img style="" src="{{ url('public/img/khaosat/dongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Đồng ý</span>
                        </div>
                        <div class="col-md-1 col-sm-1 col-xs-12">
                            <img style="" src="{{ url('public/img/khaosat/hoantoandongy.png') }}" alt="" >&nbsp;&nbsp;<span style="text-align:left;" for="traloi">Hoàn toàn đồng ý</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /top tiles -->
    <!-- /page content -->
@endsection