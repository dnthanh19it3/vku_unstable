@extends('layout.admin_layout')
@section('body')
    <div class="card">
        <div class="card-header border-bottom">Tổng hợp điểm rèn luyện</div>
        <div class="card-body">
                <form class="form" class="row" action="{{route('admin.danhgiarenluyen.commit')}}" method="post">
                    {{ csrf_field() }}
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
