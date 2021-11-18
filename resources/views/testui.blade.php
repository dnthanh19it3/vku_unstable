@extends('layout.sv_layout')
@section('body')
    <div class="row">
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
                <h5 class="p-0">Trình độ lý luận CT/ Ngoại ngữ - Tin học - Quản lý NN - Quản lý GD</h5>
                <hr/>
            </div>
            <div class="body">
                <div class="row pt-3">
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ lý luận chính
                                trị:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][trinhdochinhtri_id]"
                                        class="UserTrinhdochinhtriId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    @foreach($dm['trinhdochinhtri'] as $item)<option value="{{$item->key}}">{{$item->trinhdochinhtri}}</option>@endforeach<br/>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Ngoại ngữ thành thạo
                                nhất:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][ngoaingu_id]"
                                        class="UserNgoainguId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    @foreach($dm['trinhdongoaingu'] as $item)<option value="{{$item->key}}">{{$item->trinhdongoaingu}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ
                                khác:</label>
                            <div class="col-lg-9">
                                <div class="SumoSelect sumo_trinhdongoaingukhac" tabindex="0" role="button"
                                     aria-expanded="false"><select name="trinhdongoaingukhac[]"
                                                                   class="UserTrinhdongoaingukhac form-control custom-select rounded SumoUnder"
                                                                   multiple="" tabindex="-1">
                                        @foreach($dm['trinhdongoaingukhac'] as $item)<option value="{{$item->key}}">{{$item->trinhdongoaingukhac}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][trinhdongoaingu_id]"
                                        class="UserTrinhdotinhocId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    @foreach($dm['trinhdongoaingu'] as $item)<option value="{{$item->key}}">{{$item->trinhdongoaingu}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Mô tả trình độ ngoại
                                ngữ:</label>
                            <div class="col-lg-9">
                                <textarea class="form-control" rows="5"
                                          name="data[trinhdolyluan][motatrinhdongoaingu]"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class="group2 col-md-6">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ tin học:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][trinhdotinhoc_id]"
                                        class="UserTrinhdotinhocId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    @foreach($dm['trinhdotinhoc'] as $item)<option value="{{$item->key}}">{{$item->trinhdotinhoc}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ quản lý nhà
                                nước:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][trinhdoqlnhanuoc_id]"
                                        class="UserDanhhieuId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    @foreach($dm['trinhdoqlnhanuoc'] as $item)<option value="{{$item->key}}">{{$item->trinhdoqlnhanuoc}}</option>@endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ quản lý giáo
                                dục:</label>
                            <div class="col-lg-9">
                                <select name="data[trinhdolyluan][trinhdoqlgiaoduc_id]"
                                        class="UserTrinhdochinhtriId form-control custom-select rounded">
                                    <option value="">Chọn</option>
                                    <option value="3">CBQL các Khoa, Phòng, Ban trường ĐH</option>
                                    <option value="7">CBQL các trường Mầm non</option>
                                    <option value="8">CBQL các trường PTDT nội trú</option>
                                    <option value="6">CBQL các trường TH và THCS</option>
                                    <option value="5">CBQL các trường THPT</option>
                                    <option value="1">Chứng chỉ Nghiệp vụ sư phạm</option>
                                    <option value="4">Chứng chỉ Quản lý giáo dục</option>
                                    <option value="2">Chứng chỉ Triết học sau Đại học</option>
                                    <option value="11">Cử nhân QLGD</option>
                                    <option value="9">Nữ CBQL trường ĐH, CĐ</option>
                                    <option value="10">Thạc sỹ QLGD</option>
                                    <option value="12">Tiến sỹ QLGD</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        $(function() {
            console.log("DatePicker");
            $("#ngaysinh").datepicker({
                changeMonth: true,
                changeYear: true
            });
            console.log("DatePickerOK");
        });

    </script>
@endsection