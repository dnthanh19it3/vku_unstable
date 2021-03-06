@extends('layout.sv_layout')
@section('title', 'Chi tiết hồ sơ')
@section('body')
    <style>
        .color-white{
            color: white;
        }
        h4 {
            font-size: 28px;
        }
        h5 {
            font-size: 18px;
        }
        .pb-2 {
            padding-bottom: 8px;
        }
        .mr-2 {
            margin-right: 8px;
        }
        .mb-2 {
            margin-bottom: 8px;
        }
    </style>
    <div class="row">
        <div class="col-lg-8 col-xs-12 mb-2">
            <div class="applicant-cover">
                <div class="row">
                    <div class="col-lg-8 col-xs-12 d-flex text-white align-middle">
                        <img class="img-paper" src="{{asset('images/paper.svg')}}"/>
                        <div class="thongtindon">
                            <h4 class="color-white">{{$don->tenmaudon}}</h4>
                            <h6 class="color-white"><i class="fa fa-users"></i>&nbsp;Đơn vị xử lý: {{$don->tenphongkhoa}}</h6>
                            <h6 class="color-white"><i class="fa fa-file"></i>&nbsp;ID đơn: {{$don->id}}</h6>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thongtindon-phai">
                            <span>Thời gian nộp: {{$don->thoigiantao}}</span>
                            <span>Thời gian hết hạn: {{$don->thoigianhethan}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="applicant-content">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="border-bottom pb-2"><i class="fa fa-info-circle mr-2"></i>THÔNG TIN CHUNG</h5>
                        <div class="row m-3">
                            @foreach ($mangTruong as $item)
                                @if($item->loai_id != 4)
                                    <div class="col-md-6 p-3 vien-net-dut">
                                        <div class="col-md-6 control-label" style="font-size: 16px;"><h6 style="font-size: 16px">{{ $item->tentruong }}</h6></div>
                                        <div class="col-md-6" style="font-size: 16px">
                                            {{ $item->noidung != null ? $item->noidung : ""}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <h5 class="border-bottom pb-2"><i class="fa fa-paperclip mr-2"></i>TẬP TIN ĐÍNH KÈM</h5>
                        <div class="row m-3">
                            @php
                                $fileflag = 0
                            @endphp
                            @foreach ($mangTruong as $item)
                                @if($item->loai_id == 4)
                                    <div class="col-md-4 file-block">
                                        <h6 style="display: inline">&nbsp;{{ $item->tentruong }}&nbsp;</h6>
                                        <div class="description">
                                            <div class="icon"><i class="fas fa-file-word"></i></div>
                                            <div class="name">
                                                {{$item->noidung }}
                                            </div>
                                        </div>
                                        <div class="action">
                                            <a href="javascript:void(0)" class="ml-1 action-child" onclick="openPreview('{{ $item->noidung}}')">
                                                <i class="fas fa-eye ml-1"></i>
                                                <span>Xem trước</span>
                                            </a>
                                            <a href="{{ $item->noidung }}"  class="action-child" target="_blank">
                                                <i class="fas fa-download ml-1"></i>
                                                <span>Tải xuống</span>
                                            </a>
                                        </div>
                                    </div>
                                    @php $fileflag = 1 @endphp
                                @endif
                            @endforeach
                        </div>
                        @if(!$fileflag)
                            <span>Không có tập tin đính kèm cho đơn này!</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- start project-detail sidebar -->
        <div class="col-xs-12 col-lg-4 col-sm-3">
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="text-center tracking-status-intransit">
                            <p class="tracking-status text-tight"><span
                                        class="value" style="font-size: 16px; font-weight: 500">TRẠNG THÁI: {{ $don->hoanthanh ? "Hoàn thành" : "Chưa hoàn thành" }} </span>
                            </p>
                        </div>
                        <div class="tracking-list bg-white">
                            <ul style="list-style: none; padding-left: 0; font-size: 16px">
                                @foreach($timeline as $item)
                                    <div class="tracking-item">
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true"
                                                 data-prefix="fas" data-icon="circle" role="img"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                 data-fa-i2svg="">
                                                <path fill="currentColor"
                                                      d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                            </svg>
                                            <i class="fa fa-circle"></i>
                                        </div>
                                        <div class="tracking-date" style="font-size: 16px">{{\Carbon\Carbon::create($item->thoigian)->format("d-m-Y")}}
                                            <span>{{\Carbon\Carbon::create($item->thoigian)->format("h:m ")}}</span>
                                        </div>
                                        <div class="tracking-content" style="font-size: 16px">{{$item->noidung}}</span></div>
                                    </div>
                                    {{--                                            <li @if($item->buoc == $timeline[0]->buoc) style="font-weight: 500" @endif>[{{\Carbon\Carbon::create($item->thoigian)->format("d-m-Y h:m ")}}] {{$item->noidung}}</li>--}}
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- Preview Modal -->
        <div class="modal bd-example-modal-lg fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xem trước tài liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframe_preview" src=''  width='100%' height='600px'></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">&times; Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('custom-css')
            <style>

            </style>
        @endsection
        @section('custom-script')
            <script>
                function openPreview(url) {
                    if (url.endsWith("docx") || url.endsWith("doc") || url.endsWith("xlss") || url.endsWith("xls") || url.endsWith("pdf")) {
                        $('#iframe_preview').attr('src', "https://view.officeapps.live.com/op/embed.aspx?src=" + url);
                        console.log("https://view.officeapps.live.com/op/embed.aspx?src=" + url);
                    } else {
                        $('#iframe_preview').attr('src', url);
                    }
                    $('#previewModal').modal();
                }
            </script>
@endsection
