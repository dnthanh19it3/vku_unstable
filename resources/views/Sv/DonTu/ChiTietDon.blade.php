@extends('layout.sv_layout')
@section('title', 'Chi tiết hồ sơ')
@section('body')
    <div class="row">
        <div class="col-md-8">
            <div class="applicant-cover">
                <div class="row">
                    <div class="col-md-8 d-flex text-white align-middle">
                        <img class="img-paper" src="{{asset('images/paper.svg')}}"/>
                        <div class="thongtindon">
                            <h4>{{$don->tenmaudon}}</h4>
                            <h6><i class="fas fa-users-class"></i>&nbsp;Đơn vị xử lý: {{$don->tenphongban}}</h6>
                            <h6><i class="fas fa-file-alt"></i>&nbsp;ID: {{$don->id}}</h6>
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
                        <h5 class="border-bottom pb-2">THÔNG TIN CHUNG</h5>
                        <div class="row m-3">
                            @foreach ($mangTruong as $item)
                                @if($item->loai_id != 4)
                                    <div class="col-md-6 p-3 vien-net-dut">
                                        <div class="col-md-6 control-label" style="font-size: 16px;">
                                            <h6>{{ $item->tentruong }}</h6></div>
                                        <div class="col-md-6" style="font-size: 16px">
                                            {{ $item->lienket == null ? $item->noidung : $sinhvien_arr[$item->lienket]}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <h5 class="border-bottom pb-2">TẬP TIN ĐÍNH KÈM</h5>
                        <div class="row m-3">
                            @php
                                $fileflag = 0
                            @endphp
                            @foreach ($mangTruong as $item)
                                @if($item->loai_id == 4)
                                    <div class="col-md-12"><i class="fas fa-paperclip"></i> <h6 style="display: inline">
                                            &nbsp;{{ $item->tentruong }}&nbsp;</h6> <a href="javascript:void(0)"
                                                                                       class="ml-1"
                                                                                       onclick="openPreview('{{ asset('storage/'.$item->noidung)}}')"><i
                                                    class="fas fa-eye ml-1"></i>Xem trước</a><a
                                                href="{{ asset('storage/'.$item->noidung)}}" target="_blank"><i
                                                    class="fas fa-download ml-1"></i>Tải xuống</a></div>
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
        <div class="col-md-4 col-sm-3  ">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="text-center tracking-status-intransit">
                            <p class="tracking-status text-tight"><span
                                        class="value">TRẠNG THÁI: {{ $don->hoanthanh ? "Hoàn thành" : "Chưa hoàn thành" }} </span>
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
                                            <!-- <i class="fas fa-circle"></i> -->
                                        </div>
                                        <div class="tracking-date">{{\Carbon\Carbon::create($item->thoigian)->format("d-m-Y")}}
                                            <span>{{\Carbon\Carbon::create($item->thoigian)->format("h:m ")}}</span>
                                        </div>
                                        <div class="tracking-content">{{$item->noidung}}</span></div>
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
        <div class="modal bd-example-modal-lg fade" id="previewModal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xem trước tài liệu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe id="iframe_preview" src='' width='100%' height='600px' frameborder='0'></iframe>
                        {{--                        https://view.officeapps.live.com/op/embed.aspx?src=http://vku.udn.vn/uploads/2021/08/08/1628389623_1628247038_64-K%E1%BA%BF%20ho%E1%BA%A1ch%20Th%E1%BB%B1c%20t%E1%BA%ADp%20Doanh%20nghi%E1%BB%87p%20K19%20(1).doc--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
