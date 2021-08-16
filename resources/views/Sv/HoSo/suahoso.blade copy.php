<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">


    <link rel="stylesheet" href="{{asset('assets/css/dropzone.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/cropper.css')}}" />
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>

</head>

<body>
    <div class="container">
        <div class="row">
            <!-- Sidebar block -->
            <!-- <div class="col-md-3 bg-default">
                <div class="bg-default">Sidebar</div>
            </div> -->
            <!-- Article block -->
            <div class="col-md-12">
                <div class="article-bl bg-default article-container">
                    <div class="profile-avatar">
                        <img id="uploaded_image"
                            src="{{asset($sinhvien->avatar)}}"
                            class="profile-avatar__img">
                        <button class="profile-avatar__edit"
                            onclick="document.getElementById('upload_image').click()"><i class="fas fa-pen mr-1"></i>
                            Chỉnh sửa</button>
                        <input type="file" id="upload_image" hidden>
                        
                    </div>
                    <form action="{{route('suahosoStore')}}" method="POST">
                        {{ csrf_field() }}
                    
                    <div class="article-item mt-100">
                        <div class="article__heading ml-red">SỬA THÔNG TIN CÁ NHÂN</div>
                        <!-- NAME SEX DOB -->
                        <div class="row mb-2">
                            <div class="col-lg-6 detail-block">
                                <div class="detail-title ">HỌ VÀ TÊN</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                         disabled  value="{{$sinhvien->hodem.' '.$sinhvien->ten}}">
                                        <input type="text" name="avatar" id="avatar" hidden>
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">GIỚI TÍNH</div>
                                <div class="detail-content">
                                    <select id="gioitinh" name="gioitinh" class="custom-select" disabled>
                                        <option value="1">Nam</option>
                                        <option value="0">Nữ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">NGÀY SINH</div>
                                <div class="detail-content">
                                    <input type="date" class="form-control" 
                                        value="{{$sinhvien->ngaysinh}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- DÂN TỘC TÔN GIÁO NƠI SINH -->
                        <div class="row mb-2">
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">DÂN TỘC</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"
                                    value="{{$sinhvien->dantoc}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">TÔN GIÁO</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->tongiao}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">NƠI SINH</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->noisinh}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- DÂN TỘC TÔN GIÁO NƠI SINH -->
                        <div class="row mb-2">
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">SỐ CMND</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->cmnd}}"  disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">NGÀY CẤP</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->ngaycap}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">NƠI CẤP</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->noicap}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- ĐOÀN THỂ + MÃ BHYT -->
                        <div class="row mb-2">
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">ĐOÀN THỂ</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->ngaysinh}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title ">MÃ BHYT</div>
                                <div class="detail-content">
                                    <input type="text" name="ma_bhyt" class="form-control" id="Mã BHYT"
                                        placeholder="Mã BHYT" value="{{$sinhvien->ma_bhyt}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article-item">
                        <div class="article__heading ml-yellow">
                            THÔNG TIN GIA ĐÌNH
                        </div>
                        <!-- DÂN TỘC TÔN GIÁO NƠI SINH -->
                        <div class="row mb-2">
                            <div class="col-lg-7 detail-block">
                                <div class="detail-title ">HỌ TÊN BỐ</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->hotencha}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-5 detail-block">
                                <div class="detail-title ">NĂM SINH</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->namsinhcha}}" disabled>
                                </div>
                            </div>
                        </div>
                        <!-- DÂN TỘC TÔN GIÁO NƠI SINH -->
                        <div class="row mb-2">
                            <div class="col-lg-7 detail-block">
                                <div class="detail-title ">HỌ TÊN MẸ</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->hotenme}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-5 detail-block">
                                <div class="detail-title ">NĂM SINH</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->namsinhme}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">HỘ KHẨU (TỈNH)</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->tinh_thanh}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">HỘ KHẨU (HUYỆN)</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->quan_huyen}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">HỘ KHẨU (XÃ)</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->xa_phuong}}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">HỘ KHẨU (ĐƯỜNG, SỐ NHÀ)</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->thon_to}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-12 detail-block">
                                <div class="detail-title ">Địa chỉ liên lạc</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control" 
                                    value="{{$sinhvien->dia_chi_lien_lac}}"  disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="article-item">
                        <div class="article__heading ml-blue">
                            Thông tin liên lạc và địa chỉ
                        </div>
                        <!-- NAME SEX DOB -->
                        <div class="row mb-2">
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">SỐ ĐIỆN THOẠI</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"  name="dienthoai"
                                        placeholder="Số điện thoại" value="{{$sinhvien->dienthoai}}">
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">SỐ ĐIỆN THOẠI GIA ĐÌNH</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"   name="dienthoaigiadinh"
                                        placeholder="Số điện thoại gia đình" value="{{$sinhvien->dienthoaigiadinh}}">
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">EMAIL</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"  name="email_khac"
                                         value="{{$sinhvien->email_khac}}">
                                </div>
                            </div>
                            <div class="col-lg-3 detail-block">
                                <div class="detail-title ">FACEBOOK</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"  name="facebook"
                                         value="{{$sinhvien->facebook}}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-lg-8 detail-block">
                                <div class="detail-title ">ĐỊA CHỈ TẠM TRÚ</div>
                                <div class="detail-content">
                                    <input type="text" class="form-control"  name="diachitamtru"
                                    value="
                                    @isset($sinhvienTamtru)
                                        {{$sinhvienTamtru->diachi}}
                                    @endisset">
                                </div>
                            </div>
                            <div class="col-lg-4 detail-block">
                                <div class="detail-title">THỜI GIAN</div>
                                <div class="detail-content">
                                    <input type="date" class="form-control"  name="thoigiantamtru"
                                    value="
                                    @isset($sinhvienTamtru)
                                        {{$sinhvienTamtru->thoigian}}
                                    @endisset"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit">
                </form> 
                </div>
            </div>
        </div>
        <!-- IMG BUTTON -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <div class="col-md-8">
                                    <img src="" id="sample_image" />
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="crop" class="btn btn-primary">Cắt và tải lên</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            var $modal = $('#modal');

            var image = document.getElementById('sample_image');

            var cropper;

            var csrf = document.querySelector('meta[name="csrf-token"]').content;

            $('#upload_image').change(function (event) {
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

            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 3,
                    preview: '.preview'
                });
            }).on('hidden.bs.modal', function () {
                cropper.destroy();
                cropper = null;
            });

            $('#crop').click(function () {
                canvas = cropper.getCroppedCanvas({
                    width: 400,
                    height: 400
                });

                canvas.toBlob(function (blob) {
                    url = URL.createObjectURL(blob);
                    var reader = new FileReader();
                    reader.readAsDataURL(blob);
                    reader.onloadend = function () {
                        var base64data = reader.result;
                        $.ajax({
                            url: '{{route('upload')}}',
                            method: 'POST',
                            data: { image: base64data, _token: csrf },
                            success: function (data) {
                                $modal.modal('hide');
                                $('#uploaded_image').attr('src', data);
                                $('#avatar').val(data);
                            }
                        });
                    };
                });
            });

        });
    </script>

</body>

</html>