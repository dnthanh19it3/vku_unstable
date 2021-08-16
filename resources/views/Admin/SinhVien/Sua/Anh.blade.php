@extends('layout.admin_layout')
@section('title', 'Sửa hồ sơ')
@section('header')
@endsection
@section('body')
    <div class="col-md-12">
        <div class="row bg-white">
            <div class="col-md-3 profile-leftpanel pr-md-3 border-right">
                @include('Admin.SinhVien.Sua.Menu',  ["index" => 2])
            </div>
            <div class="col-md-9 profile-mainpanel">
                <h5>Ảnh hồ sơ</h5>
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
                <h6 class="mt-3">Ảnh đã duyệt</h6>
                <hr/>
                <div class="row">
                    @forelse($anhdatailen as $item)
                        <div class="col-md-3">
                            <div class="anhhoso-container">
                                <img style="width: 100%;height: auto" src="{{asset($item->duongdan)}}"/>
                                <div
                                    class="anhoso-badge">{{Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:m')}}</div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">Chưa có ảnh đã tải lên!</div>
                    @endforelse
                </div>
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

@endsection
