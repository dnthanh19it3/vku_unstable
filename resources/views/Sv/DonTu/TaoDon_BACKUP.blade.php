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
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 8])
        <hr/>
        <h6>Phòng công tác sinh viên</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 7])
        <hr/>
        <h6>Phòng khảo thí</h6>
        <hr/>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 10])
        <h6>Phòng kế hoạch tài chính</h6>
        <hr/>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 9])
        <h6>Đoàn thanh niên</h6>
        @include('Sv.DonTu.ShowList', ['list' => $danhsachdon, 'donvi' => 2])
    </div>
</div>


    <div class="row mt-3 mb-3">
        <div class="col-12 bg-white don_block">
            <div class="row row-eq-height don_item">
                <div class="col-md-6 left_content">
                    <div class="content_wrapper">
                       <div class="content_text">
                           <b>Giấy xác nhận sinh viên (để vay vốn Ngân hàng)</b>
                       </div>
                    </div>
                </div>
                <div class="col-md-6 right_content">
                    <div class="content_wrapper">
                       <div class="content_text">
                           Giấy xác nhận vay vốn sinh viên là mẫu giấy xác nhận dành cho sinh viên Khoa Công nghệ Thông tin & Truyền thông khi muốn tham gia vay vốn, thực hiện đúng thủ tục và trình tự, giúp hỗ trợ tài chính sinh viên và gia đình giải quyết, giảm nhẹ các khó khăn về tài chính cho sinh viên
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
