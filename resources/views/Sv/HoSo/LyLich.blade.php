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
            right: 20px;
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
            /*margin-left: -92px;*/
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
        @if($sinhvien->anhthe)
            <img style="width: 100%;" src="{{ $sinhvien->anhthe }}"/>
        @else
            Ảnh 3x4
        @endif
    </div>
</div>
<br />&nbsp;
<div class="heading">
    I. PHẦN THÔNG TIN SINH VIÊN
</div>
<div style="width: 100%;">
    <div class="line">
        <div class="col f-12" style="width: 45%;">Họ và tên: {{ $sinhvien->hodem . " " . $sinhvien->ten }}</div>
        <div class="col f-12" style="width:30%">Giới tính: {{ $sinhvien->gioitinh ? "Nữ" : "Nam"}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 40%;">Ngày, tháng, năm sinh: {{$sinhvien->ngaysinh ? \Carbon\Carbon::make($sinhvien->ngaysinh)->format('d-m-Y') : "N/A"}}</div>
        <div class="col f-12" style="width:20%">Dân tộc: {{ $sinhvien_chitiet->dantoc }}</div>
        <div class="col f-12" style="width:30%">Tôn giáo: {{ $sinhvien_chitiet->tongiao }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Lớp: {{ $sinhvien->tenlop }}</div>
        <div class="col f-12" style="width:30%">Mã sinh viên: {{ $sinhvien->masv }}</div>
        <div class="col f-12" style="width:30%">Ngành: {{ $sinhvien->tenNganh }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi sinh: {{ $sinhvien_chitiet->noisinh }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 35%;">Số CMND/CCCD: {{ $sinhvien_chitiet->cmnd }}</div>
        <div class="col f-12" style="width:27%">Ngày cấp: {{ $sinhvien_chitiet->ngaycap }}</div>
        <div class="col f-12" style="width:27%">Nơi cấp: {{ $sinhvien_chitiet->noicap }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 60%">Hộ khẩu thường trú: Số nhà/đường: </div>
        <div class="col f-12" style="width: 35%">Thôn/Tổ: {{ $sinhvien_chitiet->thon_to }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 32%;">Xã phường: {{ $sinhvien_chitiet->xa_phuong }}</div>
        <div class="col f-12" style="width:32%">Quận huyện: {{ $sinhvien_chitiet->quan_huyen }}</div>
        <div class="col f-12" style="width:32%">Tỉnh/TP: {{ $sinhvien_chitiet->tinh_thanh }}</div>
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
        <div class="col f-12" style="width: 98%;">Mã số bảo hiểm y tế (ghi rõ cả phần chữ và số): {{ $sinhvien_chitiet->ma_bhyt }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 56%;">Là Đoàn viên/Đảng viên: {{ $sinhvien_chitiet->doanthe }}</div>
        <div class="col f-12" style="width:40%">Thời gian kết nạp: {{ $sinhvien_chitiet->ngayketnap ? \Carbon\Carbon::make($sinhvien_chitiet->ngayketnap)->format('d-m-Y') : "N/A" }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nhập học theo hình thức xét tuyển (xét kết quả học tập, tuyển sinh
            riêng, kết quả thi THPT):</div>
    </div>
</div>
<div class="heading">II. PHẦN THÔNG TIN GIA ĐÌNH SINH VIÊN</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Cha: {{ $sinhvien_chitiet->hotencha }}</div>
        <div class="col f-12" style="width:42%">Ngày sinh cha: {{ $sinhvien_chitiet->namsinhcha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{ $sinhvien_chitiet->dantoc_cha }}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{ $sinhvien_chitiet->nghenghiep_cha }}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{ $sinhvien_chitiet->cmnd_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{ $sinhvien_chitiet->diachi_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{ $sinhvien_chitiet->email_cha }}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{ $sinhvien_chitiet->sdt_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ và tên Mẹ: {{ $sinhvien_chitiet->hotenme }}</div>
        <div class="col f-12" style="width:42%">Ngày sinh Mẹ: {{ $sinhvien_chitiet->namsinhme }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">Dân tộc: {{ $sinhvien_chitiet->dantoc_me}}</div>
        <div class="col f-12" style="width: 28%;">Nghề nghiệp: {{ $sinhvien_chitiet->nghenghiep_me }}</div>
        <div class="col f-12" style="width:48%">Số CMND/CCCD: {{ $sinhvien_chitiet->cmnd_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nơi ở: {{ $sinhvien_chitiet->diachi_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (nếu có): {{ $sinhvien_chitiet->email_me }}</div>
        <div class="col f-12" style="width:48%">Số điện thoại: {{ $sinhvien_chitiet->sdt_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Thành phần gia đình gồm những ai (ghi rõ họ tên của anh/chị/em,
            ...): @if(is_array($sinhvien_chitiet->thanhphangiadinh)) @forelse($sinhvien_chitiet->thanhphangiadinh as $value) {{$value}}, @empty @endforelse @endif
        </div>
    </div>
</div>
<div class="heading">III. PHẦN LIÊN LẠC VỚI SINH VIÊN:</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">Số điện thoại: {{ $sinhvien_chitiet->dienthoai }}</div>
        <div class="col f-12" style="width:42%">Email: {{ $sinhvien_chitiet->email_khac }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;"> Địa chỉ liên lạc khi cần: phải ghi cụ thể, chính xác, nếu ở trọ
            thì ghi địa chỉ nhà trọ, nếu ở nhà thì ghi địa chỉ nhà: @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->sonha . ", " . $sinhvien_tamtru->thonto .", ".$sinhvien_tamtru->xaphuong." ".$sinhvien_tamtru->quanhuyen. " " . $sinhvien_tamtru->tinhthanh}} @endif</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Họ tên người nhận: {{ $sinhvien->hodem . " " .$sinhvien->ten }}</div>
        <div class="col f-12" style="width:42%">Số điện thoại: {{$sinhvien_chitiet->dienthoai}} </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Thôn (tổ dân phố, số nhà): @if($sinhvien_tamtru != null){{$sinhvien_tamtru->thonto}}  @endif </div>
        <div class="col f-12" style="width:42%">Xã (phường, đường): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->xaphuong}} @endif  </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 53%;">Huyện (quận): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->quanhuyen}} @endif </div>
        <div class="col f-12" style="width:42%">Tỉnh (thành phố): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->tinhthanh}} @endif </div>
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
    <div class="">
        <div class="col f-12" style="width: 55%;"></div>
        <div class="col f-12" style="width:42%;text-align: center;">
            <br/><br/><br/><br/>
            {{ $sinhvien->hodem . " " . $sinhvien->ten }}
        </div>
    </div>
</div>
<script>
    window.print();
</script>
</body>