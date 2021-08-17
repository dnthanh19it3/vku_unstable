@extends('layout.sv_layout')
@section('body')
<div class="col-12 marterial-shadow m-0 p-0">
    <div class="applicant-cover">
        <div class="row">
            <div class="col-md-12 d-flex text-white align-middle">
                <img class="img-paper" src="{{asset('images/paper.svg')}}"/>
                <div class="thongtindon">
                    <h4>Bộ phận một cửa VKU</h4>
                    <p style="font-size: 16px"><b>Bộ phận một cửa</b> của Trường Đại học công nghệ thông tin và truyền thông Việt Hàn là đầu mối tập trung hướng dẫn thủ tục hành chính, tiếp nhận hồ sơ của các cá nhân và tổ chức trong và ngoài trường để chuyển đến các đơn vị chức năng giải quyết; nhận và trả kết quả cho các tập thể, cá nhân.<br>Mời bạn chọn thủ tục của cần thực hiện từ các phòng ban sau</p>
                </div>
            </div>
        </div>
    </div>
    <div class="applicant-content">
        <h6>Phòng đào tạo</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 1])
        <hr/>
        <h6>Phòng công tác sinh viên</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 2])
        <hr/>
        <h6>Phòng khảo thí</h6>
        <hr/>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 3])
        <h6>Phòng kế hoạch tài chính</h6>
        <hr/>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 4])
        <h6>Đoàn thanh niên</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 5])
        <hr/>
        <h6>Phòng khoa học công nghệ</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 6])
    </div>
</div>
@endsection
