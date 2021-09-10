@extends('layout.sv_layout')
@section('title', 'Xem hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="row">
        <div class="col-md-3">
            <div class="profile_avatar_bl p-4 bg-white">
                <img id="avatar_round" class="avatar_round" src="{{$sinhvien->avatar}}" alt="Avatar" title="Change the avatar"/>
                <h5 class="mt-3">{{$sinhvien->hodem." ".$sinhvien->ten}}</h5>
                <div class="">Mã sinh viên: {{$sinhvien->masv}} Lớp: {{$sinhvien->tenlop}} </div>
                <div class="">Sinh viên ngành {{$sinhvien->tennganh}}</div>
                <div class="mt-3">
                    <btn class="btn btn-sm btn-primary" style="color: #fff" onclick="loadCropModal()"><i
                                class="fa fa-edit m-right-xs mr-1"></i>Chọn ảnh</btn>
                    <a class="btn btn-sm btn-success" style="color: #fff" href="{{route('sv.getlylich')}}"><i
                                class="fa fa-file-export m-right-xs mr-1"></i>Xuất lý lịch</a>
                </div>
            </div>
        </div>
        <form method="post" action="{{route('suahosoStore')}}" class="col-md-9">
            {{csrf_field()}}
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

            <div class="row">
                <div class="col-md-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-canhan-tab" data-toggle="tab" href="#nav-canhan" role="tab" aria-controls="nav-canhan" aria-selected="true">Cá nhân</a>
                            <a class="nav-item nav-link" id="nav-giadinh-tab" data-toggle="tab" href="#nav-giadinh" role="tab" aria-controls="nav-giadinh" aria-selected="false">Gia đình</a>
                            <a class="nav-item nav-link" id="nav-thuongtrudiachi-tab" data-toggle="tab" href="#nav-thuongtrudiachi" role="tab" aria-controls="nav-thuongtrudiachi" aria-selected="false">Thường trú và địa chỉ</a>
                            <a class="nav-item nav-link" id="nav-lienhe-tab" data-toggle="tab" href="#nav-lienhe" role="tab" aria-controls="nav-lienhe" aria-selected="false">Liên hệ</a>
                            <a class="nav-item nav-link" id="nav-timeline-tab" data-toggle="tab" href="#nav-timeline" role="tab" aria-controls="nav-about" aria-selected="false">Timeline</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-canhan" role="tabpanel" aria-labelledby="nav-canhan-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white">
                                    <h6>Thông tin cá nhân</h6>
                                    <hr/>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Họ và tên</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->hodem." ".$sinhvien->ten}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Giới tính</div>
                                            <select type="text" class="form-control rounded" selected="{{$sinhvien->gioitinh}}" disabled>
                                                <option value="0" {{$sinhvien->gioitinh ? "" : "selected"}}>Nữ</option>
                                                <option value="1" {{$sinhvien->gioitinh ? "selected" : ""}}>Nam</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày sinh</div>
                                            <input type="text" class="form-control rounded" value="{{\Carbon\Carbon::parse($sinhvien->ngaysinh)->format("d-m-Y")}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 form-group">
                                            <div class="label">Nơi sinh</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->noisinh}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Dân tộc</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">CMND/CCCD</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày cấp</div>
                                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngaycap}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Nơi cấp</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->noicap}}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Đoàn thể</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->doanthe}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Ngày kết nạp</div>
                                            <input type="date" class="form-control rounded" value="{{$sinhvien->ngayketnap}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Tôn giáo</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->tongiao}}" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-giadinh" role="tabpanel" aria-labelledby="nav-giadinh-tab">
                            <div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="profile_main_block p-4 bg-white">
                                            <h6>Thông tin gia đình</h6>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-6 ">
                                                    <h6 style="border-left: 3px solid #0b7ec4; padding-left: 3px">Cha</h6>
                                                    <div class="form-group">
                                                        <div class="label">Họ tên</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->hotencha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Ngày sinh</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhcha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Dân tộc</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_cha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">CMND/CCCD</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_cha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Nghề nghiệp</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_cha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Nơi ở</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_cha}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Email</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->email_cha}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">SĐT</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_cha}}"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 ">
                                                    <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Mẹ</h6>
                                                    <div class="form-group">
                                                        <div class="label">Họ tên</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->hotenme}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Ngày sinh</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->namsinhme}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Dân tộc</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->dantoc_me}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">CMND/CCCD</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->cmnd_me}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Nghề nghiệp</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->nghenghiep_me}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Nơi ở</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->diachi_me}}" disabled/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">Email</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->email_me}}"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label">SĐT</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->sdt_me}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 mt-3">
                                                    <h6 style="border-left: 3px solid #00a180; padding-left: 3px">Anh chị ruột</h6>
                                                    <div class="form-group">
                                                        <div class="label">Anh chị em</div>
                                                        <input type="text" class="form-control rounded" value="{{$sinhvien->thanhphangiadinh}}" disabled/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-thuongtrudiachi" role="tabpanel" aria-labelledby="nav-thuongtrudiachi-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white mt-3">
                                    <h6>Thường trú và địa chỉ</h6>
                                    <hr/>
                                    <i>Hộ khẩu thường trú</i>
                                    <div class="row">
                                        <div class="col-md-4 form-group">
                                            <div class="label">Thôn tổ</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->thon_to}}" disabled/>
                                            <div class="value">{{$sinhvien->thon_to}}</div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Xã phường</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->xa_phuong}}" disabled/>
                                            <div class="value">{{$sinhvien->xa_phuong}}</div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Quận huyện</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->quan_huyen}}" disabled/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Tỉnh/ Thành phố</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->tinh_thanh}}" disabled/>
                                        </div>
                                    </div>
                                    <i>Địa chỉ liên lạc</i>
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <div class="label">Địa chỉ</div>
                                            <input type="text" class="form-control rounded" value="{{$sinhvien->dia_chi_lien_lac}}" disabled/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-lienhe" role="tabpanel" aria-labelledby="nav-lienhe-tab">
                            <div>
                                <div class="profile_main_block p-4 bg-white mt-3">
                                    <h6>Thông tin liên hệ</h6>
                                    <hr/>
                                    <i>Hộ khẩu thường trú</i>
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
                                            <input type="text" class="form-control rounded" name="dienthoaigiadinh" value="{{$sinhvien->dienthoaigiadinh}}"/>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <div class="label">Email khác</div>
                                            <input type="text" class="form-control rounded" name="facebook" value="{{$sinhvien->facebook}}"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-timeline" role="tabpanel" aria-labelledby="nav-timeline-tab">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12"><button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save mr-1"></i> Lưu thay đổi</button> </div>
            </div>
        </form>
    </div>
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
                    <button type="button" id="mirror-x" value="-1" class="btn btn-primary">Phải chiếu</button>
                    <button type="button" id="crop" class="btn btn-primary">Cắt và tải lên</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ bỏ</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-css')
