@extends('layout.sv_layout')
@section('title', 'Sửa thông tin tạm trú')
@section('header')
@endsection
@section('body')
    <form action="{{route('suatamtru.store', ['tamtru_id' => $tamtru->id])}}" method="post">
        {{ csrf_field() }}
        <div class="col-md-12">
            <h6>Thông tin tạm trú</h6>
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
            <div class="form-row">
                <div class="form-group">
                    <div class="col-md-12">
                        <button class="btn btn-primary"><i class="fas fa-plus"></i>Lưu</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
