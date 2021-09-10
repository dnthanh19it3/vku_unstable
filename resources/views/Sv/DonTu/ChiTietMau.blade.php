@extends('layout.sv_layout')
@section('body')
    <div class="col-12">
        <div class="x_panel">
            <div class="x_title">
                <h5 style="float: left">Thủ tục {{$don->tenmaudon}}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div>
                    <h6>Hướng dẫn về thủ tục <span>{{ lcfirst($don->tenmaudon)}}</span></h6>
                    <div class="ml-3">
                        {!! $don->mota !!}
                        <div><div style="margin-bottom: 0"><i class="fas fa-clock mr-1"></i>Thời gian xử lý:&nbsp;{{$don->thoigianxuly}}&nbsp;ngày</div></div>
                        <div><div style="margin-bottom: 0"><i class="fas fa-calendar-alt mr-1"></i>Dự kiến thời gian:&nbsp;{{\Illuminate\Support\Carbon::now()->format('d-m-Y')." đến " . \Illuminate\Support\Carbon::now()->addDays($don->thoigianxuly)->format('d-m-Y')}}</div></div>
                    </div>
                </div>
                <hr/>
                <form method="post" action="{{route('nopdon.Store', ['donid' => $maudon_id])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h6>Nhập thông tin</h6>
                    <div class="form-group row ml-3">
                            @foreach ($truong as $item)
                                @if ($item->input_type == 'file')
                                    @php
                                        $flag = 1;
                                    @endphp
                                @elseif ($item->input_type == 'text')
                                    <div class="col-md-4 mb-2">
                                        <div class="mb-1" style="font-size: 16px">{{ $item->tentruong }}</div>
                                        <input id="tenmaudon" name="field{{ $item->id }}" placeholder=""
                                               type="text" class="form-control rounded" required="required"
                                                value="{{$item->lienket != null ? $sinhvien[$item->lienket]:""}}" @isset($item->lienket) disabled @endisset>
                                        @isset($item->ghichutruong)
                                            <div class="mb-1">{{ $item->ghichutruong}}</div>
                                        @endisset
                                    </div>
                                @elseif ($item->input_type == 'datetime')
                                    <div class="col-md-4 mb-2">
                                        <div class="mb-1" style="font-size: 16px">{{ $item->tentruong }}</div>
                                        <input id="tenmaudon" name="field{{ $item->id }}" placeholder=""
                                               type="date" class="form-control rounded" value="{{$item->lienket != null ? $sinhvien[$item->lienket] : ""}}" @isset($item->lienket) disabled @endisset>
                                        @isset($item->ghichutruong)
                                            <div class="mb-1">{{ $item->ghichutruong}}</div>
                                        @endisset
                                    </div>
                                @elseif ($item->input_type == 'number')
                                    <div class="col-md-4 mb-2">
                                        <div class="mb-1" style="font-size: 16px">{{ $item->tentruong }}</div>
                                        <input id="tenmaudon" name="field{{ $item->id }}" placeholder=""
                                               type="number" class="form-control rounded" required="required" value="{{$item->lienket != null ? $sinhvien[$item->lienket]:""}}" @isset($item->lienket) disabled @endisset>
                                        @isset($item->ghichutruong)
                                            <div class="mb-1">{{ $item->ghichutruong}}</div>
                                        @endisset
                                    </div>
                                @elseif ($item->input_type == 'textarea')
                                    <div class="col-md-4 mb-2">
                                        <div class="mb-1" style="font-size: 16px">{{ $item->tentruong }}</div>
                                        <textarea id="tenmaudon" name="field{{ $item->id }}" placeholder=""
                                                  class="form-control rounded" required="required">value="{{$item->lienket != null ? $sinhvien[$item->lienket]:""}}" @isset($item->lienket) disabled @endisset</textarea>
                                        @isset($item->ghichutruong)
                                            <div class="mb-1">{{ $item->ghichutruong}}</div>
                                        @endisset
                                    </div>
                                @endif
                            @endforeach
                        <hr/>
                    </div>
                    <!-- THÔNG TIN ĐÍNH KÈM -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @isset($flag)
                        <div>
                                <h6>Giấy tờ kèm theo</h6>
                        </div>
                        <div class="ml-3">
                            @foreach ($truong as $item)
                                @if ($item->input_type == 'file')
                                    <div class="form-group row">
                                        <div class="col-md-12 mb-2">
                                            <div class="mb-1" style="font-size: 16px">{{ $item->tentruong }}@isset($item->ghichutruong)
                                                    ({{ $item->ghichutruong}})
                                                @endisset</div>
                                            <input id="field{{ $item->id }}" name="field{{ $item->id }}" placeholder=""
                                                   type="file" class="filepond" required="required">

                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endisset
                <!-- SUMIT -->
                    <h6>Cam kết</h6>
                        <div class="ml-3 mb-3">
                            <div class="mb-3">Bằng việc gửi mẫu đơn này đi, Bạn sẽ phải chịu trách nhiệm trước những thông tin bạn bạn khai báo ở biểu mẫu trên</div>
                            <div class="ml-3"><input type="checkbox" id="camket"> Tôi đã đọc và cam kết về những thông tin gửi đi</div>
                        </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <button id="submit" type="submit" class="btn btn-block btn-primary">Nộp</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
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
