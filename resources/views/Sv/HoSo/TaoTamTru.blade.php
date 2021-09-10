@extends('layout.sv_layout')
@section('title', 'Khai báo thông tin tạm trú')
@section('header')
@endsection
@section('body')
    <form action="{{route('taotamtru.store')}}" method="post" class="row">
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
                        <input type="date" class="form-control" name="thoigianbatdau"
                               value="{{isset($tamtru) ? $tamtru->thoigianbatdau : ""}}">
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Số nhà</label>
                    <div class="detail-content">
                        <input type="text" class="form-control"   name="sonha"
                               value="{{isset($tamtru) ? $tamtru->sonha : ""}}">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Tỉnh thành</label>
                    <div class="detail-content">
                        <input type="hidden" name="tinhthanh_id" id="tinhthanh_id" value="{{isset($tamtru) ? $tamtru->tinhthanh_id : ""}}"/>
                        <select type="text" class="form-control rounded" name="tinhthanh" id="tinhthanh">
                            <option value="">Mời bạn chọn tỉnh thành</option>
                            @foreach($tinhthanh as $key => $value)
                                <option value="{{$value->id}}" @isset($tamtru) {{($tamtru->tinhthanh_id == $value->id) ? "selected" : ""}} @endisset>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Quận huyện</label>
                    <div class="detail-content">
                        <input type="hidden" name="quanhuyen_id" id="quanhuyen_id" value="{{$tamtru != null ? $tamtru->quanhuyen_id : ""}}">
                        <select type="text" class="form-control rounded" name="quanhuyen" id="quanhuyen">
                            <option value="">Quận huyện</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">xã phường</label>
                    <div class="detail-content">
                        <input type="hidden" name="xaphuong_id" id="xaphuong_id" value="{{isset($tamtru) ? $tamtru->xaphuong_id   : ""}}">
                        <select type="text" class="form-control rounded" name="xaphuong" id="xaphuong">
                            <option value="">Xã phường</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label class=" mb-1" for="inputLocation">Thôn tổ</label>
                    <div class="detail-content">
                        <input type="text" class="form-control rounded" name="thonto"
                               value="{{isset($tamtru) ? $tamtru->thonto : ""}}">
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            Có lỗi xảy ra
                            <ol style="">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            @endif
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
@section('custom-script')
    <script>
        $(document).ready(() => {
            getQuanHuyen({{$tamtru != null ? $tamtru->quanhuyen_id : ""}});
            getXaPhuong({{$tamtru != null ? $tamtru->xaphuong_id : ""}});
            $('#tinhthanh').change(() => {
                $('#tinhthanh_id').val($('#tinhthanh').val());
                getQuanHuyen();
            });
            $('#quanhuyen').change(() => {
                $('#quanhuyen_id').val($('#quanhuyen').val());
                getXaPhuong();
            });
            $('#xaphuong').change(() => {
                $('#xaphuong_id').val($('#xaphuong').val());
            });
        });
        function getXaPhuong(macdinh = null){
            $.ajax({
                url: '{{route('sv.tamtru.getxaphuong')}}',
                type: 'get',
                dataType: 'json',
                data: {
                    quanhuyen_id: $('#quanhuyen_id').val()
                }
            }).done(function(ketqua) {
                console.log(ketqua);
                let xaphuong = $('#xaphuong');
                xaphuong.empty();
                let option = document.createElement('option');
                option.innerHTML = "Mời bạn chọn xã phường";
                xaphuong.append(option);
                for(let i = 0; i < ketqua.length; i++){
                    let option = document.createElement('option');
                    option.value = ketqua[i].id;
                    if(ketqua[i].id == macdinh){
                        option.setAttribute('selected', true)
                    }
                    option.innerHTML = ketqua[i].name;
                    xaphuong.append(option);
                }
            });
        }

        /**
         * @param tinhthanh Tỉnh thành được chọn
         * @param macdinh mặc định được của bản ghi tạm trú
         */
        function getQuanHuyen(macdinh = null){
            $.ajax({
                url: '{{route('sv.tamtru.getquanhuyen')}}',
                type: 'get',
                dataType: 'json',
                data: {
                    tinhthanh_id: $('#tinhthanh').val()
                }
            }).done(function(ketqua) {
                let quanhuyen = $('#quanhuyen');
                quanhuyen.empty();
                let option = document.createElement('option');
                option.innerHTML = "Mời bạn chọn quận huyện";
                quanhuyen.append(option);
                for(let i = 0; i < ketqua.length; i++){
                    let option = document.createElement('option');
                    option.value = ketqua[i].id;
                    option.innerHTML = ketqua[i].name;
                    if(ketqua[i].id == macdinh){
                        option.setAttribute('selected', true)
                    }
                    quanhuyen.append(option);
                }
            });
        }
    </script>
@endsection
