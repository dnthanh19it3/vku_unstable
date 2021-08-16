@extends('layout.sv_layout')
@section('body')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thông tin đơn</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" href="#">Settings 1</a>
                            </li>
                            <li><a class="dropdown-item" href="#">Settings 2</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                <form method="post" action="{{route('capnhatdonStore', ['don_id' => $don->don_id])}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-12">
                            <h5>Thông tin cơ bản</h5>
                        </div>
                        @isset($don->ghichu)
                            <div class="col-12">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Lưu ý</strong> {{$don->ghichu}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endisset
                    </div>
                    <div class="form-group row">
                        @foreach ($truong as $item)

                            @if ($item->input_type == 'file')
                                @php
                                    $flag = 1;
                                @endphp
                            @elseif ($item->input_type == 'text')
                                <div class="col-md-4 mb-2">
                                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                    <input id="tenmaudon" name="tentruong[{{ $item->truong_id }}]" placeholder=""
                                           type="text" class="form-control" value="{{ $item->noidung}}" required="required">
                                </div>
                            @elseif ($item->input_type == 'datetime')
                                <div class="col-md-4 mb-2">
                                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                    <input id="tenmaudon" name="tentruong[{{ $item->truong_id }}]" placeholder=""
                                           type="date" class="form-control" value="{{ $item->noidung}}" required="required">
                                </div>
                            @elseif ($item->input_type == 'number')
                                <div class="col-md-4 mb-2">
                                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                    <input id="tenmaudon" name="tentruong[{{ $item->truong_id }}]" placeholder=""
                                           type="number" class="form-control" value="{{ $item->noidung}}" required="required">
                                </div>
                            @elseif ($item->input_type == 'textarea')
                                <div class="col-md-4 mb-2">
                                    <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                    <textarea id="tenmaudon" name="tentruong[{{ $item->truong_id }}]" placeholder=""
                                              class="form-control" value="{{ $item->noidung}}" required="required"></textarea>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- THÔNG TIN ĐÍNH KÈM -->
                    @isset($flag)
                        <div class="form-group row">
                            <div class="col-12">
                                <h5>Đính kèm</h5>
                            </div>
                        </div>
                        @foreach ($truong as  $item)
                            @if ($item->input_type == 'file')
                                <div class="form-group row">
                                    <div id="capnhat-{{$item->truong_id}}" class="col-md-12 mb-2">
                                        <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                        <input id="tenmaudon" name="tentruong[{{ $item->truong_id }}]" placeholder=""
                                               type="file" class="form-control">
                                    </div>
                                    <div id="xemlaidiv-{{$item->truong_id}}" class="col-md-12 mb-2">
                                        <label for="tenmaudon" class="mb-1">{{ $item->tentruong }}</label>
                                        <hr/>
                                        <a class="btn btn-primary btn-sm" href="{{ asset('storage/'.$item->noidung)}}">Xem lại</a>
                                        <a class="btn btn-primary btn-sm" id="xemlaibtn-{{$item->truong_id}}" href="javascript:void(0)" \>Cập nhật</a>
                                    </div>
                                </div>
                                <script>
                                    $('#capnhat-{{$item->truong_id}}').hide();
                                    $(document).ready(function(){
                                        $('#xemlaibtn-{{$item->truong_id}}').click(function(){
                                            $('#capnhat-{{$item->truong_id}}').show();
                                            $('#xemlaidiv-{{$item->truong_id}}').hide();
                                        })
                                    })
                                </script>
                        @endif
                    @endforeach
                @endisset
                <!-- SUMIT -->
                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-block btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
