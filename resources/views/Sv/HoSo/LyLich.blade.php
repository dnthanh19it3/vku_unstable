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
        <div class="col f-12" style="width: 45%;">Họ và tên: {{$sv->hodem . ' ' . $sv->ten}}</div>
        <div class="col f-12" style="width:30%">Giới tính: {{ $sv->gioitinh ? 'Nam' : 'Nữ' }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 40%;">Ngày, tháng, năm sinh: {{\Carbon\Carbon::make($sv->ngaysinh)->format('d/m/Y')}}</div>
        <div class="col f-12" style="width:20%">Dân tộc: {{$sv->dantoc}}</div>
        <div class="col f-12" style="width:30%">Tôn giáo: {{$sv->tongiao}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Lớp: {{$sv->tenlop}}</div>
        <div class="col f-12" style="width:30%">Mã sinh viên: {{$sv->masv}}</div>
        <div class="col f-12" style="width:30%">Ngành: {{$sv->tennganh}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi sinh: {{$sv->noisinh}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 35%;">Số CMND/CCCD: {{$sv->cmnd}}</div>
        <div class="col f-12" style="width:27%">Ngày cấp: {{$sv->ngaycap}}</div>
        <div class="col f-12" style="width:27%">Nơi cấp: {{$sv->noicap}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 60%">Hộ khẩu thường trú: Số nhà/đường: </div>
        <div class="col f-12" style="width: 35%">Thôn/Tổ: {{$sv->thon_to}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 32%;">Xã phường: {{$sv->xa_phuong}}</div>
        <div class="col f-12" style="width:32%">Quận huyện: {{$sv->quan_huyen}}</div>
        <div class="col f-12" style="width:32%">Tỉnh/TP: {{$sv->tinh_thanh}}</div>
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
        <div class="col f-12" style="width: 98%;">Mã số bảo hiểm y tế (ghi rõ cả phần chữ và số): {{$sv->ma_bhyt}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 56%;">Là Đoàn viên/Đảng viên: {{$sv->doanthe}}</div>
        <div class="col f-12" style="width:40%">Thời gian kết nạp: {{$sv->ngayketnap}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nhập học theo hình thức xét tuyển (xét kết quả học tập, tuyển sinh
            riêng, kết quả thi THPT):</div>
    </div>
</div>
<div class="heading">II. PHẦN THÔNG TIN GIA ĐÌNH SINH VIÊN</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Cha {{$sv->hotencha}}:</div>
        <div class="col f-12" style="width:42%">Ngày sinh cha: {{$sv->namsinhcha}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{$sv->dantoc_cha}}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{$sv->nghenghiep_cha}}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{$sv->cmnd_cha}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{$sv->diachi_cha}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{$sv->email_cha}}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{$sv->sdt_cha}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Mẹ: {{$sv->hotenme}}</div>
        <div class="col f-12" style="width:42%">Ngày sinh Mẹ: {{$sv->namsinhme}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{$sv->dantoc_me}}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{$sv->nghenghiep_me}}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{$sv->cmnd_me}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{$sv->diachi_me}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{$sv->email_me}}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{$sv->sdt_me}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">* Thành phần gia đình gồm những ai (ghi rõ họ tên của anh/chị/em,
            ...): {{$sv->thanhphangiadinh}}</div>
    </div>
</div>
<div class="heading">III. PHẦN LIÊN LẠC VỚI SINH VIÊN:</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Số điện thoại: {{$sv->dienthoai}}</div>
        <div class="col f-12" style="width:42%">Email: {{$sv->email_khac}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;"> Địa chỉ liên lạc khi cần: phải ghi cụ thể, chính xác, nếu ở trọ
            thì ghi địa chỉ nhà trọ, nếu ở nhà thì ghi địa chỉ nhà: @if($tamtru != null) {{$tamtru->sonha . ", " . $tamtru->thonto .", ".$tamtru->xaphuong." ".$tamtru->quanhuyen. " " . $tamtru->tinhthanh}} @endif</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ tên người nhận: {{$sv->hodem . ' ' . $sv->ten}}</div>
        <div class="col f-12" style="width:42%">Số điện thoại:@if($tamtru != null) {{$sv->dienthoai}} @endif </div>
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