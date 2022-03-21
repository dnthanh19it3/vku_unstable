@extends('layout.sv_layout')
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
    <div class="col-12">
        <div class="x_panel">
            <div class="x_title">
                <h4 style="float: left"> <i class="fa fa-file"></i> Thủ tục {{$mau->tenmaudon}}</h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="alert alert-success" style="color: rgb(38 185 154); font-size: 14px">
                    <div class="ml-3">
                        <div>
                            <div style="margin-bottom: 0"><i class="fa fa-clock-o mr-1"></i>Thời gian xử
                                lý:&nbsp;{{$mau->thoigianxuly}}&nbsp;ngày
                            </div>
                        </div>
                        <div>
                            <div style="margin-bottom: 0"><i class="fa fa-calendar mr-1"></i>Dự kiến thời gian:&nbsp;{{\Illuminate\Support\Carbon::now()->format('d-m-Y')." đến " . \Illuminate\Support\Carbon::now()->addDays($mau->thoigianxuly)->format('d-m-Y')}}
                            </div>
                        </div>
                    </div>
                </div>
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
                <hr/>

                <form method="post" action="{{route('nopdon.Store', ['donid' => $mau->id])}}" enctype="multipart/form-data" class="form-horizontal"
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
                                                   name="traloi[{{ $key }}]" placeholder="{{$item['placeholder']}}" @if($item['require']) required @endif>
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
                                                           class="custom-control-input" value="{{$key2}}" @if($item['require']) required @endif>
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
                                                           class="custom-control-input" value="{{$key2}}">
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
                                                    <option value="{{$key2}}">{{$value}}</option>
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
                                                      placeholder="{{$item['placeholder']}}" @if($item['require']) required @endif></textarea>
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
                            <div class="table-responsive col-md-8">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center" style="width:5%">STT</th>
                                        <th class="text-center">Loại giấy tờ</th>
                                        <th class="text-center">Tải lên</th>
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
                                                <input id="taptin{{$key}}" name="taptin[{{$key}}]" placeholder=""
                                                       type="file" class="filepond"  @if($item['require']) required @endif>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="vku-fieldset">
                        <legend>III. Phụ lục</legend>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                {!! $mau->mota !!}
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="vku-fieldset">
                        <legend>IV. Xác nhận nộp đơn</legend>
                        <style>
                            .col-centered{
                                float: none;
                                margin: 0 auto;
                            }
                        </style>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-centered">
                                <p><input type="checkbox" id="camket" style="margin-right: 8px"/>Tôi cam kết những thông tin khai báo ở trên là đúng. Tôi xin chịu mọi trách nhiệm nếu khai báo thông tin không chính xác</p>
                                <button type="submit" id="submit" class="btn btn-primary" disabled="disabled">
                                    <i class="glyphicon glyphicon-ok"></i>
                                    Nộp đơn
                                </button>
                                <button type="reset"  class="btn btn-default">Viết lại</button>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3 col-xs-10 col-sm-8 col-md-8 col-lg-8">

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
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>--}}
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
    <script>
        // Register the plugin
        $.fn.filepond.registerPlugin(FilePondPluginFileValidateSize);
        $.fn.filepond.registerPlugin(FilePondPluginFileValidateType);
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
        // Turn input element into a pond
        $('.filepond').filepond();
        $.fn.filepond.setDefaults({
            maxFileSize: '10MB',
            acceptedFileTypes: [
                'image/png',
                'image/jpg',
                'image/jpeg',
                "application/pdf",
                "application/msword",
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
            ],
            storeAsFile: true,
            allowImagePreview: true
        });
    </script>
    <script>
        $("#submit").prop('disabled', true);
        $(document).ready(function (){
            $("#camket").click(function (){
                var flag = $("#camket").prop("checked")
                console.log(flag)
                if(flag){
                    $("#submit").removeAttr('disabled');
                } else {
                    $("#submit").prop('disabled', true)
                }
            })
        })
    </script>
@endsection
