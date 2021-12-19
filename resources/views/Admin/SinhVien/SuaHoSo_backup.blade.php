@extends('layout.admin_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title"><h5>Ảnh hồ sơ</h5></div>
                <div class="x_content text-center">
                    <!-- Profile picture image-->
                    <img id="preview-avatar" class="img-account-profile rounded-circle mb-2"
                         src="{{asset($sinhvien->avatar)}}" alt="">
                    <!-- Profile picture help block-->
                    @if($sinhvien->avatar_temp)
                        <div class="font-italic text-muted mb-4" id="avatartext">Ảnh đại diện đang chờ duyệt</div>
                    @else
                        <div class="font-italic text-muted mb-4" id="avatartext">Chưa có file được chọn</div>
                @endif
                <!-- Profile picture upload button-->
                    <input type="file" name="avatar" id="avatar" hidden="true">
                    <button class="btn btn-primary" type="button" onclick="loadCropModal()">Tải ảnh lên</button>
                    <input type="text" name="encoded_avatar" id="encoded_avatar" hidden>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- Account details card-->
            <div class="x_panel mb-4">
                <div class="x_title"><h5>Thông tin chi tiết</h5></div>
                <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="thongtincanhan"
                                                                      role="tab" data-toggle="tab" aria-expanded="true">Thông
                                    tin cá nhân
                                    <nhân></nhân>
                                </a>
                            </li>
                            <li role="presentation" class="active"><a href="#tab_content2" id="anh" role="tab"
                                                                      data-toggle="tab" aria-expanded="false">Ảnh</a>
                            </li>
                            <li role="presentation" class="active"><a href="#tab_content3" id="khen-kyluat" role="tab"
                                                                      data-toggle="tab" aria-expanded="false">Khen
                                    thưởng và kỷ luật</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content4" role="tab" id="renluyen"
                                                                data-toggle="tab" aria-expanded="false">Điểm rèn
                                    luyện</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content5" role="tab" id="tamtru"
                                                                data-toggle="tab" aria-expanded="false">Tạm trú tạm
                                    vắng</a>
                            </li>
                        </ul>
                        {{ csrf_field() }}
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="tab_content1"
                                 aria-labelledby="thongtincanhan">
                                <form action="{{route('suahosoStore')}}" method="POST">
                                <h6>Thông tin cá nhân</h6>
                                <hr>
                                <!-- Form Row-->
                                <div class="form-row">
                                    <!-- Form Group (first name)-->
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputFirstName">Họ</label>
                                        <input type="text" class="form-control"
                                               value="{{$sinhvien->hodem}}">
                                        <input type="text" name="avatar" id="avatar" hidden>
                                    </div>
                                    <!-- Form Group (last name)-->
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLastName">Tên</label>
                                        <input type="text" class="form-control"
                                               value="{{    $sinhvien->ten}}">
                                        <input type="text" name="avatar" id="avatar" hidden>
                                    </div>
                                </div>
                                <!-- Form Row        -->
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
                                               value="{{$sinhvien->ngaysinh}}">
                                    </div>
                                    <!-- Form Group (location)-->
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputLocation">Dân tộc</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->dantoc}}">
                                        </div>
                                    </div>

                                </div>
                                <!-- Form Group (email address)-->
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputEmailAddress">Số CMND</label>
                                        <input type="text" class="form-control"
                                               value="{{$sinhvien->cmnd}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputEmailAddress">Ngày cấp</label>
                                        <input type="text" class="form-control"
                                               value="{{$sinhvien->ngaycap}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputEmailAddress">Nơi cấp</label>
                                        <input type="text" class="form-control"
                                               value="{{$sinhvien->noicap}}">
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
                                        <label class=" mb-1" for="inputLocation">Tôn giáo</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->tongiao}}">
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
                                                   value="{{$sinhvien->hotencha}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLocation">Năm sinh bố</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->namsinhcha}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLocation">Họ tên mẹ</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->hotenme}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLocation">Năm sinh mẹ</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->namsinhme}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputLocation">Hộ khẩu (tỉnh/tp)</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->tinh_thanh}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputLocation">Hộ khẩu (huyện/quận)</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->quan_huyen}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" mb-1" for="inputLocation">Hộ khẩu (xã/phường)</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->xa_phuong}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLocation">Hộ khẩu (đường/ số nhà)</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->thon_to}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class=" mb-1" for="inputLocation">Địa chỉ liên lạc</label>
                                        <div class="detail-content">
                                            <input type="text" class="form-control"
                                                   value="{{$sinhvien->dia_chi_lien_lac}}">
                                        </div>
                                    </div>
                                </div>
                                <h6>Thông tin liên lạc và địa chỉ</h6>
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
                            <div role="tabpanel" class="tab-pane" id="tab_content2" aria-labelledby="anh">
                                <h6>Ảnh hiện tại</h6>
                                <hr/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <img class="img-fluid" src="{{$sinhvien->avatar}}"/>
                                    </div>
                                </div>
                                <h6 class="mt-3">Ảnh đang chờ duyệt</h6>
                                <hr/>
                                @if($sinhvien->avatar_temp)
                                    <div class="row">
                                        <div class="col-md-3">
                                            <img class="img-fluid" src="{{asset($sinhvien->avatar_temp)}}"/>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <a href="{{route('ad.duyetanh', ['masv' => $sinhvien->masv])}}" class="btn btn-primary">Duyệt</a>
                                            <a href="#" class="btn btn-danger">Không duyệt</a>
                                        </div>
                                    </div>
                                @else
                                    <div>Không có ảnh nào chờ duyệt!</div>
                                @endif
                                <h6 class="mt-3">Ảnh đã tải lên</h6>
                                <hr/>
                                <div class="row">
                                @forelse($anhdatailen as $item)
                                        <div class="col-md-3">
                                            <div class="anhhoso-container">
                                                <img style="width: 100%;height: auto" src="{{asset($item->duongdan)}}"/>
                                                <div class="anhoso-badge">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:m')}}</div>
                                            </div>
                                        </div>
                                @empty
                                    <div class="col-12">Chưa có ảnh đã tải lên!</div>
                                @endforelse
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab_content3" aria-labelledby="khen-kyluat">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th>
                                           <input type="checkbox" id="check-all" class="flat">
                                        </th>
                                        <th class="column-title">Nội dung</th>
                                        <th class="column-title">Loại</th>
                                        <th class="column-title">Thời gian</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @php
                                        $i = 0;
                                    @endphp

                                    @foreach ($kyluat as $item)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $i += 1 }}</td>
                                            <td>{{ $item->noidung }}</td>
                                            <td>
                                                @if($item->loai == 1)
                                                    Khen thưởng
                                                @else
                                                    Kỉ luật
                                                @endif</td>
                                            <td>{{ $item->thoigian }}</td>
                                        </tr>
                                        @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Cập nhật khen thưởng
                                </button>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab_content4" aria-labelledby="renluyen">
                                Điểm rèn luyện
                            </div>
                            <div role="tabpanel" class="tab-pane" id="tab_content5" aria-labelledby="tamtru">
                                Tạm trú tạm vắng
                            </div>
                        </div>


                        <!-- Save changes button-->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Cắt ảnh trước khi tải lên</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8">
                                                    <img src="" id="sample_image"/>
                                                </div>
                                                <div class="col-md-4 col-sm-0 mx-auto d-block">
                                                    <div class="p-3">
                                                        Xem trước
                                                    </div>
                                                    <div class="preview mx-auto d-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="mirror-x" value="-1" class="btn btn-primary">Phải
                                            chiếu
                                        </button>
                                        <button type="button" id="crop" class="btn btn-primary">Cắt và tải lên</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ bỏ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal khen thưởng -->
    <form method="post" action="{{route('ad.capnhatkhenthuong', ['masv' => $sinhvien->masv])}}">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật khen thưởng kỷ luật</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <input type="text" name="noidung" class="form-control" placeholder="Nội dung khen thưởng/ kỉ luật">
                        </div>
                        <div class="form-group row">
                            <input type="date" name="thoigian" class="form-control" placeholder="Nội dung khen thưởng/ kỉ luật">
                        </div>
                        <div class="form-group row">
                            <select name="loai" class="form-control">
                                <option value="1">Khen thưởng</option>
                                <option value="2">Kỷ luật</option>
                            </select>
                        </div>
                        {{ csrf_field() }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
        .anhhoso-container{
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
