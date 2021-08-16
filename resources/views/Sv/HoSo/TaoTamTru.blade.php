@extends('layout.sv_layout')
@section('title', 'Khai báo thông tin tạm trú')
@section('header')
@endsection
@section('body')
    <form action="{{route('taotamtru.store')}}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12">
            <h6>Nhập thông tin</h6>
            <hr/>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Tên chủ hộ</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="tenchuho"
                               value="{{isset($tamtru) ? $tamtru->tenchuho : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">SĐT Chủ hộ</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="sdtchuho"
                               value="{{isset($tamtru) ? $tamtru->sdtchuho : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Thời gian tạm trú</label>
                    <div class="detail-content">
                        <input type="date" class="form-control" name="thoigian"
                               value="{{isset($tamtru) ? $tamtru->thoigian : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Số nhà</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="so_nha"
                               value="{{isset($tamtru) ? $tamtru->so_nha : ""}}">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Thôn tổ</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="thon_to"
                               value="{{isset($tamtru) ? $tamtru->thon_to : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">xã phường</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="xa_phuong"
                               value="{{isset($tamtru) ? $tamtru->xa_phuong : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Quận huyện</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="quan_huyen"
                               value="{{isset($tamtru) ? $tamtru->quan_huyen : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Tỉnh thành</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="tinh_thanh"
                               value="{{isset($tamtru) ? $tamtru->tinh_thanh : ""}}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                * Bản khai báo bạn tạo sẽ áp dụng cho học kì hiện tại<br>
                ** Nếu không có bất kì thay đổi, ấn vào "Lấy địa chỉ cũ" để lấy lại thông tin lần khai báo gần nhất, sau đó kiểm tra lại thông tin và xác nhận.
            </div>
            <hr>
            <div class="form-row">
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;Lưu</button>
                        <a href="{{route('taotamtru', ['tamtru_id' => $tamtrukey])}}" class="btn btn-primary"><i class="fas fa-clock">&nbsp;</i>Lấy địa chỉ cũ</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
