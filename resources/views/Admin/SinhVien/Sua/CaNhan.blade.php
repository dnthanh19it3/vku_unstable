@extends('layout.admin_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img id="avatar_round" src="{{$sinhvien->avatar}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        {{$sinhvien->hodem." ".$sinhvien->ten}}
                    </div>
                    <div class="profile-usertitle-job">
                        NGÀNH {{$sinhvien->tennganh}}
                    </div>
                    <div class="profile-usertitle-job">
                        LỚP {{$sinhvien->tenlop}} MSV {{$sinhvien->masv}}
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->

                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}">
                                <i class="glyphicon glyphicon-home"></i>
                                Thông tin cá nhân </a>
                        </li>
                        <li>
                            <a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}">
                                <i class="fas fa-star-half-alt"></i>
                                Khen thưởng và kỷ luật </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <form class="col-md-9" action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-12">
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
            </div>
            <div class="mb-3">
                <div class="profile_main_block p-4 bg-white">
                    <h6><i class="fas fa-info-circle mr-2"></i>Thông tin cá nhân</h6>
                    <hr/>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">Họ và tên</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->hodem}}" name="hodem" disabled>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Họ và tên</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->ten}}" name="ten" disabled>
                        </div>
                        <div class="col-md-2 form-group">
                            <div class="label">Giới tính</div>
                            <select type="text" class="form-control rounded" selected="{{$sinhvien->gioitinh}}" name="gioitinh" disabled>
                                <option value="0" {{$sinhvien->gioitinh ? "" : "selected"}}>Nữ</option>
                                <option value="1" {{$sinhvien->gioitinh ? "selected" : ""}}>Nam</option>
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <div class="label">Ngày sinh</div>
                            <input type="text" class="form-control rounded" value="{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}" name="ngaysinh" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 form-group">
                            <div class="label">Nơi sinh</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->noisinh}}" name="noisinh" disabled>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Dân tộc</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" name="dantoc" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">CMND/CCCD</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd}}" name="cmnd">
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Ngày cấp</div>
                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngaycap}}" name="ngaycap">
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Nơi cấp</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->noicap}}" name="noicap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">Đoàn thể</div>
                            <select name="doanthe" class="form-control rounded" value="{{$sinhvien->doanthe}}">
                                <option value="1" {{$sinhvien->doanthe == 1 ? 'selected' : ''}}>Đoàn viên</option>
                                <option value="2" {{$sinhvien->doanthe == 2 ? 'selected' : ''}}>Đảng viên</option>
                                <option value="0" {{$sinhvien->doanthe == 0 ? 'selected' : ''}}>Không</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Ngày kết nạp</div>
                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngayketnap}}" name="ngayketnap">
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Tôn giáo</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->tongiao}}" name="tongiao">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="profile_main_block p-4 bg-white">
                        <h6><i class="fas fa-users mr-2"></i>Thông tin gia đình</h6>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 ">
                                <h6 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h6>
                                <div class="form-group">
                                    <div class="label">Họ tên</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->hotencha}}" name="hotencha">
                                </div>
                                <div class="form-group">
                                    <div class="label">Ngày sinh</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhcha}}" name="namsinhcha">
                                </div>
                                <div class="form-group">
                                    <div class="label">Dân tộc</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_cha}}" name="dantoc_cha">
                                </div>
                                <div class="form-group">
                                    <div class="label">CMND/CCCD</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_cha}}" name="cmnd_cha">
                                </div>
                                <div class="form-group">
                                    <div class="label">Nghề nghiệp</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_cha}}" name="nghenghiep_cha">
                                </div>
                                <div class="form-group">
                                    <div class="label">Nơi ở</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_cha}}" name="diachi_cha">
                                </div>
                                <div class="form-group">
                                    <div class="label">Email</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->email_cha}}" name="email_cha">
                                </div>
                                <div class="form-group">
                                    <div class="label">SĐT</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_cha}}" name="sdt_cha">
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h6>
                                <div class="form-group">
                                    <div class="label">Họ tên</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->hotenme}}" name="hotenme">
                                </div>
                                <div class="form-group">
                                    <div class="label">Ngày sinh</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhme}}" name="namsinhme">
                                </div>
                                <div class="form-group">
                                    <div class="label">Dân tộc</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_me}}" name="dantoc_me">
                                </div>
                                <div class="form-group">
                                    <div class="label">CMND/CCCD</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_me}}" name="cmnd_me">
                                </div>
                                <div class="form-group">
                                    <div class="label">Nghề nghiệp</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_me}}" name="nghenghiep_me">
                                </div>
                                <div class="form-group">
                                    <div class="label">Nơi ở</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_me}}" name="diachi_me">
                                </div>
                                <div class="form-group">
                                    <div class="label">Email</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->email_me}}" name="email_me">
                                </div>
                                <div class="form-group">
                                    <div class="label">SĐT</div>
                                    <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_me}}" name="sdt_me">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h6> <button type="button" class="btn btn-sm btn-primary" id="btn_add_thanhphan"><i class="glyphicon glyphicon-plus"></i> Thêm thành phần</button>
                                <div class="form-group" id="thanhphan">
                                    <div class="label">Anh chị em</div>
                                    @if($sinhvien->thanhphangiadinh != null)
                                        @foreach($sinhvien->thanhphangiadinh as $item)
                                            <div class="input-group mb-3" id="">
                                                <input type="text" class="form-control rounded-left"
                                                       value="{{$item}}" name="thanhphangiadinh[]">
                                                <div class="input-group-append">
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
                </div>
            </div>
            <div class="mb-3">
                <div class="profile_main_block p-4 bg-white">
                    <h6><i class="fas fa-map-marker-alt mr-2"></i>Thường trú và địa chỉ</h6>
                    <hr/>
                    <i>Hộ khẩu thường trú</i>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">Thôn tổ</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->thon_to}}" name="thon_to"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Xã phường</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->xa_phuong}}" name="xa_phuong"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Quận huyện</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->quan_huyen}}" name="quan_huyen"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Tỉnh/ Thành phố</div>
                            <input type="text" class="form-control rounded" value="{{$sinhvien->tinh_thanh}}" name="tinh_thanh"/>
                        </div>
                    </div>
                    <i>Địa chỉ liên lạc</i>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control rounded" value="{{$sinhvien->dia_chi_lien_lac}}" name="dia_chi_lien_lac"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="profile_main_block p-4 bg-white">
                    <h6><i class="fas fa-address-card mr-2"></i>Thông tin liên hệ</h6>
                    <hr/>
                    <i>Thông tin liên hệ</i>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">Email khác</div>
                            <input type="text" class="form-control rounded" name="email_khac" value="{{$sinhvien->email_khac}}"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Điện thoại</div>
                            <input type="text" class="form-control rounded" name="dienthoai" value="{{$sinhvien->dienthoai}}"/>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Zalo</div>
                            <input type="text" class="form-control rounded" name="zalo" value="{{$sinhvien->zalo}}"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <div class="label">Điện thoại gia đình</div>
                            <input type="text" class="form-control rounded" name="dienthoaigiadinh" value="{{$sinhvien->dienthoaigiadinh}}">
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="label">Email khác</div>
                            <input type="text" class="form-control rounded" name="facebook" value="{{$sinhvien->facebook}}"/>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-primary pl-3 pr-3"><i class="fa fa-save mr-3"></i> Lưu</button>
                </div>
            </div>
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
                container.className = 'input-group mb-3';
                let input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('name', 'thanhphangiadinh[]');
                input.setAttribute('class', 'form-control rounded-left');
                let div_append = document.createElement('div');
                div_append.className = 'input-group-append';
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
                container.appendChild(input);
                container.appendChild(div_append);

                input_thanhphan_container.append(container);
            });
        })
    </script>
@endsection
