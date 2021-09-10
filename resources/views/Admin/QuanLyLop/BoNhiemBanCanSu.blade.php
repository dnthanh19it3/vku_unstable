@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="bg-white p-3">
                <h5 class="mb-3">Danh mục</h5>
                <hr/>
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{route('admin.quanlylop.chitietlop', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Danh sách lớp </a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.khenthuongkyluat', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Khen thưởng kỷ luật</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.diemrenluyen', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Kết quả rèn luyện</a>
                        </li>
                        <li>
                            <a href="{{route('admin.quanlylop.bancansu', ['lop_id' => $lop_id])}}">
                                <i class="glyphicon glyphicon-user"></i>
                                Ban cán sự</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="bg-white p-3">
                <h5>Danh sách</h5>
                <hr/>
                <form method="post" action="{{route('admin.quanlylop.bonhiembancansu.store', ['lop_id' => $lop_id])}}">
                    {{csrf_field()}}
                    @foreach($chucvu as $key_chucvu => $item_chucvu)
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">{{$item_chucvu->chucvu}}</label>
                            <div class="col-8">
                                <select name="{{$item_chucvu->id}}" class="custom-select">
                                    <option readonly="readonly">Vui lòng chọn</option>
                                    @foreach($bancansu as $key_bcs => $item_bcs)
                                        @if($item_bcs->chucvu_id == $item_chucvu->id)
                                            <option value="{{$item_bcs->masv}}" selected readonly="readonly">{{$item_bcs->hodem ." ". $item_bcs->ten}}</option>
                                        @else
                                            <option value="{{$item_bcs->masv}}">{{$item_bcs->hodem ." ". $item_bcs->ten}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group row">
                        <div class="offset-4 col-8">
                            <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection