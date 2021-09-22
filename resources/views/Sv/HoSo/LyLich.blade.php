<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @page {
            /* margin-top: 0.98in; */
            margin-top: 0.44in;
            margin-bottom: 0.43in;
            margin-left: 1.1in;
            margin-right: 0.78in;
            overflow-x: visible;
        }

        @media screen {
            div.divHeader {
                display: none;
            }
        }


        /* @page :left {
        margin: 0.5cm;
        } */

        /* @page :right {
        margin: 0.8cm;
        } */

        @media print {
            div.divHeader {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            div.divHeader img {
                height: 52px;
                width: auto;
                margin-bottom: 16px;
            }

        }


        /* 1.1 0.98 0.78 0.43 */

        body {
            width: 100%;
            line-height: 21px;
            overflow-x: visible;
        }


        .conghoa {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }

        .tencv {
            font-size: 21px;
            font-weight: bold;
            text-align: center;
        }

        .heading {
            margin-left: 24px;
            font-size: 17.333333333333332px;
            font-weight: bold;
            text-decoration: underline;
        }

        .ngaythang {
            font-size: 16px;
            text-align: right;
            font-style: italic;
            visibility: visible;
        }

        .f-12 {
            font-size: 16px;
        }

        .line {
            width: 100%;
        }

        .line::before {
            content: "-";
        }

        .col {
            display: inline-block;
        }

        .anhhoso {
            right: -42px;
            top: 32px;
            width: 113.38582677px;
            height: 151.18110236px;
            border: 1px solid black;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            visibility: visible;
            clear: both;
        }

        .anhhoso img {
            width: 100%;
            height: 100%;
            visibility: visible;
        }
    </style>
</head>

<header>
    <div class="divHeader">
        <img src="{{asset('header_vku.png')}}" />
    </div>
</header>

<body>
<div class="conghoa">
    CỘNG HOÀ XÃ HỘI CHŨ NGHĨA VIỆT NAM<br />
    Độc lập - Tự do - Hạnh phúc<br />
    🙥 🕮 🙧
</div>
<div class="tencv">
    TỜ KHAI<br />
    LÝ LỊCH TRÍCH NGANG SINH VIÊN
</div>
<div class="ngaythang" style="display: block; position: relative;">
    Đà Nẵng, ngày {{\Carbon\Carbon::now()->format('d')}} tháng {{\Carbon\Carbon::now()->format('m')}} năm {{\Carbon\Carbon::now()->format('Y')}}
    <div class="anhhoso">
        Ảnh 3x4
        <!-- <img style="width: 100%;" src="D:\Project\myvku-stable\public\AnhHoSo\19IT195_1623580837.png" /> -->
    </div>
</div>
<br />&nbsp;
<div class="heading">
    I. PHẦN THÔNG TIN SINH VIÊN
</div>
<div style="width: 100%;">
    <div class="line">
        <div class="col f-12" style="width: 45%;">Họ và tên: {{getTruongTinh('hoten', $sv)}}</div>
        <div class="col f-12" style="width:30%">Giới tính: {{ $sv->gioitinh ? 'Nam' : 'Nữ' }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 40%;">Ngày, tháng, năm sinh: {{getTruongTinh('ngaysinh', $sv)}}</div>
        <div class="col f-12" style="width:20%">Dân tộc: {{getTruongTinh('dantoc', $sv)}}</div>
        <div class="col f-12" style="width:30%">Tôn giáo: {{getTruongTinh('tongiao', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Lớp: {{getTruongTinh('tenlop', $sv)}}</div>
        <div class="col f-12" style="width:30%">Mã sinh viên: {{getTruongTinh('masv', $sv)}}</div>
        <div class="col f-12" style="width:30%">Ngành: {{getTruongTinh('tennganh', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi sinh: {{getTruongTinh('noisinh', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 35%;">Số CMND/CCCD: {{getTruongTinh('cmnd', $sv)}}</div>
        <div class="col f-12" style="width:27%">Ngày cấp: {{getTruongTinh('ngaycap', $sv)}}</div>
        <div class="col f-12" style="width:27%">Nơi cấp: {{getTruongTinh('noicap', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 60%">Hộ khẩu thường trú: Số nhà/đường: </div>
        <div class="col f-12" style="width: 35%">Thôn/Tổ: {{getTruongTinh('thon_to', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 32%;">Xã phường: {{getTruongTinh('xa_phuong', $sv)}}</div>
        <div class="col f-12" style="width:32%">Quận huyện: {{getTruongTinh('quan_huyen', $sv)}}</div>
        <div class="col f-12" style="width:32%">Tỉnh/TP: {{getTruongTinh('tinh_thanh', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 47%;">Học tại trường THPT: </div>
        <div class="col f-12" style="width:25%">Mã trường: </div>
        <div class="col f-12" style="width:25%">Năm tốt nghiệp: </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 57%;">Khu vực tuyển sinh (KV1, KV2NT, KV2, KV3): </div>
        <div class="col f-12" style="width:40%">Đối tượng (từ 01 đến 07): </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Thuộc diện chính sách (con liệt sĩ/thương, bệnh binh, cha mẹ bị
            TNLĐ, mồ côi cha mẹ, hộ nghèo, cận nghèo): </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Mã số bảo hiểm y tế (ghi rõ cả phần chữ và số): {{getTruongTinh('ma_bhyt', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 56%;">Là Đoàn viên/Đảng viên: {{getTruongTinh('doanthe', $sv)}}</div>
        <div class="col f-12" style="width:40%">Thời gian kết nạp: {{getTruongTinh('ngayketnap', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nhập học theo hình thức xét tuyển (xét kết quả học tập, tuyển sinh
            riêng, kết quả thi THPT):</div>
    </div>
</div>
<div class="heading">II. PHẦN THÔNG TIN GIA ĐÌNH SINH VIÊN</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Cha {{getTruongTinh('hotencha', $sv)}}:</div>
        <div class="col f-12" style="width:42%">Ngày sinh cha: {{getTruongTinh('namsinhcha', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{getTruongTinh('dantoc_cha', $sv)}}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{getTruongTinh('nghenghiep_cha', $sv)}}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{getTruongTinh('cmnd_cha', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{getTruongTinh('diachi_cha', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{getTruongTinh('email_cha', $sv)}}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{getTruongTinh('sdt_cha', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Mẹ: {{getTruongTinh('hotenme', $sv)}}</div>
        <div class="col f-12" style="width:42%">Ngày sinh Mẹ: {{getTruongTinh('namsinhme', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{getTruongTinh('dantoc_me', $sv)}}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{getTruongTinh('nghenghiep_me', $sv)}}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{getTruongTinh('cmnd_me', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{getTruongTinh('diachi_me', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{getTruongTinh('email_me', $sv)}}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{getTruongTinh('sdt_me', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">* Thành phần gia đình gồm những ai (ghi rõ họ tên của anh/chị/em,
            ...): {{getTruongTinh('thanhphangiadinh', $sv)}}</div>
    </div>
</div>
<div class="heading">III. PHẦN LIÊN LẠC VỚI SINH VIÊN:</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Số điện thoại: {{getTruongTinh('dienthoai', $sv)}}</div>
        <div class="col f-12" style="width:42%">Email: {{getTruongTinh('email_khac', $sv)}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;"> Địa chỉ liên lạc khi cần: phải ghi cụ thể, chính xác, nếu ở trọ
            thì ghi địa chỉ nhà trọ, nếu ở nhà thì ghi địa chỉ nhà: @if($tamtru != null) {{$tamtru->sonha . ", " . $tamtru->thonto .", ".$tamtru->xaphuong." ".$tamtru->quanhuyen. " " . $tamtru->tinhthanh}} @endif</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ tên người nhận: {{getTruongTinh('hoten', $sv)}}</div>
        <div class="col f-12" style="width:42%">Số điện thoại:@if($tamtru != null) {{getTruongTinh('dienthoai', $sv)}} @endif </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Thôn (tổ dân phố, số nhà): @if($tamtru != null){{$tamtru->thonto}}  @endif </div>
        <div class="col f-12" style="width:42%">Xã (phường, đường): @if($tamtru != null) {{$tamtru->xaphuong}} @endif  </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 53%;">Huyện (quận): @if($tamtru != null) {{$tamtru->quanhuyen}} @endif </div>
        <div class="col f-12" style="width:42%">Tỉnh (thành phố): @if($tamtru != null) {{$tamtru->tinhthanh}} @endif </div>
    </div>
    <div class="" style="">
        <div class="col f-12" style="width: 98%;"> Tôi xin cam đoan những thông tin đã kê khai trên là đúng sự thật
            và xin chịu hoàn toàn trách nhiệm. </div>
    </div>
    <div class="">
        <div class="col f-12" style="width: 55%;"></div>
        <div class="col f-12" style="width:42%;text-align: center;"><b>NGƯỜI KHAI</b><br />
            <i>(ký, ghi rõ họ tên)</i>
        </div>
    </div>
</div>
<script>
    window.print();
</script>
</body>