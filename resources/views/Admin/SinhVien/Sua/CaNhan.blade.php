@extends('layout.admin_layout')
@section('header')
@endsection
@section('body')
    <!-- NEW -->
    <style>
        .mr-2{margin-right: 8px}
        .ml-1{margin-left: 1px}
        .mr-1{margin-right: 1px}
        .mb-3{margin-bottom: 8px}
    </style>
    <div class="row">
        <div class="col-lg-3 col-xs-12" style="margin-bottom: 1rem">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img id="avatar_round" src="{{$sinhvien_static->anhthe}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{$sinhvien_static->hodem." ".$sinhvien_static->ten}}
                    </div>
                    <div class="profile-usertitle-job">
                        NGÀNH {{$sinhvien_static->tenNganh}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{$sinhvien_static->tenlop}} MSV {{$sinhvien_static->masv}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <div class="profile-usermenu">
                        <ul class="nav nav-pills nav-stacked" id="leftmenu">
                            <li class="active"><a href="#canhan" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Thông tin cá nhân</a></li>
                            <li><a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}"><span class="glyphicon glyphicon-star"></span> Khen thưởng kỷ luật</a></li>
                        </ul>
                    </div>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <form class="col-lg-9 col-xs-12" method="post" action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}">
            {{@csrf_field()}}
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
                        <h4><i class="fa fa-info-circle mr-2"></i>Thông tin cá nhân</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-5 col-xs-12 form-group">
                                <div class="title-text">Họ đệm</div>
                                <input type="text" class="form-control rounded" name="data[sinhvien][hodem]" value="{{$sinhvien->hodem}}"/>
                            </div>
                            <div class="col-lg-3 col-xs-12 form-group">
                                <div class="title-text">Tên</div>
                                <input type="text" class="form-control rounded" name="data[sinhvien][ten]" value="{{$sinhvien->ten}}"/>
                            </div>
                            <div class="col-lg-2 col-xs-12 form-group">
                                <div class="title-text">Giới tính</div>
                                <select type="text" class="form-control rounded" name="data[sinhvien][gioitinh]" selected="{{$sinhvien->gioitinh}}">
                                    <option value="0" {{$sinhvien->gioitinh ? "" : "selected"}}>Nam</option>
                                    <option value="1" {{$sinhvien->gioitinh ? "selected" : ""}}>Nữ</option>
                                </select>
                            </div>
                            <div class="col-lg-2 col-xs-12 form-group">
                                <div class="title-text">Ngày sinh</div>
                                <input type="date" class="form-control rounded" name="data[sinhvien][ngaysinh]" value="{{($sinhvien->ngaysinh)}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8 col-xs-12 form-group">
                                <div class="title-text">Nơi sinh</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][noisinh]" value="{{$sinhvien->noisinh}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Dân tộc</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][dantoc]" value="{{$sinhvien->dantoc}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">CMND/CCCD</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][cmnd]" value="{{$sinhvien->cmnd}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Ngày cấp</div>
                                <input type="date" class="form-control rounded" name="data[chitiet][canhan][ngaycap]" value="{{$sinhvien->ngaycap}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Nơi cấp</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][noicap]" value="{{$sinhvien->noicap}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Đoàn thể</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][doanthe]" value="{{getTruongTinh('doanthe', $sinhvien)}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Ngày kết nạp</div>
                                <input type="date" class="form-control rounded" name="data[chitiet][canhan][ngayketnap]" value="{{$sinhvien->ngayketnap}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Tôn giáo</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][canhan][tongiao]" value="{{$sinhvien->tongiao}}"/>
                            </div>
                        </div>
                    </div>
                <!-- GIA ĐÌNHZ -->
                    <div class="profile_main_block p-4 bg-white">
                        <h4><i class="fa fa-users mr-2"></i>Thông tin gia đình</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <h4 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h4>
                                <div class="form-group">
                                    <div class="title-text">Họ tên</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][hotencha]" value="{{$sinhvien->hotencha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Ngày sinh</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][namsinhcha]" value="{{$sinhvien->namsinhcha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Dân tộc</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][dantoc_cha]" value="{{$sinhvien->dantoc_cha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">CMND/CCCD</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][cmnd_cha]" value="{{$sinhvien->cmnd_cha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Nghề nghiệp</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][nghenghiep_cha]" value="{{$sinhvien->nghenghiep_cha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Nơi ở</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][diachi_cha]" value="{{$sinhvien->diachi_cha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Email</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][email_cha]" value="{{$sinhvien->email_cha}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">SĐT</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][sdt_cha]" value="{{$sinhvien->sdt_cha}}"/>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h4>
                                <div class="form-group">
                                    <div class="title-text">Họ tên</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][hotenme]" value="{{$sinhvien->hotenme}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Ngày sinh</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][namsinhme]" value="{{$sinhvien->namsinhme}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Dân tộc</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][dantoc_me]" value="{{$sinhvien->dantoc_me}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">CMND/CCCD</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][cmnd_me]" value="{{$sinhvien->cmnd_me}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Nghề nghiệp</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][nghenghiep_me]" value="{{$sinhvien->nghenghiep_me}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Nơi ở</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][diachi_me]" value="{{$sinhvien->diachi_me}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">Email</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][email_me]" value="{{$sinhvien->email_me}}"/>
                                </div>
                                <div class="form-group">
                                    <div class="title-text">SĐT</div>
                                    <input type="text" class="form-control rounded" name="data[chitiet][giadinh][sdt_me]" value="{{$sinhvien->sdt_me}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12 mt-3">
                                <h4 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị em</h4> <button type="button" class="btn btn-sm btn-primary" id="btn_add_thanhphan"><i class="glyphicon glyphicon-plus"></i> Thêm thành phần</button>
                                <div class="form-group" id="thanhphan">
                                    <div class="label">Anh chị em</div>
                                    @if($sinhvien->thanhphangiadinh != null)
                                        @foreach($sinhvien->thanhphangiadinh as $item)
                                            <div class="form-group row rounded mb-3" id="">
                                                <div class="col-lg-10 col-xs-10">
                                                    <input type="text" class="form-control rounded"
                                                           value="{{$item}}" name="data[chitiet][giadinh][thanhphangiadinh][]">
                                                </div>
                                                <div class="col-lg-2 col-xs-2">
                                                    <button class="btn btn-danger" type="button" onclick="this.parentNode.parentNode.remove(this)">Xoá</button>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-3" id="">
                                            <p>Chưa có bản ghi. Ấn thêm thành phần để thêm thành viên gia đình</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- THƯỜNG TRÚ VÀ ĐỊA CHỈ -->
                    <div class="profile_main_block">
                        <h4><i class="fa fa-map-marker mr-2"></i>Thường trú và địa chỉ</h4>
                        <hr/>
                        <i>Hộ khẩu thường trú</i>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Thôn tổ</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][diachi][thon_to]" value="{{$sinhvien->thon_to}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Xã phường</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][diachi][xa_phuong]"value="{{$sinhvien->xa_phuong}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Quận huyện</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][diachi][quan_huyen]" value="{{$sinhvien->quan_huyen}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Tỉnh/ Thành phố</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][diachi][tinh_thanh]" value="{{$sinhvien->tinh_thanh}}"/>
                            </div>
                        </div>
                        <i>Địa chỉ liên lạc</i>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="title-text">Địa chỉ</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][diachi][dia_chi_lien_lac]" value="{{$sinhvien->dia_chi_lien_lac}}"/>
                            </div>
                        </div>
                    </div>
                    <!-- THÔNG TIN LIÊN HỆ -->
                    <div class="profile_main_block p-4 bg-white">
                        <h4><i class="fa fa-phone mr-2"></i>Thông tin liên hệ</h4>
                        <hr/>
                        <i>Hộ khẩu thường trú</i>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Email khác</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][lienlac][email_khac]" value="{{$sinhvien->email_khac}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Điện thoại</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][lienlac][dienthoai]" value="{{$sinhvien->dienthoai}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Zalo</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][lienlac][zalo]" value="{{$sinhvien->zalo}}"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Điện thoại gia đình</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][lienlac][dienthoaigiadinh]" value="{{$sinhvien->dienthoaigiadinh}}"/>
                            </div>
                            <div class="col-lg-4 col-xs-12 form-group">
                                <div class="title-text">Facebook cá nhân</div>
                                <input type="text" class="form-control rounded" name="data[chitiet][lienlac][facebook]" value="{{$sinhvien->facebook}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-info" style="color: #337ab7 !important;">
                Sinh viên liên hệ <a href="https://www.facebook.com/ctsv.vku.udn.vn"><i class="fa fa-facebook ml-1 mr-1"></i>Phòng công tác sinh viên</a> hoặc <a href="tel:0236 3667 129"><i class="fa fa-phone mr-1"></i>0236 3667 129</a> nếu có thay đổi chi tiết thông tin cá nhân (Áp dụng với các trường thông tin bị làm mờ)
            </div>
            <button type="submit" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;Lưu</button>
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

            </style>
        </form>
    </div>
@endsection
@section('custom-script')
    <script>
        let input_thanhphan_container = $('#thanhphan');
        let btn_add_thanhphan = $('#btn_add_thanhphan');

        $(document).ready(()=>{

            btn_add_thanhphan.click(() => {
                let container = document.createElement('div');
                container.className = 'form-group row mb-3';


                let input_div = document.createElement('div');
                input_div.className = 'col-lg-10 col-xs-10';

                let input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'data[chitiet][giadinh][thanhphangiadinh][]');
                input.setAttribute('class', 'form-control rounded');
                input_div.append(input);
                container.append(input_div);

                let div_append = document.createElement('div');
                div_append.className = 'col-lg-2 col-xs-2';
                let button = document.createElement('button');
                button.setAttribute('type', 'button');
                button.setAttribute('class', 'btn btn-danger');
                button.innerHTML = "Xoá"

                button.addEventListener("click", () => {
                   let parent = button.parentNode.parentNode;
                   parent.remove(button);
                   console.log("Removed");
                });

                div_append.appendChild(button)
                // container.appendChild(input);
                container.appendChild(div_append);

                input_thanhphan_container.append(container);
            });
        })
    </script>
@endsection
