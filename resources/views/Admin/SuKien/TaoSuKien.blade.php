@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h5>Danh sách</h5>
                <hr/>
                <form>
                    <div class="form-group row">
                        <label for="tensukien" class="col-4 col-form-label">Tên sự kiện</label>
                        <div class="col-8">
                            <input id="tensukien" name="tensukien" placeholder="Tên sự kiện" type="text" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thoigian" class="col-4 col-form-label">Thời gian diễn ra</label>
                        <div class="col-8">
                            <input id="thoigian" name="thoigian" type="datetime-local" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4">Đối tượng tham gia</label>
                        <div class="col-8">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="doituong" id="doituong_0" type="radio" class="custom-control-input" value="tatca">
                                <label for="doituong_0" class="custom-control-label">Tất cả sinh viên của lớp</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="doituong" id="doituong_1" type="radio" class="custom-control-input" value="lop">
                                <label for="doituong_1" class="custom-control-label">Lớp chỉ định</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="doituong" id="doituong_2" type="radio" class="custom-control-input" value="phong">
                                <label for="doituong_2" class="custom-control-label">Phòng CTSV chỉ định</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5 class="mb-3">Thành phần tham dự</h5>
                <hr/>
                <ul style="list-style: none; padding-left: 16px">
                    @foreach($khoa as $key => $khoa_don)
                        <li>
                            <h6><input type="checkbox" id=""> {{$khoa_don->khoaK}}</h6>
                            <ul style="padding-left: 16px">
                                @foreach($khoa_don->lopsh as $lopsh)
                                    <li style="display: inline-block; width: 48%">
                                        <input type="checkbox" id="" value="{{$lopsh->id}}" khoa="{{$khoa_don->khoaK}}" name="khoa">
                                        {{$lopsh->tenlop}}
                                    </li>
                                @endforeach
                            </ul>
                            <hr/>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection