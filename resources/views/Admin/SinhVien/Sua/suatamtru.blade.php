@extends('layout.admin_layout')
@section('body')
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            @if($errors->any())
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
            <div class="tab-content" style="height: 100%">
                <div class="tab-pane active" id="canhan">
                    <div class="profile_main_block p-4 bg-white">
                        <h4 style="display: flex; flex-direction: row; align-items: center"><img src="{{$sinhvien_static->anhthe}}" class="avatar mr-2" style="border-radius: 99px"/> Sửa tạm trú #{{ $tamtru->id}} - {{$sinhvien_static->hodem . " " . $sinhvien_static->ten . " (" . $sinhvien_static->masv . ")" }}</h4>
                        <hr/>
                        <form action="{{route('ad.suasinhvien.suatamtrupost', ['masv' => $sinhvien_static->masv, 'id' => $tamtru->id])}}" method="post" class="row">
                            {{ csrf_field() }}
                            <div class="col-md-12 bg-white p-3">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Tên chủ hộ</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control rounded"   name="tenchuho"
                                                   value="{{isset($tamtru) ? $tamtru->tenchuho : ""}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">SĐT Chủ hộ</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control rounded"   name="sdtchuho"
                                                   value="{{isset($tamtru) ? $tamtru->sdtchuho : ""}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Thời gian tạm trú</label>
                                        <div class="detail-content">
                                            <input type="date" class="form-control rounded" name="thoigianbatdau"
                                                   value="{{isset($tamtru) ? $tamtru->thoigianbatdau : ""}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Số nhà</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control rounded"   name="sonha"
                                                   value="{{isset($tamtru) ? $tamtru->sonha : ""}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Tỉnh thành</label>
                                        <div class="detail-content">
                                            <input type="hidden" name="tinhthanh_id" id="tinhthanh_id" value="{{isset($tamtru) ? $tamtru->tinhthanh_id : ""}}"/>
                                            <select type="text" class="form-control rounded" name="tinhthanh" id="tinhthanh" required>
                                                <option value="">Mời bạn chọn tỉnh thành</option>
                                                @foreach($tinhthanh as $key => $value)
                                                    <option value="{{$value->id}}" @if($tamtru != null) {{($tamtru->tinhthanh_id == $value->id) ? "selected" : ""}} @else {{($value->id == 32) ? "selected" : ""}} @endif>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Quận huyện</label>
                                        <div class="detail-content">
                                            <input type="hidden" name="quanhuyen_id" id="quanhuyen_id" value="{{$tamtru != null ? $tamtru->quanhuyen_id : ""}}" required>
                                            <select type="text" class="form-control rounded" name="quanhuyen" id="quanhuyen" required>
                                                <option value="">Quận huyện</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">xã phường</label>
                                        <div class="detail-content">
                                            <input type="hidden" name="xaphuong_id" id="xaphuong_id" value="{{isset($tamtru) ? $tamtru->xaphuong_id   : ""}}">
                                            <select type="text" class="form-control rounded" name="xaphuong" id="xaphuong" required>
                                                <option value="">Xã phường</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Thôn tổ</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control rounded" name="thonto"
                                                   value="{{isset($tamtru) ? $tamtru->thonto : ""}}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Năm học - học kỳ</label>
                                        <div class="detail-content">
                                            <select name="namhoc_hocky" class="form-control rounded" required>
                                                <option>Chọn học kỳ</option>
                                                @forelse($hocky_info as $key_hk => $item_hk)
                                                    <option value="{{$item_hk->id."|".$item_hk->hocky}}" @if($tamtru->namhoc_hocky == $item_hk->id."|".$item_hk->hocky) selected @endif>Năm học {{$item_hk->nambatdau ."-". $item_hk->namketthuc}} HK {{$item_hk->hocky}}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class=" mb-1" for="inputLocation">Hiện hành</label>
                                        <div class="detail-content">
                                            <select name="hienhanh" class="form-control rounded">
                                                <option @if($tamtru->hienhanh == 1) selected @endif value="1">Có</option>
                                                <option @if($tamtru->hienhanh == 0) selected @endif value="0">Không</option>
                                            </select>
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
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="margin-left: 12px; margin-bottom: 16px">
                                        * Bản khai báo bạn tạo sẽ áp dụng cho học kì hiện tại<br>
                                        ** Nếu không có bất kì thay đổi, ấn vào "Lấy địa chỉ cũ" để lấy lại thông tin lần khai báo gần nhất, sau đó kiểm tra lại thông tin và xác nhận.
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;Lưu</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <style>
                #leftmenu > li.active > a {
                    border-left: 2px solid #5b9bd1;
                    border-radius: unset;
                    background: #f6f9fb !important;
                    color: #5b9bd1 !important;
                }
                .equal {
                    display: flex;
                    display: -webkit-flex;
                    flex-wrap: wrap;
                }
                @media (min-width: 768px) {
                    .row.equal {
                        display: flex;
                        flex-wrap: wrap;
                    }
                }
                .margin-bottom-3px {
                    margin-bottom: 3px;
                }
                .profile_main_block {
                    background: #fff;
                    padding: 2rem;
                    margin-bottom: 1rem;
                }
                .title-text {
                    font-weight: 500;
                    font-size: 16px;
                    margin-bottom: 3px;
                }
                .rounded {
                    border-radius: 4px;
                }
                .mr-2 {
                    margin-right: 8px;
                }
            </style>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(() => {
            getQuanHuyen({{$tamtru != null ? $tamtru->quanhuyen_id : ""}});
            getXaPhuong({{$tamtru != null ? $tamtru->xaphuong_id : ""}});

            $('#tinhthanh_id').val($('#tinhthanh').val());
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
                url: '{{route('ctsv.tamtru.getxaphuong')}}',
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
                url: '{{route('ctsv.tamtru.getquanhuyen')}}',
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