@extends('layout/sv_layout')
@section('title', 'Danh sách hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
{{--        <div class="col-md-4">--}}
{{--            <div class="x_panel">--}}
{{--                <div class="x_title">--}}
{{--                    <h6 style="float: left">Ảnh đại diện</h6>--}}
{{--                    <div class="clearfix"></div>--}}
{{--                </div>--}}
{{--                <div class="x_content">--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h6 style="float: left">Thông tin chi tiết</h6>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form method="post" action="{{route('taocvStore')}}">
                    {{ csrf_field() }}
                    <!-- Form Row-->
                        <h5>Mạng xã hội</h5>
                        <div class="form-row">
                            <!-- Form Group (first name)-->
                            <div class="form-group col-md-3">
                                <label class="mb-1" for="inputFirstName">facebook</label>
                                <input class="form-control" id="inputFirstName" type="text"
                                       name="facebook">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="form-group col-md-3">
                                <label class="mb-1" for="inputLastName">Instagram</label>
                                <input class="form-control" id="inputLastName" type="text"
                                       name="instagram">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="mb-1" for="inputFirstName">Github</label>
                                <input class="form-control" name="github" type="text"
                                >
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="form-group col-md-3">
                                <label class="mb-1" for="inputLastName">Linkedin</label>
                                <input class="form-control" id="inputLastName" type="text"
                                       name="linkedin">
                            </div>
                        </div>
                        <hr/>
                        <h5>Liên lạc</h5>
                        <div class="form-row">
                            <!-- Form Group (organization name)-->
                            <div class="form-group col-md-4">
                                <label class="mb-1" for="inputOrgName">Địa chỉ</label>
                                <input class="form-control" id="inputOrgName" type="text"
                                       name="diachi_cv">
                            </div>
                            <!-- Form Group (location)-->
                            <div class="form-group col-md-4">
                                <label class="mb-1" for="inputLocation">Điện thoại</label>
                                <input class="form-control" id="inputLocation" type="text" name="dienthoai_cv">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="mb-1" for="inputLocation">Email</label>
                                <input class="form-control" id="inputLocation" type="text" name="email_cv">
                            </div>
                        </div>
                        <!-- Kĩ năng-->
                        <hr/>
                        <div class="form-row">
                            <div class="col-md-4">
                                <h5>Kĩ năng</h5>
                            </div>
                            <div class="col-md-8 d-flex flex-row-reverse">
                                <button class="btn btn-sm btn-primary" id="btnkinang" type="button">Thêm kĩ năng</button>
                            </div>
                        </div>
                        <div id="formkinangcha">
                            <div class="form-row" data-name="formkinang">
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-8">
                                    <label class="mb-1" for="inputPhone">Kĩ năngr</label>
                                    <input class="form-control" type="text" name="loaikinang[]">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="form-group col-md-4">
                                    <label class="mb-1" for="inputBirthday">Đánh giá</label>
                                    <input type="range" class="custom-range p-4" name="danhgia[]">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-row">
                            <div class="col-md-4">
                                <h5>Ngoại ngữ</h5>
                            </div>
                            <div class="col-md-8 d-flex flex-row-reverse">
                                <button id="btn_ngonngu" class="btn btn-sm btn-primary" type="button">Thêm ngôn ngữ</button>
                            </div>
                        </div>
                        <div id="form_ngonngu_cha">
                            <div class="form-row" data-name="form_ngonngu_con">
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-8">
                                    <label class="mb-1" for="inputPhone">Ngôn ngữ</label>
                                    <input class="form-control"  type="text" name="ngonngu[]">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="form-group col-md-4">
                                    <label class="mb-1" for="inputBirthday">Trình độ</label>
                                    <input class="form-control"  type="text" name="trinhdo[]">
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="form-row">
                            <div class="col-md-4">
                                <h5>Kinh nghiệm</h5>
                            </div>
                            <div class="col-md-8 d-flex flex-row-reverse">
                                <button type="button" id="btn_kinhnghiem" class="btn btn-sm btn-primary"> Thêm kinh nghiệm</button>
                            </div>
                        </div>
                        <div id="form_kinhnghiem_cha">
                            <div class="form-row" data-name="form_kinhnghiem_con">
                                <!-- Form Group (phone number)-->
                                <div class="form-group col-md-8">
                                    <label class="mb-1" for="inputPhone">Kinh nghiệm</label>
                                    <input class="form-control"  type="text" name="kinhnghiem[]">
                                </div>
                                <!-- Form Group (birthday)-->
                                <div class="form-group col-md-2">
                                    <label class="mb-1" for="inputBirthday">Từ</label>
                                    <input class="form-control" type="date" name="batdau[]">
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="mb-1" for="inputBirthday">Đến</label>
                                    <input class="form-control"  type="date" name="ketthuc[]">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <!-- Form Group (phone number)-->
                            <div class="form-group col-md-12">
                                <label class="mb-1" for="inputPhone">Mô tả công việc</label>
                                <textarea class="form-control" style="width:100%;height: 200px;" name="mota[]"></textarea>
                            </div>
                        </div>
                        <hr/>
                        <h5>Giới thiệu về bản thân</h5>
                        <div class="form-row">
                            <!-- Form Group (phone number)-->
                            <div class="form-group col-md-12">
                                <label class="mb-1" for="inputPhone">Giới thiệu</label>
                                <textarea class="form-control" style="width:100%;height: 200px;" name="gioithieu"></textarea>
                            </div>
                        </div>

                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit">Tạo CV</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section("custom-script")
    <script>
        $(document).ready(function(){
            var formcon = $("[data-name=formkinang]");
            var form_ngonngu_con = $("[data-name=form_ngonngu_con]");
            var form_kinhnghiem_con = $("[data-name=form_kinhnghiem_con]");



            $('#btnkinang').click(function(){
                formcon.clone().appendTo($('#formkinangcha'));
            })
            $('#btn_ngonngu').click(function(){
                form_ngonngu_con.clone().appendTo($('#form_ngonngu_cha'));
            })
            $('#btn_kinhnghiem').click(function(){
                form_kinhnghiem_con.clone().appendTo($('#form_kinhnghiem_cha'));
            })
        })
    </script>
@endsection
