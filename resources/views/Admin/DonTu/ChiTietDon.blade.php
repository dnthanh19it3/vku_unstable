@extends('layout.admin_layout')
@section('body')
    <style>
        .text-red {
            color: red !important;
        }

        .form-control {
            border-radius: 5px;
        }
        .mr-1 {
            margin-right: 8px;
        }
        .filepond--credits {
            display: none !important;
        }
    </style>
    <div class="col-xs-12 col-sm-4 col-xl-4 col-lg-4">
        <div class="x_panel">
            <div class="x_title">
                <h4 style="float: left"> <i class="fa fa-file"></i> Thông tin đơn</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Trạng thái: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->tentrangthai}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Thời gian hết hạn: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->thoigianhethan}}
                    </div>
                </div>
                <div class="form-row row">
                    <div class="col-xs-6">
                        <b>Thời gian tiếp nhận: </b>
                    </div>
                    <div class="col-xs-6">
                        {{$don->thoigiantiepnhan}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-8 col-xl-8 col-lg-8">
        <div class="x_panel">
            <div class="x_title">
                <div class="row">
                    <div class="col-md-8">
                        <div class="dropdown" style="display: inline-block">
                            <button class="dropdown-toggle" style="background-color: #0b7ec4 !important; color: white; padding: 8px 12px; border-radius: 100px; width: auto; border: none" type="button" data-toggle="dropdown"><i class="fa fa-list"></i> {{$don->tentrangthai}}
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">HTML</a></li>
                                <li><a href="#">CSS</a></li>
                                <li><a href="#">JavaScript</a></li>
                            </ul>
                        </div>
                        <div style="display: inline-block">
                            <button style="background-color: #0b7ec4 !important; color: white; padding: 8px 12px; border-radius: 100px; width: auto; border: none" onclick="showReplyBox()"><i class="fa fa-reply"></i> Phản hồi</button>
                        </div>
                    </div>
                </div>
                <hr/>
                <style>
                    .replybox {
                        padding: 16px;
                        border: 1px solid #cdcdcd;
                        border-radius: 8px;
                    }
                    .reply-input {
                        margin-bottom: 16px;
                    }
                    .reply-input textarea {
                        border: 1px solid #cdcdcd;
                    }

                    .comment-img {
                        width: 3rem;
                        height: 3rem;
                    }

                    .comment-replies .comment-img {
                        width: 1.75rem;
                        height: 1.75rem;
                    }
                    .comment-block {
                        display: flex; flex-direction: row; background-color: rgba(128,128,128,0.1); padding: 16px; border-radius: 8px; margin-bottom: 16px;
                    }
                    .comment-imageblock {
                        display: flex;
                        margin-right: 16px;
                    }
                    .comment-block .img {
                        width: 62px; height: 62px; object-fit: cover; border-radius: 999px
                    }
                    .comment-textblock {
                        display: flex; flex-grow: 1; flex-direction: column
                    }
                    .comment-textblock .username {
                        font-weight: 500; font-size: 16px
                    }
                    .comment-textblock .time {
                        font-size: 14px; font-weight: 400
                    }
                    .comment-textblock .comment {
                        font-weight: 400; font-size: 14px
                    }
                </style>

                <form id="replybox" class="replybox" method="post" action="{{route('admin.thutuc.phanhoi', ['don_id' => $don->id])}}">
                    {{ csrf_field() }}
                    <div>
                        @forelse($phanhoi as $key => $item)
                            <div class="comment-block">
                                <div class="comment-imageblock">
                                    <img src="https://cdn.vku-udn.edu.vn/daotao/sinhvien/19IT195.jpg" class="img"/>
                                </div>
                                <div class="comment-textblock">
                                    <div class="username">
                                        {{ $item->nguoigui }}
                                        <span class="time">10h30</span>
                                    </div>
                                    <div class="comment">
                                        {{ $item->noidung }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="comment-block">
                                Chưa có phản hồi!
                            </div>
                        @endforelse
                    </div>
                    <hr/>
                    <div class="reply-input">
                        <textarea class="form-control" name="noidung" placeholder="Nhập nội dung phản hồi" required></textarea>
                    </div>
                    <div class="reply-button">
                        <button class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Lưu</button>
                        <button class="btn btn-sm btn-default" onclick="closeReplyBox()"><i class="fa fa-times"></i> Đóng</button>
                    </div>

                </form>
                <hr/>
                <div class="row p-3">
                    <div class="col-md-8">
                        <h4>{{$mau->tenmaudon}}</h4>
                    </div>
                    <div class="col-md-4">
                        <div style="font-size: 18px; display: inline-block">#{{$don->id}}</div>
                        <div class="badge badge-light">{{$don->tentrangthai}}</div>
                    </div>
                </div>
            </div>
            <div class="x_content">
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <form method="post" action="{{route('capnhatdonStore', ['don_id' => $don->id])}}" enctype="multipart/form-data" class="form-horizontal"
                      id="formSave" method="post" role="form">
                    {{csrf_field()}}
                    <div class="center-block vku-div-fieldset">
                        <fieldset class="vku-fieldset">
                            <legend>I. Thông tin đăng ký</legend>

                            @foreach($cauhoi as $key => $item)
                                @if($item['static'] == 1)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            <input type="text" autocomplete="off" class="form-control" id="OldRoom"
                                                   name="traloi[{{ $key }}]" placeholder="{{$item['placeholder']}}" value="{{$sinhvien[$item['templete']]}}" readonly>
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 1)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            <input type="text" autocomplete="off" class="form-control" id="OldRoom"
                                                   name="traloi[{{ $key }}]" placeholder="{{$item['placeholder']}}" @if($item['require']) required @endif value="{{$traloi_cauhoi[$key]}}">
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 2)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            @foreach($item['dapan'] as $key2 => $value)
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input id="radio_0" name="traloi[{{$key}}]" type="radio"
                                                           class="custom-control-input" value="{{$key2}}" @if($item['require']) required @endif
                                                           @if($traloi_cauhoi[$key] == $key2) checked @endif>
                                                    <label for="radio_0" class="custom-control-label">{{$value}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 3)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            @foreach($item['dapan'] as $key2 => $value)
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input id="checkbox_2" name="traloi[{{$key}}][]" type="checkbox"
                                                           class="custom-control-input" value="{{$key2}}"

                                                           @if(count($traloi_cauhoi[$key]) > 0)
                                                           @foreach($traloi_cauhoi[$key] as $key3 => $value3)
                                                           @if($value3 == $key2) checked @endif
                                                            @endforeach
                                                            @endif

                                                    >
                                                    <label for="checkbox_2"
                                                           class="custom-control-label">{{$value}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 4)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            <select id="select" name="traloi[{{$key}}]" class="select form-control" @if($item['require']) required @endif>
                                                <option value="null">{{$item['placeholder']}}</option>
                                                @foreach($item['dapan'] as $key2 => $value)
                                                    <option value="{{$key2}}" @if($traloi_cauhoi[$key] == $key2) selected  @endif>{{$value}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @elseif($item['loai'] == 5)
                                    <div class="form-group">
                                        <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"
                                               for="OldRoom">{{$item['cauhoi']}}@if($item['require'])<span
                                                    class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;(*)</span> @endif</label>
                                        <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                            <textarea rows="5" class="form-control" id="RoomMate"
                                                      name="traloi[{{$key}}]"
                                                      placeholder="{{$item['placeholder']}}" @if($item['require']) required @endif>{{$traloi_cauhoi[$key]}}</textarea>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 col-md-2 col-lg-2"></label>
                                <div class="col-xs-12 col-sm-9 col-md-6 col-lg-6">
                                    <p class="text-red">&nbsp;(*) Nội dung bắt buộc</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <fieldset class="vku-fieldset">
                        <legend>II. Hồ sơ giấy tờ minh chứng</legend>
                        <div class="form-group">
                            <div class="table-responsive col-md-12">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">STT</th>
                                        <th class="text-center">Loại giấy tờ</th>
                                        <th class="text-center">Thao tác</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($taptin as $key => $item)
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="text-justify">
                                                <b>{{$item['cauhoi']}}</b>@if($item['require'])<span
                                                        class="text-red" data-toggle="tooltip" data-placement="right" title="Bắt buộc">&nbsp;&nbsp;(*)</span> @endif<br/>
                                                {{$item['mota']}}
                                            </td>
                                            <td class="text-center" style="min-width: 320px">
                                                <div>
                                                    @if($traloi_taptin[$key]) <a href="{{$traloi_taptin[$key]}}" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="Tải xuống"><span class="glyphicon glyphicon-cloud-download"></span></a> @endif
                                                    <a href="#" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="Cập nhật tập tin"><span class="glyphicon glyphicon-cloud-upload"></span></a>
                                                    @if($traloi_taptin[$key]) <a href="#" class="btn btn-sm btn-primary" style="color: #fff" data-toggle="tooltip" data-placement="right" title="Xem nhanh"><span class="glyphicon glyphicon-eye-open"></span></a> @endif
                                                    <br/><a href="#" data-toggle="tooltip" data-placement="right" title="Không cập nhật tập tin nữa">Huỷ cập nhật</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet"/>
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
          rel="stylesheet"/>
@endsection
@section('custom-script')
    <script>
        $("#replybox").hide();
        function showReplyBox(){
            let replyBox = $("#replybox");
            replyBox.show();
        }
        function closeReplyBox(){
            let replyBox = $("#replybox");
            replyBox.hide();
        }
        $("#submit").prop('disabled', true);
        $(document).ready(function (){

        })
    </script>
@endsection
