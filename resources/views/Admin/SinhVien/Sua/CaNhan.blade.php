@extends('layout.admin_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="col-md-12">
        <div class="row bg-white">
            <div class="col-md-3 profile-leftpanel pr-md-3 border-right">
                @include("Admin.SinhVien.Sua.Menu", ["index" => 1])
            </div>
            <div class="col-md-9 profile-mainpanel">
                <h5>Thông tin</h5>
                <form action="{{route('ad.suasinhvien.canhan.store', ['masv' => $sinhvien->masv])}}" method="POST">
                    {{ csrf_field() }}
                    <h6>Thông tin cá nhân</h6>
                    <hr>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (first name)-->
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputFirstName">Họ</label>
                            <input type="text" class="form-control"
                                   value="{{$sinhvien->hodem}}" name="hodem">
                            <input type="text" name="avatar" id="avatar" hidden>
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLastName">Tên</label>
                            <input type="text" class="form-control"
                                   value="{{$sinhvien->ten}}" name="ten">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (organization name)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputOrgName">Giói tính</label>
                            <select id="gioitinh" name="gioitinh" class="custom-select">
                                <option value="1">Nam</option>
                                <option value="0">Nữ</option>
                            </select>
                        </div>
                        <!-- Form Group (location)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Ngày sinh</label>
                            <input type="date" class="form-control"
                                   value="{{$sinhvien->ngaysinh}}" name="ngaysinh">
                        </div>
                        <!-- Form Group (location)-->
                        <div class="form-group col-md-4">
                            <label class="mb-1" for="inputLocation">Dân tộc</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->dantoc}}" name="dantoc">
                            </div>
                        </div>

                    </div>
                    <!-- Form Group (email address)-->
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Số CMND</label>
                            <input type="text" class="form-control"
                                   value="{{$sinhvien->cmnd}}" name="cmnd">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Ngày cấp</label>
                            <input type="date" class="form-control"
                                   value="{{$sinhvien->ngaycap}}" name="ngaycap">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Nơi cấp</label>
                            <input type="text" class="form-control"
                                   value="{{$sinhvien->noicap}}" name="noicap">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="form-row">
                        <!-- Form Group (phone number)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputPhone">Mã BHYT</label>
                            <input type="text" name="ma_bhyt" class="form-control" id="Mã BHYT"
                                   placeholder="Mã BHYT" value="{{$sinhvien->ma_bhyt}}">
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputBirthday">Đoàn thể</label>
                            <div class="detail-content">
                                <select name="doanthe" class="form-control" value="{{$sinhvien->doanthe}}">
                                    <option value="Đoàn viên">Đoàn viên</option>
                                    <option value="Đảng viên">Đảng viên</option>
                                    <option value="Không">Không</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputEmailAddress">Ngày kết nạp</label>
                            <input type="date" class="form-control" name="ngayketnap"
                                   value="{{$sinhvien->ngayketnap}}">
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Tôn giáo</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->tongiao}}" name="tongiao">
                            </div>
                        </div>
                    </div>
                    <h6>Thông tin gia đình</h6>
                    <hr/>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Họ tên cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->hotencha}}" name="hotencha">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Năm sinh cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->namsinhcha}}" name="namsinhcha">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Dân tộc cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->dantoc_cha}}" name="dantoc_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Số CMND cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->cmnd_cha}}" name="cmnd_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Nghề nghiệp cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->nghenghiep_cha}}" name="nghenghiep_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">SĐT Cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->sdt_cha}}" name="sdt_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Email cha (nếu có)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->email_cha}}" name="email_cha">
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" mb-1" for="inputLocation">Nơi ở cha</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->diachi_cha}}" name="diachi_cha">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Họ tên mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->hotenme}}" name="hotenme">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Năm sinh mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->namsinhme}}" name="namsinhme">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Dân tộc Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->dantoc_me}}" name="dantoc_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Số CMND Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->cmnd_me}}" name="cmnd_me">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Nghề nghiệp Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->nghenghiep_me}}" name="nghenghiep_me">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">SĐT Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->sdt_me}}" name="sdt_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Email mẹ (nếu có)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->email_me}}" name="email_me">
                            </div>
                        </div>
                        <div class="form-group col-md-8">
                            <label class=" mb-1" for="inputLocation">Nơi ở Mẹ</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->diachi_me}}" name="diachi_me">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class=" mb-1" for="inputLocation">Thành phần gia đình</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->thanhphangiadinh}}" name="thanhphangiadinh">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (tỉnh/tp)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->tinh_thanh}}" name="tinh_thanh">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (huyện/quận)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->quan_huyen}}" name="quan_huyen">
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (xã/phường)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->xa_phuong}}" name="xa_phuong">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Hộ khẩu (đường/ số nhà)</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->thon_to}}" name="thon_to">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" mb-1" for="inputLocation">Địa chỉ liên lạc</label>
                            <div class="detail-content">
                                <input type="text" class="form-control"
                                       value="{{$sinhvien->dia_chi_lien_lac}}" name="dia_chi_lien_lac">
                            </div>
                        </div>
                    </div>
                    <h6>Thông tin liên lạc</h6>
                    <hr/>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Số điện thoại</label>
                            <div class="detail-content">
                                <input type="text" class="form-control" name="dienthoai"
                                       placeholder="Số điện thoại" value="{{$sinhvien->dienthoai}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Số điện thoại gia đình</label>
                            <div class="detail-content">
                                <input type="text" class="form-control" name="dienthoaigiadinh"
                                       placeholder="Số điện thoại gia đình"
                                       value="{{$sinhvien->dienthoaigiadinh}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Email</label>
                            <div class="detail-content">
                                <input type="text" class="form-control" name="email_khac"
                                       value="{{$sinhvien->email_khac}}">
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class=" mb-1" for="inputLocation">Facebook</label>
                            <div class="detail-content">
                                <input type="text" class="form-control" name="facebook"
                                       value="{{$sinhvien->facebook}}">
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <button class="btn btn-primary" type="submit">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dropzone.css') }}" rel="stylesheet"/>
    <style>
        .img-account-profile {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .image_area {
            position: relative;
        }

        /* img {
        display: block;
        max-width: 100%;
        } */
        .preview {
            overflow: hidden;
            width: 300px;
            height: 400px;
            margin: 10px;
            border: 1px solid red;
        }

        .modal-lg {
            max-width: 1000px !important;
        }

        .overlay {
            position: absolute;
            bottom: 10px;
            left: 0;
            right: 0;
            background-color: rgba(255, 255, 255, 0.5);
            overflow: hidden;
            height: 0;
            transition: .5s ease;
            width: 100%;
        }

        .image_area:hover .overlay {
            height: 50%;
            cursor: pointer;
        }

        .text {
            color: #333;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .anhhoso-container {
            width: 100%;
            height: auto;
            position: relative;
        }

        .anhoso-badge {
            padding: 4px 8px;
            display: inline;
            background: red;
            color: white;
            font-size: 13px;
            bottom: 8px;
            left: 8px;
            position: absolute;
            border-radius: 8px;
        }

    </style>
@endsection
@section('custom-script')
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
        function loadCropModal() {
            $('#avatar').val('');
            $('#avatar').click();
        }

        $(document).ready(function () {
            var $modal = $('#modal');
            var image = document.getElementById('sample_image');
            var cropper;

            $('#avatar').change(function (event) {
                var files = event.target.files;
                var done = function (url) {
                    image.src = url;
                    $modal.modal('show');
                };
                if (files && files.length > 0) {
                    reader = new FileReader();
                    reader.onload = function (event) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(files[0]);
                }
            });
            $('#mirror-x').click(function (event) {
                cropper.scale($(this).val(), 1);
                if ($(this).val() == -1) {
                    $(this).val(1);
                } else {
                    $(this).val(-1);
                }
                console.log("Meet this action");
            })
            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 3 / 4,
                    viewMode: 1,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function () {
                canvas = cropper.getCroppedCanvas({
                    width: 300,
                    height: 400
                });
                canvas.toBlob(function (blob) {
                    url = URL.createObjectURL(blob);

                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;
                        $('#preview-avatar').attr('src', base64data);
                        $('#encoded_avatar').attr('value', base64data);
                        $('#avatartext').html("Xem trước");
                        $modal.modal('hide');
                    };
                });
            });

        });
    </script>

@endsection
