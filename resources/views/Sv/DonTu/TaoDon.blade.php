@extends('layout.sv_layout')
@section('body')
    <style>
        .block-container {
            background-color: #fff;
            padding: 24px;
        }
        img.img-responsive {
            display: block;
            width: 100%;
            height: auto;
        }
        .content-body {

        }
        .row{
            margin-top:40px;
            padding: 0 10px;
        }

        .clickable{
            cursor: pointer;
        }

        .panel-heading span {
            margin-top: -20px;
            font-size: 15px;
        }
        .panel-heading {
            background-color: #337ab7 !important;
        }
        .mb-3 {
            margin-bottom: 8px;
        }
        .mb-6 {
            margin-bottom: 16px !important;
        }
        /* Styles for wrapping the search box */

        .main {
            width: 50%;
            margin: 50px auto;
        }

        /* Bootstrap 3 text input with search icon */

        .has-search .form-control-feedback {
            right: initial;
            left: 0;
            color: #ccc;
        }

        .has-search .form-control {
            padding-right: 12px;
            padding-left: 34px;
        }
        #search-input {
            border-radius: 8px;
        }
    </style>
    <div class="col-md-12 col-xl-12 col-xs-12" style="margin-bottom: 100px">
        <div class="row">
            <div class="col-xs-12 col-md-4 col-xl-4 mb-3">
                <div class="block-container">
                    <img src="{{asset('motcua.jpg')}}" class="img-responsive"/>
                    <div class="content-body">
                        <div class="title">
                            <h4>Thủ tục một cửa VKU</h4>
                            <h5>KHÔNG XẾP HÀNG, THỦ TỤC NHANH CHÓNG, TRA CỨU DỄ DÀNG</h5>
                            <p>
                                Dùng Kênh THỦ TỤC MỘT CỬA trực tuyến là cách nhanh và đơn giản nhất để tìm câu trả lời cũng như kết nối với đội ngũ hỗ trợ. Sinh viên có thể tìm câu trả lời cho các vấn đề thường gặp; gửi câu hỏi đến VHUB; đặt lịch hẹn với VHUB hoặc các thủ tục hỗ trợ khác.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 col-xl-8">
                <div class="block-container">
                    <div class="block-header">
                        <div class="block-header-title">
                            <div class="d-flex">
                                <div class="">
                                    <h4><i class="fa fa-file" aria-hidden="true"></i>&nbsp;CÁC THỦ TỤC VKU</h4>
                                    <hr/>
                                </div>
                                <p>Mời bạn chọn loại thủ tục muốn thực hiện tại VKU</p>
                                <div class="mb-6">
                                    <div class="form-group has-feedback has-search">
                                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        <input type="text" id="search-input" class="form-control" placeholder="Tìm mẫu đơn">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Phòng CTSV -->
                    <div class="panel panel-primary mb-3">
                        <div class="panel-heading">
                            <h3 class="panel-title">Phòng công tác sinh viên</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                @php $i = 0; @endphp
                                @forelse($daotao as $item)
                                    @php $i++; @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td><a href="{{route('sv.chitietthutuc', ['maudon_id' => $item->id] )}}">{{ $item->tenmaudon }}</a></td>
                                        <td style="width: 160px" data-toggle="tooltip" data-placement="right" title="Thời gian đơn được xử lý">Thời gian: {{ $item->thoigianxuly }} ngày</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Đơn vị này không có đơn chờ tiếp nhận nào</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Phòng đào tạo -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Phòng đào tạo</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <div class="panel-body table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                @php $i = 0; @endphp
                                @forelse($ctsv as $item)
                                    @php $i++; @endphp
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td><a href="{{route('sv.chitietthutuc', ['maudon_id' => $item->id] )}}">{{ $item->tenmaudon }}</a></td>
                                        <td style="width: 160px" data-toggle="tooltip" data-placement="right" title="Thời gian đơn được xử lý">Thời gian: {{ $item->thoigianxuly }} ngày</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>Đơn vị này không có đơn chờ tiếp nhận nào</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    <div class="col-12 marterial-shadow m-0 p-0">--}}
{{--        <div class="applicant-cover">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12 d-flex text-white align-middle">--}}
{{--                    <img class="img-paper" src="{{asset('images/paper.svg')}}"/>--}}
{{--                    <div class="thongtindon">--}}
{{--                        <h4>Bộ phận một cửa VKU</h4>--}}
{{--                        <p style="font-size: 16px"><b>Bộ phận một cửa</b> của Trường Đại học công nghệ thông tin và truyền thông Việt Hàn là đầu mối tập trung hướng dẫn thủ tục hành chính, tiếp nhận hồ sơ của các cá nhân và tổ chức trong và ngoài trường để chuyển đến các đơn vị chức năng giải quyết; nhận và trả kết quả cho các tập thể, cá nhân.<br>Mời bạn chọn thủ tục của cần thực hiện từ các phòng ban sau</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="applicant-content">--}}
{{--            <h6>Phòng đào tạo</h6>--}}
{{--            @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 8])--}}
{{--            <hr/>--}}
{{--            <h6>Phòng công tác sinh viên</h6>--}}
{{--            @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 7])--}}
{{--            <hr/>--}}
{{--            <h6>Phòng khảo thí</h6>--}}
{{--            <hr/>--}}
{{--            @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 10])--}}
{{--            <h6>Phòng kế hoạch tài chính</h6>--}}
{{--            <hr/>--}}
{{--            @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 9])--}}
{{--            <h6>Đoàn thanh niên</h6>--}}
{{--            @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 2])--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('custom-script')
    <script>
        $(document).on('click', '.panel-heading span.clickable', function(e){
            var $this = $(this);
            if(!$this.hasClass('panel-collapsed')) {
                $this.parents('.panel').find('.panel-body').slideUp();
                $this.addClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
            } else {
                $this.parents('.panel').find('.panel-body').slideDown();
                $this.removeClass('panel-collapsed');
                $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
            }
        })
    </script>
@endsection