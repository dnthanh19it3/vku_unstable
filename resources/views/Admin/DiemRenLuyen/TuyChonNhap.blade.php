@extends('layout.admin_layout')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">Tổng hợp điểm rèn luyện</div>
        <div class="card-body">
                <form class="form" class="row" action="{{route('admin.danhgiarenluyen.commit')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label for="hocky" class="col-5 col-form-label">Học kỳ cần nhập</label>
                        <div class="col-7">
                            <select id="hocky" name="hocky" class="custom-select">
                                <option value="all">Tất cả</option>
                                @forelse($array_hocky as $item)
                                    <option value="{{$item['key']}}">{{$item['text']}}</option>
                                @empty
                                    Không có lựa chọn hợp lệ
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-5">Cập nhật bản ghi (nếu có)</label>
                        <div class="col-7">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="capnhat" id="capnhat_0" type="radio" class="custom-control-input" value="1" required="required">
                                <label for="capnhat_0" class="custom-control-label">Cập nhật</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input name="capnhat" id="capnhat_1" type="radio" class="custom-control-input" value="0" required="required">
                                <label for="capnhat_1" class="custom-control-label">Bỏ qua</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-5">Chọn lớp</label>
                        <div class="col-7">
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input name="lop[]" id="id999"  type="checkbox" class="custom-control-input" value="all">
                                <label for="id999" class="custom-control-label">Tất cả</label>
                            </div>
                            @forelse($array_lop as $key => $item)
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input name="lop[]" id="id{{$key}}" type="checkbox" class="custom-control-input" value="{{$item}}">
                                <label for="id{{$key}}" class="custom-control-label">{{$item}}</label>
                            </div>
                            @empty
                                Không có tuỳ chọn hợp lệ
                            @endforelse
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-5 col-7">
                            Tổng số bản ghi trong file: {{sizeof(session('excel_data'))}}.
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-5 col-7">
                            <button name="submit" type="submit" class="btn btn-primary">Xác nhận</button>
                        </div>
                    </div>
                </form>
        </div>
    </div>
@endsection