<style>
    nav > .nav.nav-tabs{

        border: none;
        color:#fff;
        background:#272e38;
        border-radius:0;

    }
    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active
    {
        border: none;
        padding: 18px 25px;
        color:#000;
        font-weight: 500;
        background: #fff;
        border-radius:0;
    }

    nav > div a.nav-item.nav-link.active:after
    {
        content: "";
        position: relative;
        bottom: -60px;
        left: -10%;
        border: 15px solid transparent;
        border-top-color: #26B99A;
    }
    .tab-content{
        /*background: #fdfdfd;*/
        line-height: 25px;
        /*border: 1px solid #ddd;*/
        border-top:5px solid #26b99a;
        border-bottom:5px solid #26b99a;
        padding:30px 25px;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus
    {
        border: none;
        background: #26b99a;
        color:#fff;
        border-radius:0;
        transition:background 0.20s linear;
    }
</style>
<link href="{{ asset('css/cropper.css') }}" rel="stylesheet" />
<link href="{{ asset('css/dropzone.css') }}" rel="stylesheet" />
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
    .modal-lg{
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
</style>
@endsection
@section('custom-script')
    <script src="https://unpkg.com/dropzone"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
        resizeAvatar();
        $(window).resize(()=>{
            resizeAvatar()
        });
        function resizeAvatar(){
            var cw = $('#avatar_round').width();
            $('#avatar_round').css({'height': + cw +'px'});
        }
    </script>
    <script>
        function loadCropModal(){
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
                if ($(this).val() == -1){
                    $(this).val(1);
                } else {
                    $(this).val(-1);
                }
                console.log("Meet this action");
            })
            $modal.on('shown.bs.modal', function () {
                cropper = new Cropper(image, {
                    aspectRatio: 3/4,
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

                        urltoFile(base64data, 'a.png')
                            .then(function(file){
                                console.log(URL.createObjectURL(file));
                                // $('#avatar').files(URL.createObjectURL(file));
                                // $('#avatar').attr('value', URL.createObjectURL(file));
                                $('#avatar_round').attr('src', URL.createObjectURL(file));
                                let avatarDemo = document.getElementById('avatarDemo');
                                let outputFile = new File([file], 'avatar.jpg',{type:"image/jpeg", lastModified:new Date().getTime()});
                                let container = new DataTransfer();
                                container.items.add(outputFile);
                                avatarDemo.files = container.outputFiles;



                            })


                        // $('#encoded_avatar').attr('value', base64data);
                        // $('#avatartext').html("Xem trước");
                        $modal.modal('hide');
                    };
                });
            });

        });
        //return a promise that resolves with a File instance
        function urltoFile(url, filename, mimeType){
            mimeType = mimeType || (url.match(/^data:([^;]+);/)||'')[1];
            return (fetch(url)
                    .then(function(res){return res.arrayBuffer();})
                    .then(function(buf){return new File([buf], filename, {type:mimeType});})
            );
        }

        //Usage example:
        // urltoFile('data:image/png;base64,......', 'a.png')
        //     .then(function(file){
        //         console.log(file);
        //     })
    </script>

@endsection
