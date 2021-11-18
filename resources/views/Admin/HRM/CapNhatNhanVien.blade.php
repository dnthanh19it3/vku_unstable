@extends('layout.admin_layout')
@section('body')

    <form method="post" action="{{route('ad.hrm.nhanvien.sua.post')}}" class="row">
        {{ csrf_field() }}
        <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
            <div class="title">
               <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-2"></i>Lưu</button>
            </div>
        </div>
        <!-- Thông tin cá nhân -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin cá nhân</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="col-xl-2">
                            <label class="btn fileinput-button img-thumbnail form-group" style="width: 100%;">
                                <div class="anh">
                                    <div id="imagePreview">
                                        <img id="anhdaidien" src="/img/no-user-image.gif" style="width: 100%;">
                                    </div>
                                </div>
                                <i class="glyphicon glyphicon-plus"></i>
                                <div>Chọn ảnh...</div>
                                <input type="file"
                                       class="filepond"
                                       name="data[chitiet][anh]"
                                       accept="image/png, image/jpeg, image/gif"
                                       id="filepond"/>

                            </label>
                        </div>
                        <div class="group1 col-lg-6 col-xl-5">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Đơn vị <span
                                            style="color:red">(*)</span>:</label>
                                <input type="hidden" name="data[giangvien][madonvi]" disabled  value="" id="donvi_id" value="">
                                <div class="col-lg-9">
                                        <input type="text" name="data[giangvien][donvi_id]" disabled  value="" class="form-control rounded"
                                               id="TenDonVi" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Mã nhân viên <span
                                            style="color:red">(*)</span></label>
                                <div class="col-lg-9">
                                    <div class="form-row">
                                        <div class="col">
                                            <input type="text" name="data[giangvien][manv]" disabled  value="" class="form-control rounded"
                                                   readonly="" placeholder="Mã đơn vị" id="manv" value="D2509000">
                                        </div>
                                        <span class="lb-manv">.</span>
                                        <div class="col">
                                            <input name="data[giangvien][manv2]" disabled  value="" class="form-control rounded" id="manv2"
                                                   data-inputmask="'mask': '999999'" required="required" type="text"
                                                   placeholder="">
                                        </div>
                                    </div>
                                    <b>Quy ước đánh mã nhân viên: </b><i>Mã đơn vị + 06 số với quy ước gồm: : 02 số đầu tiên
                                        là năm tuyển dụng, 02 số tiếp theo là đợt tuyển dụng, 02 số cuối cùng là số thứ tự
                                        theo danh sách trúng tuyển.</i>
                                </div>

                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Số CMND( Căn cước):</label>
                                <div class="col-lg-9">
                                    <input type="number" name="data[chitiet][cmnd]"  value="{{$chitiet != null ? $chitiet->cmnd:''}}" class="form-control rounded" id="cmnd"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày cấp:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chitiet][ngaycap]"  value="{{$chitiet != null ? $chitiet->ngaycap:''}}" class="form-control rounded hasDatepicker"
                                           id="ngaycap" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Nơi cấp:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chitiet][noicap]"  value="{{$chitiet != null ? $chitiet->noicap:''}}" class="form-control rounded" id="noicap"
                                           value="">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Diện ƯT gia đình:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][dienuutien_gd_id]"
                                            class="input_dutgd form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['dienuutien_gd'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->dienuutien_gd_id == $item->key ? "selected" : ''}}>{{$item->dienuutien_gd}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Diện ƯT bản thân:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][dienuutien_bt_id]"
                                            class="input_dutbt form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['dienuutien_bt'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->dienuutien_bt_id == $item->key ? "selected" : ''}}>{{$item->dienuutien_bt}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Tôn giáo:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][tongiao_id]"
                                            class="input_tongiao form-control custom-select rounded" id="UserTongiaoId">
                                        <option value="">Chọn</option>
                                        @foreach($dm['tongiao'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->tongiao_id == $item->key ? "selected" : ''}}>{{$item->tongiao}}</option>@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hôn nhân:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][honnhan]" class="input_hn form-control custom-select rounded"
                                            id="UserHonnhan">
                                        <option value="">Chọn</option>
                                        @foreach($dm['honnhan'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->honnhan == $item->key ? "selected" : ''}}>{{$item->honnhan}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Xuất thân:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][xuatthan_id]"
                                            class="input_xuatthan form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['xuatthan'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->xuatthan_id == $item->key ? "selected" : ''}}>{{$item->xuatthan}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Tr.thái làm việc:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][trangthailamviec_id]"
                                            class="input_ttlamviec form-control custom-select rounded"
                                            id="UserTrangthailamviecId">
                                        <option value="">Chọn</option>
                                        @foreach($dm['trangthailamviec'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->trangthailamviec_id == $item->key ? "selected" : ''}}>{{$item->trangthailamviec}}</option>@endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="group2 col-lg-6 col-xl-5">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Họ tên: <span
                                            style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[giangvien][tennv]" disabled  value="{{$giangvien != null ? $giangvien->hodem .' '.$giangvien->ten:''}}" class="form-control rounded" id="tennv"
                                           value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Username: <span style="color:red">(*)</span></label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[giangvien][username]" disabled  value="{{$giangvien != null ? $giangvien->username : "" }}" class="form-control rounded"
                                           id="username" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-lg-3 col-form-label">Giới tính:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][gioitinh]"
                                            class="input_dutgd form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        <option value="0" {{$chitiet->gioitinh == 0 ? "selected" : ""}}>Nam</option>
                                        <option value="1" {{$chitiet->gioitinh == 1 ? "selected" : ""}}>Nữ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày sinh:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chitiet][ngaysinh]"  value="{{$chitiet != null ? $chitiet->ngaysinh:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaysinh" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Nơi sinh:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chitiet][noisinh]"  value="{{$chitiet != null ? $chitiet->noisinh:''}}" class="form-control rounded" id="noisinh"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Dân tộc:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][dantoc_id]"
                                            class="input_tinhthanh custom-select rounded form-control" id="dantoc_id">
                                        <option value="">Chọn</option>
                                        @foreach($dm['dantoc'] as $item)
                                            <option value="{{$item->key}}" {{$chitiet->dantoc_id == $item->key ? "selected" : ''}}>{{$item->dantoc}}</option><
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row form-warring">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Email:</label>
                                <div class="col-lg-9 lb-add-user">
                                    <input type="text" name="data[giangvien][email]" disabled  value="{{$giangvien != null ? $giangvien->email:''}}" class="form-control rounded" id="email"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Số di động:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="data[giangvien][sdt]" disabled  value="{{$giangvien != null ? $giangvien->phone:''}}" class="form-control rounded" id="sdt"
                                           value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Quê quán:</label>
                                <div class="col-lg-9">
                                    <div class="form-row">
                                        <div class="col">
                                            <select name="data[chitiet][tinh_thanhpho_id]"
                                                    class="input_tinhthanh custom-select rounded form-control"
                                                    id="UserTinhThanhphoId">
                                                <option value="">Tỉnh/thành</option>
                                                @foreach($dm['tinh_thanhpho'] as $item)
                                                    <option value="{{$item->key}}" {{$chitiet->tinh_thanhpho_id == $item->key ? "selected" : ''}}>{{$item->tinh_thanhpho}}</option>@endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="data[chitiet][huyen_quan_id]"
                                                    class="input_huyenquan custom-select rounded form-control"
                                                    id="UserHuyenQuanId">
                                                <option value="">Huyện/quận</option>
                                                @foreach($dm['huyen_quan'] as $item)
                                                    <option value="{{$item->key}}" {{$chitiet->huyen_quan_id == $item->key ? "selected" : ''}}>{{$item->huyen_quan}}</option>@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-9">
                                    <div class="form-row">
                                        <input type="text" name="data[chitiet][xa_phuong]"  value="{{$chitiet != null ? $chitiet->xa_phuong:''}}" class="form-control rounded"
                                               placeholder="Xã/phường..." id="xa_phuong">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Thường trú:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chitiet][thuongtru]"  value="{{$chitiet != null ? $chitiet->thuongtru:''}}" class="form-control rounded"
                                           id="thuongtru" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Nơi ở hiện nay:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chitiet][noiohiennay]"  value="{{$chitiet != null ? $chitiet->noiohiennay:''}}" class="form-control rounded"
                                           id="noiohiennay" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Thông tin tuyển dụng và HĐLĐ -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin tuyển dụng và HĐLĐ</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="group1 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày tuyển dụng:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[tuyendunghopdong][ngaytuyendung]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->ngaytuyendung:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaytuyendung" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày BN chức danh nghề
                                    nghiệp:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[tuyendunghopdong][ngaybnngach]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->ngaybnngach:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaybnngach" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Loại HĐ <span
                                            style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <select name="data[tuyendunghopdong][loaicanbo_id]"
                                            class="UserLoaicanboId form-control custom-select rounded" id="loaihopdong">
                                        <option value="">Chọn</option>
                                        @foreach($dm['loaicanbo'] as $item)<option value="{{$item->key}}" {{$tuyendunghopdong->loaicanbo_id == $item->key ? "selected" : ''}}>{{$item->loaicanbo}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày ký:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[tuyendunghopdong][ngayky]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->ngayky:''}}"
                                           class="form-control rounded hasDatepicker" id="ngayky" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày bắt đầu HĐ:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[tuyendunghopdong][tungay]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->tungay:''}}"
                                           class="form-control rounded hasDatepicker" id="ngayhopdong" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày hết hạn:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[tuyendunghopdong][denngay]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->denngay:''}}"
                                           class="form-control rounded hasDatepicker" id="ngayhethan" value="">
                                </div>
                            </div>
                        </div>
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">C.việc theo HĐ:</label>
                                <div class="col-lg-9">
                                    <select name="data[tuyendunghopdong][vieckhituyendung_id]" id="cvtheohd"
                                            class="input_dantoc form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['vieckhituyendung'] as $item)<option value="{{$item->key}}" {{$tuyendunghopdong->vieckhituyendung_id == $item->key ? "selected" : ''}}>{{$item->vieckhituyendung}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label"><a href="javascript:">Đ.vị sinh
                                        hoạt chuyên môn:</a></label>
                                <div class="col-lg-9">
                                    <input type="hidden" name="data[tuyendunghopdong][dvsh]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->dvsh:''}}" id="donvisinhhoat" value="">
                                    <select name="data[tuyendunghopdong][dvsh]" class="input_cvhn form-control custom-select rounded"
                                            id="DonViSinhHoat">
                                        <option value="">Chọn</option>
                                        @foreach($dm['dvsh'] as $item)<option value="{{$item->key}}" {{$tuyendunghopdong->dvsh == $item->key ? "selected" : ''}}>{{$item->dvsh}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Đang nghỉ chế độ BHXH:</label>
                                <div class="col-lg-9">
                                    <select name="data[tuyendunghopdong][nghi_baohiemxahoi_id]"
                                            class="input_cvhn form-control custom-select rounded"
                                            id="UserNghiBaohiemxahoiId">
                                        <option value="">Chọn</option>
                                        @foreach($dm['nghi_baohiemxahoi'] as $item)<option value="{{$item->key}}" {{$tuyendunghopdong->nghi_baohiemxahoi_id == $item->key ? "selected" : ''}}>{{$item->nghi_baohiemxahoi}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Đính kèm file QĐTD:</label>
                                <div class="col-lg-9">
                                    <input type="file" name="data[tuyendunghopdong][file]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->file:''}}"
                                           class="form-control rounded form-control-file"
                                           id="pc_thuhut" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Số sổ bảo hiểm:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[tuyendunghopdong][sobhxh]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->sobhxh:''}}" class="form-control rounded" id="pc_thuhut"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Liên kết scv::</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[tuyendunghopdong][lienketscv]"  value="{{$tuyendunghopdong != null ? $tuyendunghopdong->lienketscv:''}}" class="form-control rounded"
                                           id="lienketscv" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Thông tin chức danh nghề nghiệp, lương - Hệ số phụ cấp -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin chức danh nghề nghiệp, lương - Hệ số phụ cấp</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="group2 col-md-6">
                            <input type="hidden" name="data[chucdanh][maloai]"  value="{{$chucdanh != null ? $chucdanh->maloai:''}}" class="form-control rounded" id="maloai"
                                   value="{{$chucdanh->maloai}}">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Chức danh nghề nghiệp <span
                                            style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <select name="data[chucdanh][ngachcc]"
                                            class="UserHochamId form-control custom-select rounded" id="ngachcc">
                                        <option value="">Chọn</option>
                                        @foreach($dm['ngachcc'] as $item)<option value="{{$item->key}}" {{$chucdanh->ngachcc == $item->key ? "selected" : ''}}>{{$item->ngachcc}}</option>@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Mã ngạch <span style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <input type="text" disabled name="data[chucdanh][ngachcongchuc_id]"
                                           class="form-control rounded" id="mangach" value="{{$chucdanh->ngachcc}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Bậc lương:</label>
                                <div class="col-lg-9 form-row">
                                    <div class="col-4">
                                        <select name="data[chucdanh][bluong]" class="form-control rounded custom-select rounded"
                                                id="select_bacluong">
                                            <option value="">Chọn</option>
                                            @for($i = 1; $i <= 12; $i++)<option value="{{$i}}"  {{$chucdanh->bluong == $i ? "selected" : ''}}>Bậc {{$i}}</option>@endfor
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <input type="text" name="data[chucdanh][hesoluong]"  value="{{$chucdanh != null ? $chucdanh->hesoluong:''}}" class="form-control rounded"
                                               placeholder="Hệ số lương" id="hesoluong" value="">
                                    </div>
                                    <div class="col-4 d-flex flex-row pd-t8">
                                        <label>Mức hưởng</label>
                                        <div class="col-lg-6 custom-control custom-checkbox mg-l12">

                                        </div>
                                        <div class="col-lg-6 custom-control custom-checkbox mg-l12">
                                            <div class="ml-2 mt-2 radio radio-inline icheck-primary">
                                                <input type="checkbox" class="flat" name="data[chucdanh][heso85]" {{$chucdanh->heso85 ? "checked": ""}} id="heso85" value="1"> 85%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Mốc tính nâng lương <span
                                            style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chucdanh][moctinhnangluong]"  value="{{$chucdanh != null ? $chucdanh->moctinhnangluong:''}}"
                                           class="form-control rounded hasDatepicker" id="moctinhnangluong" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hưởng lương từ ngày <span
                                            style="color:red">(*)</span>:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chucdanh][huongtungay]"  value="{{$chucdanh != null ? $chucdanh->huongtungay:''}}"
                                           class="form-control rounded hasDatepicker" id="huongtungay" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày hưởng TNNG:</label>
                                <div class="col-lg-9">
                                    <div class="form-row">
                                        <div class="col-5">
                                            <input type="date" name="data[chucdanh][thamnien_nhagiao]"  value="{{$chucdanh != null ? $chucdanh->thamnien_nhagiao:''}}"
                                                   class="form-control rounded hasDatepicker" placeholder=""
                                                   id="thamnien_nhagiao" value="">
                                        </div>
                                        <div class="col-2 text-center" style="padding-top: 5px;">
                                            <span style="font-size: 20px;text-align: center;">+</span>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" name="data[chucdanh][tam]"  value="{{$chucdanh != null ? $chucdanh->tam:''}}" class="form-control rounded"
                                                   placeholder="Tỉ lệ %" id="tam" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Phần trăm vượt khung:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][vuotkhung]"  value="{{$chucdanh != null ? $chucdanh->vuotkhung:''}}" class="form-control rounded"
                                           id="vuotkhung" value="">
                                </div>
                            </div>
                        </div>
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Loại <span
                                            style="color:red">(*)</span></label>
                                <div class="col-lg-9">
                                    <select name="data[chucdanh][loaicongchuc_id]" id="loaicongchuc_id"
                                            class="UserHochamId form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['loaicongchuc'] as $item)<option value="{{$item->key}}" {{$chucdanh->loaicongchuc_id == $item->key ? "selected" : ''}}>{{$item->loaicongchuc}}</option>@endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">PC thu hút:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][pc_thuhut]"  value="{{$chucdanh != null ? $chucdanh->pc_thuhut:''}}" class="form-control rounded"
                                           id="pc_thuhut" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">PC độc hại:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][hspc_dochai]"  value="{{$chucdanh != null ? $chucdanh->hspc_dochai:''}}" class="form-control rounded"
                                           id="hspc_dochai" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">PC ưu đãi:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][pc_uudai]"  value="{{$chucdanh != null ? $chucdanh->pc_uudai:''}}" class="form-control rounded"
                                           id="pc_uudai" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC trách nhiệm:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][hspc_trachnhiem]"  value="{{$chucdanh != null ? $chucdanh->hspc_trachnhiem:''}}" class="form-control rounded"
                                           id="hspc_trachnhiem" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC khu vực:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][hspc_khuvuc]"  value="{{$chucdanh != null ? $chucdanh->hspc_khuvuc:''}}" class="form-control rounded"
                                           id="hspc_khuvuc" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PC khác:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[chucdanh][hspc_khac]"  value="{{$chucdanh != null ? $chucdanh->hspc_khac:''}}" class="form-control rounded"
                                           id="hspc_khac" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Thông tin bổ nhiệm -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin bổ nhiệm</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Chức vụ bổ nhiệm:</label>
                                <div class="col-lg-9">
                                    <select name="data[bonhiem][chucvuhientai_id]"
                                            class="input_dantoc form-control custom-select rounded"
                                            id="UserChucvuhientaiId">
                                        <option value="">Chọn</option>
                                        @foreach($dm['chucvuhientai'] as $item)<option value="{{$item->key}}" {{$bonhiem->chucvuhientai_id == $item->key ? "selected" : ''}}>{{$item->chucvuhientai}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày bổ nhiệm:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[bonhiem][ngaybonhiem]"  value="{{$bonhiem != null ? $bonhiem->ngaybonhiem:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaybonhiem" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Đến ngày:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[bonhiem][ngaykt_bonhiem]"  value="{{$bonhiem != null ? $bonhiem->ngaykt_bonhiem:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaykt_bonhiem" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">CV kiêm nhiệm:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[bonhiem][cvcqkiemnhiem]"  value="{{$bonhiem != null ? $bonhiem->cvcqkiemnhiem:''}}" class="form-control rounded"
                                           id="cvcqkiemnhiem" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Chức vụ cơ quan cao nhất đã
                                    qua:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[bonhiem][cvcqcaonhat]"  value="{{$bonhiem != null ? $bonhiem->cvcqcaonhat:''}}" class="form-control rounded"
                                           id="cvcqcaonhat" value="">
                                </div>
                            </div>
                        </div>
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hệ số PCCV</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[bonhiem][hspc]"  value="{{$bonhiem != null ? $bonhiem->hspc:''}}" class="form-control rounded" id="hspc"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Số QĐ bổ nhiệm</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[bonhiem][soqdbonhiem]"  value="{{$bonhiem != null ? $bonhiem->soqdbonhiem:''}}" class="form-control rounded" id="hspc"
                                           value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Đính kèm file QĐBN:</label>
                                <div class="col-lg-9">
                                    <input type="file" name="data[bonhiem][file_qdtuyendung]"  value="{{$bonhiem != null ? $bonhiem->file_qdtuyendung:''}}" class="form-control rounded"
                                           id="fileQDTD" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Thông tin đoàn thể -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin đoàn thể</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày vào Đảng CSVN:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chitiet][ngayvaodang]"  value="{{$chitiet != null ? $chitiet->ngayvaodang:''}}"
                                           class="form-control rounded hasDatepicker" id="ngayvaodang" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Ngày chính thức:</label>
                                <div class="col-lg-9">
                                    <input type="date" name="data[chitiet][ngaychinhthuc]"  value="{{$chitiet != null ? $chitiet->ngaychinhthuc:''}}"
                                           class="form-control rounded hasDatepicker" id="ngaychinhthuc" value="">
                                </div>
                            </div>

                        </div>
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">CV Đảng hiện tại:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][chucvudang_id]"
                                            class="UserChucvudangId form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['chucvudang'] as $item)<option value="{{$item->key}}" {{$chitiet->chucvudang_id == $item->key ? "selected" : ''}}>{{$item->chucvudang}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">CV đoàn thể hiện tại:</label>
                                <div class="col-lg-9">
                                    <select name="data[chitiet][chucvudoanthe_id]"
                                            class="UserChucvudoantheId form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['chucvudoanthe'] as $item)<option value="{{$item->key}}" {{$chitiet->chucvudang_id == $item->key ? "selected" : ''}}>{{$item->chucvudoanthe}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="doanvien" class="col-lg-3 col-form-label">Đoàn viên</label>
                                <div class="col-lg-9 form-row">
                                    <div class="ml-2 mt-2 radio radio-inline icheck-primary">
                                        <input type="checkbox" class="flat" name="data[chitiet][doanvien]" {{$chitiet->doanvien == 1 ? "checked" : ''}} value="1" id="doanvien">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Thông tin về trình độ chuyên môn -->
            <div class="col-12 demuc-wrapper bg-white p-3 mb-3">
                <div class="title">
                    <h5 class="p-0">Thông tin về trình độ chuyên môn</h5>
                    <hr/>
                </div>
                <div class="body">
                    <div class="row pt-3">
                        <div class="group2 col-md-6">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ hiện tại:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][trinhdochuyenmon_id]" id="selecTrinhdodaotao"
                                            class="UserTrinhdochuyenmonId form-control rounded custom-select">
                                        <option value="">Chọn</option>
                                        @foreach($dm['trinhdochuyenmon'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->trinhdochuyenmon_id == $item->key ? "selected" : ''}}>{{$item->trinhdochuyenmon}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Khối ngành:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][khoinganh_id]"
                                            class="UserNganhDaoTaoId form-control rounded custom-select" id="khoinganh">
                                        <option value="">Chọn khối ngành</option>
                                        @foreach($dm['khoinganh'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->khoinganh_id == $item->key ? "selected" : ''}}>{{$item->khoinganh}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Lĩnh vực:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][linhvuc_id]" class="form-control rounded custom-select"
                                            id="linhvuc">
                                        <option value=""> Chọn lĩnh vực</option>
                                        @foreach($dm['linhvuc'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->linhvuc_id == $item->key ? "selected" : ''}}>{{$item->linhvuc}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Chuyên ngành:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[trinhdochuyenmon][chuyennganh]"  value="{{$trinhdochuyenmon != null ? $trinhdochuyenmon->chuyennganh:''}}" class="form-control rounded"
                                           id="chuyennganh" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Hình thức đào tạo:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][hinhthucdaotao_id]"
                                            class="UserHinhthucdaotaoId form-control rounded custom-select" id="linhvuc">
                                        <option value="">Chọn</option>
                                        @foreach($dm['hinhthucdaotao'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->hinhthucdaotao_id == $item->key ? "selected" : ''}}>{{$item->hinhthucdaotao}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Quốc gia:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][quocgia_id]" id="quocgia"
                                            class="form-control rounded custom-select">
                                        <option value="">Chọn</option>
                                        @foreach($dm['quocgia'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->quocgia_id == $item->key ? "selected" : ''}}>{{$item->quocgia}}</option>@endforeach<br/>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Cơ sở đào tạo:</label>
                                <div class="col-lg-9">
                                    <input type="text" name="data[trinhdochuyenmon][noidaotao_id]"  value="{{$trinhdochuyenmon != null ? $trinhdochuyenmon->noidaotao_id:''}}" class="form-control rounded"
                                           id="noidaotao_id" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Năm tốt nghiệp:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="data[trinhdochuyenmon][namtotnghiep]"  value="{{$trinhdochuyenmon != null ? $trinhdochuyenmon->namtotnghiep:''}}" class="form-control rounded"
                                           id="namtotnghiep" value="">
                                </div>
                            </div>
                        </div>
                        <div class="group2 col-md-6">

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Chức danh hiện tại:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][hocham_id]" id="selectChucDanh"
                                            class="UserHochamId form-control rounded custom-select">
                                        <option value="">Chọn</option>
                                        @foreach($dm['hocham'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->hocham_id == $item->key ? "selected" : ''}}>{{$item->hocham}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Năm công nhận:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="data[trinhdochuyenmon][namcongnhan]"  value="{{$trinhdochuyenmon != null ? $trinhdochuyenmon->namcongnhan:''}}" class="form-control rounded"
                                           id="namcongnhan" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Danh hiệu nhà giáo:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdochuyenmon][danhhieu_id]"
                                            class="UserDanhhieuId form-control rounded custom-select">
                                        <option value="">Chọn</option>
                                        @foreach($dm['danhhieu'] as $item)<option value="{{$item->key}}" {{$trinhdochuyenmon->danhhieu_id == $item->key ? "selected" : ''}}>{{$item->danhhieu}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Năm công nhận:</label>
                                <div class="col-lg-9">
                                    <input type="number" name="data[trinhdochuyenmon][namcongnhannhagiao]"  value="{{$trinhdochuyenmon != null ? $trinhdochuyenmon->namcongnhannhagiao:''}}" class="form-control rounded"
                                           id="namcongnhannhagiao" value="">
                                </div>
                            </div>
                            <!--               <div class="form-group row">-->
                            <!--                   <div class="col-9">-->
                            <!--                       <button type="button" class="btn btn-info bd-r4" data-toggle="modal" data-target="#modalHocHam"><i class="fas fa-plus"></i></button>-->
                            <!--                       <span>Bổ sung chức danh</span>-->
                            <!--                   </div>-->
                            <!--               </div>-->

                        </div>
                    </div>
                </div>
            </div>
        <!-- Trình độ lý luận CT/ Ngoại ngữ - Tin học - Quản lý NN - Quản lý GD -->
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
                                        @foreach($dm['trinhdochinhtri'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->trinhdochinhtri_id == $item->key ? "selected" : ''}}>{{$item->trinhdochinhtri}}</option>@endforeach<br/>
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
                                        @foreach($dm['trinhdongoaingu'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->ngoaingu_id == $item->key ? "selected" : ''}}>{{$item->trinhdongoaingu}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ
                                    khác:</label>
                                <div class="col-lg-9">
                                        <select name="data[trinhdolyluan][trinhdongoaingukhac][]"
                                                class="UserTrinhdongoaingukhac form-control custom-select rounded SumoUnder selectpicker"
                                                multiple id="ngoaingukhac" tabindex="-1"
                                                data-container="body" data-live-search="true" title="Lựa chọn" data-actions-box="true">
                                            @foreach($dm['trinhdongoaingukhac'] as $item)
                                                <option value="{{$item->key}}" {{in_array($item->key, $trinhdolyluan->trinhdongoaingukhac) ? "selected" : ""}}>
                                                {{$item->trinhdongoaingukhac}}</option>@endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Trình độ ngoại ngữ:</label>
                                <div class="col-lg-9">
                                    <select name="data[trinhdolyluan][trinhdongoaingu_id]"
                                            class="UserTrinhdotinhocId form-control custom-select rounded">
                                        <option value="">Chọn</option>
                                        @foreach($dm['trinhdongoaingu'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->trinhdongoaingu_id == $item->key ? "selected" : ''}}>{{$item->trinhdongoaingu}}</option>@endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staticEmail" class="col-lg-3 col-form-label">Mô tả trình độ ngoại
                                    ngữ:</label>
                                <div class="col-lg-9">
                                <textarea class="form-control" rows="5"
                                          name="data[trinhdolyluan][motatrinhdongoaingu]">{{$trinhdolyluan->ngoaingu_id != null ? $trinhdolyluan->ngoaingu_id : ''}}</textarea>
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
                                        @foreach($dm['trinhdotinhoc'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->trinhdotinhoc_id == $item->key ? "selected" : ''}}>{{$item->trinhdotinhoc}}</option>@endforeach
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
                                        @foreach($dm['trinhdoqlnhanuoc'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->trinhdoqlnhanuoc_id == $item->key ? "selected" : ''}}>{{$item->trinhdoqlnhanuoc}}</option>@endforeach
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
                                        @foreach($dm['trinhdoqlgiaoduc'] as $item)<option value="{{$item->key}}" {{$trinhdolyluan->trinhdoqlgiaoduc_id == $item->key ? "selected" : ''}}>{{$item->trinhdoqlgiaoduc}}</option>@endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection
@section('custom-script')
    <script>
        /*
We need to register the required plugins to do image manipulation and previewing.
*/
        FilePond.registerPlugin(
            // encodes the file as base64 data
            FilePondPluginFileEncode,

            // validates files based on input type
            FilePondPluginFileValidateType,

            // corrects mobile image orientation
            FilePondPluginImageExifOrientation,

            // previews the image
            FilePondPluginImagePreview,

            // crops the image to a certain aspect ratio
            FilePondPluginImageCrop,

            // resizes the image to fit a certain size
            FilePondPluginImageResize,

            // applies crop and resize information on the client
            FilePondPluginImageTransform
        );

        // Select the file input and use create() to turn it into a pond
        // in this example we pass properties along with the create method
        // we could have also put these on the file input element itself
        FilePond.create(
            document.querySelector('#filepond'),
            {
                labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
                imagePreviewHeight: 170,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 200,
                imageResizeTargetHeight: 200,
                stylePanelLayout: 'compact circle',
                styleLoadIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom'
            }
        );
    </script>
    <script>
        $('#ngoaingukhac').selectpicker({
            liveSearch: true,
            style : "",
            styleBase: "form-control custom-select rounded",
            val: @json($trinhdolyluan->trinhdongoaingukhac)
        });
        $(document).ready(function (){
            $('select[id=ngachcc]').change(function (){
                $('input[id=mangach]').val($('select[id=ngachcc]').val());
                var strURL = '{{route('ad.hrm.dm.maloai.noparam')}}/'+ $('select[id=ngachcc]').val();
                console.log(strURL);
                $.ajax({
                    url: strURL,
                    type: 'get',
                    cache: false,
                    success: function(string){
                        var getData = $.parseJSON(string);
                        $('#maloai').val(getData.maloai);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });
            });
            $('#select_bacluong').change(function () {
                var strURL = '{{route('ad.hrm.dm.bluong.noparam')}}/'+ $('input[id=mangach]').val()+ '/' + $('select[id=select_bacluong]').val();
                console.log(strURL);
                $.ajax({
                    url: strURL,
                    type: 'get',
                    cache: false,
                    success: function(string){
                        var getData = $.parseJSON(string);
                        $('#hesoluong').val(getData.bac);
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });
            })
            $('#khoinganh').change(function () {
                var strURL = '{{route('ad.hrm.dm.linhvuc.noparam')}}/'+ $('#khoinganh').val();
                console.log(strURL);
                $.ajax({
                    url: strURL,
                    type: 'get',
                    cache: false,
                    success: function(string){
                        let getDataRaw = JSON.parse(string);
                        let getData = Object.entries(getDataRaw);


                        var select = document.getElementById('linhvuc');

                        select.innerHTML = "<option value=\"\">Chọn</option>";
                        for(let i = 0; i < getData.length; i++){
                            let option = document.createElement('option');
                            option.text = getData[i][1].linhvuc;
                            option.value = getData[i][1].key;
                            select.appendChild(option);
                        }
                    },
                    error: function (){
                        alert('Có lỗi xảy ra');
                    }
                });
            })
        });
    </script>
    <script>
        $( function() {
            $( "#ngaytuyendung" ).datepicker();
        } );
    </script>
@endsection
@section('custom-css')
<style>
    /*
 * FilePond Custom Styles
 */

    .filepond--drop-label {
        color: #4c4e53;
    }

    .filepond--label-action {
        text-decoration-color: #babdc0;
    }

    .filepond--panel-root {
        background-color: #edf0f4;
    }


    /**
     * Page Styles
     */
    /*html {*/
    /*    padding: 20vh 0 0;*/
    /*}*/

    .filepond--root {
        width:170px;
        margin: 0 auto;
    }

</style>
@endsection