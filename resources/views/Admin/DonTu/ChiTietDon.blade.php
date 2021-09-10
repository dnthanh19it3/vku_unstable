@extends('layout.admin_layout')
@section('title', 'Chi tiết hồ sơ')
@section('body')
    @php use Carbon\Carbon;Carbon::setLocale('vi') @endphp
    <div class="row">
        <div class="col-md-8">
            <div class="applicant-cover">
                <div class="row">
                    <div class="col-md-8 d-flex text-white align-middle">
                        <img class="img-paper" src="{{asset('images/paper.svg')}}"/>
                        <div class="thongtindon">
                            <h4>{{$don->tenmaudon}}</h4>
                            <h6><i class="fas fa-users-class"></i>&nbsp;Đơn vị xử lý: {{$donvihientai}}</h6>
                            <h6><i class="fas fa-file-alt"></i>&nbsp;ID: 1234</h6>
                            @if($don->chuyentiep)
                                <span><i class="fa fa-share"></i>&nbsp;Đơn được chuyển tiếp từ {{$don->tenphongkhoa}}</span>
                                <span><i class="fa fa-share"></i>&nbsp;Lý do chuyển {{$don->lydo}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="thongtindon-phai">
                            <span>Thời gian nộp: {{$don->thoigiantao}}</span>
                            <span>Thời gian hết hạn: {{$don->thoigianhethan}}</span>
                            @if($lancap > 0)
                                <p>Lần cấp trong năm : <span>{{$lancap}}</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="applicant-content">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="border-bottom pb-2"><i class="fas fa-info-circle mr-2"></i>THÔNG TIN CHUNG</h5>
                        <div class="row m-3">
                            @foreach ($mangTruong as $item)
                                    @if($item->loai_id != 4)
                                    <div class="col-md-6 p-3 vien-net-dut">
                                        <div class="col-md-6 control-label" style="font-size: 16px;"><h6>{{ $item->tentruong }}</h6></div>
                                        <div class="col-md-6" style="font-size: 16px">
                                            {{ $item->lienket == null ? $item->noidung : $sinhvien_arr[$item->lienket]}}
                                        </div>
                                    </div>
                                    @endif
                            @endforeach
                        </div>
                        <h5 class="border-bottom pb-2"><i class="fas fa-paperclip mr-2"></i>TẬP TIN ĐÍNH KÈM</h5>
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
                                            <a href="javascript:void(0)" class="ml-1 action-child" onclick="openPreview('{{ asset('storage/'.$item->noidung)}}')">
                                                <i class="fas fa-eye ml-1"></i>
                                                <span>Xem trước</span>
                                            </a>
                                            <a href="{{ asset('storage/'.$item->noidung)}}"  class="action-child" target="_blank">
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
        <div class="col-md-4">
           @if(!$don->hoanthanh == 1)
                <div class="row">
                    <div class="col-12 p-3">
                        <button class="btn btn-primary btn-sm" type="button" data-toggle="modal"
                                data-target="#modalChuyen"><i class="fa fa-share"></i>&nbsp;Chuyển tiếp
                        </button>
                        <a id="tiepnhan"
                           class="btn btn-sm btn-primary {{$don->trangthai == 0 ? "" : "disabled"}}"
                           href="{{ route('admin.thutuc.tiepnhan', ['don_id' => $don->don_id]) }}"><i class="fa fa-spell-check"></i>&nbsp;Tiếp
                            nhận</a>
                        <a class="btn btn-md btn-primary btn-sm {{($don->trangthai < 1 || $don->trangthai >=2)  ? "disabled" : ""}}"
                           href="{{ route('admin.thutuc.duyet', ['don_id' => $don->don_id]) }}"><i class="fas fa-check-double"></i>&nbsp;Duyệt</a>
                        <button class="btn btn-primary btn-sm {{$don->trangthai < 2 ? "disabled" : ""}}" type="button" data-toggle="modal"
                                data-target="#modalDuyet"><i class="far fa-clipboard-check"></i>&nbsp;Xác nhận
                        </button>
                        <a id="tuchoi" class="btn btn-md btn-danger btn-sm"
                           href="{{ route('admin.thutuc.tuchoi', ['don_id' => $don->don_id]) }}">Từ chối</a>
                    </div>
                </div>
                    @endif
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div id="tracking-pre"></div>
                    <div id="tracking">
                        <div class="text-center tracking-status-intransit">
                            <p class="tracking-status text-tight"><span class="value">TRẠNG THÁI: {{ $don->hoanthanh ? "Hoàn thành" : "Chưa hoàn thành" }} </span></p>
                        </div>
                        <div class="tracking-list bg-white">
                            <ul style="list-style: none; padding-left: 0; font-size: 16px">
                                @foreach($timeline as $item)
                                    <div class="tracking-item">
                                        <div class="tracking-icon status-intransit">
                                            <svg class="svg-inline--fa fa-circle fa-w-16" aria-hidden="true" data-prefix="fas" data-icon="circle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                                <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z"></path>
                                            </svg>
                                            <!-- <i class="fas fa-circle"></i> -->
                                        </div>
                                        <div class="tracking-date">{{\Carbon\Carbon::create($item->thoigian)->format("d-m-Y")}}<span>{{\Carbon\Carbon::create($item->thoigian)->format("h:m ")}}</span></div>
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
    </div>
    <!-- Modal Preview -->
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
        {{-- Modal duyệt và hẹn nhận --}}
        <div class="modal fade" id="modalBosung" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    {{--                <form method="post" action="{{route('bosung_hs', ['don_id' => $don->don_id])}}">--}}
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Yêu cầu bổ sung</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="small mb-1" for="inputUsername">Nhập lời nhắn</label>
                            <input class="form-control" id="inputUsername" type="text" name="ghichu"
                                   placeholder="Ghi chú" value="{{$don->ghichu}}">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Quay lại</button>
                        <button class="btn btn-primary" type="submit">Xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal hẹn nhận --}}
        <div class="modal fade" id="modalDuyet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="{{route('admin.thutuc.xacnhan', ['don_id' => $don->don_id])}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Duyệt và hẹn nhận</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="small mb-1" for="inputUsername">Thời gian hẹn nhận</label>
                                <input class="form-control" id="inputUsername" type="date" name="thoigianhennhan"
                                       placeholder="Ghi chú" value="{{$don->ghichu}}">
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Quay lại</button>
                            <button class="btn btn-primary" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- CHUYỂN TIẾP --}}
        <div class="modal fade bd-example-modal-lg" id="modalChuyen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
             aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form method="post" action="{{route('admin.thutuc.chuyentiep', ['don_id' => $don->don_id])}}">
                        {{ csrf_field() }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Chuyển tiếp đơn từ</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="lydo" class="col-4 col-form-label">Lý do chuyển</label>
                                <div class="col-8">
                                    <input id="lydo" name="lydo" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phongban" class="col-4 col-form-label">Chọn phòng ban cần chuyển</label>
                                <div class="col-8">
                                    <select id="phongban" name="phongban" required="required" class="custom-select">
                                        @foreach($phongban as $key => $value)
                                            <option value="{{$value->id}}">{{$value->tenphongkhoa}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Quay lại</button>
                            <button class="btn btn-primary" type="submit">Xác nhận</button>
                        </div>
                    </form>
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
                    if(url.endsWith("docx") || url.endsWith("doc") || url.endsWith("xlsx") || url.endsWith("xls") || url.endsWith("pdf")){
                        $('#iframe_preview').attr('src', "https://view.officeapps.live.com/op/embed.aspx?src=" + url);
                        console.log("https://view.officeapps.live.com/op/embed.aspx?src=" + url);
                    } else {
                        $('#iframe_preview').attr('src', url);
                    }
                    $('#previewModal').modal();
                }
            </script>
@endsection
