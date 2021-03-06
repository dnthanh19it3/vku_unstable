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
    C???NG HO?? X?? H???I CH?? NGH??A VI???T NAM<br />
    ?????c l???p - T??? do - H???nh ph??c<br />
    ???? ???? ????
</div>
<div class="tencv">
    T??? KHAI<br />
    L?? L???CH TR??CH NGANG SINH VI??N
</div>
<div class="ngaythang" style="display: block; position: relative;">
    ???? N???ng, ng??y {{\Carbon\Carbon::now()->format('d')}} th??ng {{\Carbon\Carbon::now()->format('m')}} n??m {{\Carbon\Carbon::now()->format('Y')}}
    <div class="anhhoso">
        @if($sinhvien->anhthe)
            <img style="width: 100%;" src="{{ $sinhvien->anhthe }}"/>
        @else
            ???nh 3x4
        @endif
    </div>
</div>
<br />&nbsp;
<div class="heading">
    I. PH???N TH??NG TIN SINH VI??N
</div>
<div style="width: 100%;">
    <div class="line">
        <div class="col f-12" style="width: 45%;">H??? v?? t??n: {{ $sinhvien->hodem . " " . $sinhvien->ten }}</div>
        <div class="col f-12" style="width:30%">Gi???i t??nh: {{ $sinhvien->gioitinh ? "N???" : "Nam"}}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 40%;">Ng??y, th??ng, n??m sinh: {{$sinhvien->ngaysinh ? \Carbon\Carbon::make($sinhvien->ngaysinh)->format('d-m-Y') : "N/A"}}</div>
        <div class="col f-12" style="width:20%">D??n t???c: {{ $sinhvien_chitiet->dantoc }}</div>
        <div class="col f-12" style="width:30%">T??n gi??o: {{ $sinhvien_chitiet->tongiao }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">L???p: {{ $sinhvien->tenlop }}</div>
        <div class="col f-12" style="width:30%">M?? sinh vi??n: {{ $sinhvien->masv }}</div>
        <div class="col f-12" style="width:30%">Ng??nh: {{ $sinhvien->tenNganh }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">N??i sinh: {{ $sinhvien_chitiet->noisinh }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 35%;">S??? CMND/CCCD: {{ $sinhvien_chitiet->cmnd }}</div>
        <div class="col f-12" style="width:27%">Ng??y c???p: {{ $sinhvien_chitiet->ngaycap }}</div>
        <div class="col f-12" style="width:27%">N??i c???p: {{ $sinhvien_chitiet->noicap }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 60%">H??? kh???u th?????ng tr??: S??? nh??/???????ng: </div>
        <div class="col f-12" style="width: 35%">Th??n/T???: {{ $sinhvien_chitiet->thon_to }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 32%;">X?? ph?????ng: {{ $sinhvien_chitiet->xa_phuong }}</div>
        <div class="col f-12" style="width:32%">Qu???n huy???n: {{ $sinhvien_chitiet->quan_huyen }}</div>
        <div class="col f-12" style="width:32%">T???nh/TP: {{ $sinhvien_chitiet->tinh_thanh }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 47%;">H???c t???i tr?????ng THPT: </div>
        <div class="col f-12" style="width:25%">M?? tr?????ng: </div>
        <div class="col f-12" style="width:25%">N??m t???t nghi???p: </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 57%;">Khu v???c tuy???n sinh (KV1, KV2NT, KV2, KV3): </div>
        <div class="col f-12" style="width:40%">?????i t?????ng (t??? 01 ?????n 07): </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Thu???c di???n ch??nh s??ch (con li???t s??/th????ng, b???nh binh, cha m??? b???
            TNL??, m??? c??i cha m???, h??? ngh??o, c???n ngh??o): </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">M?? s??? b???o hi???m y t??? (ghi r?? c??? ph???n ch??? v?? s???): {{ $sinhvien_chitiet->ma_bhyt }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 56%;">L?? ??o??n vi??n/?????ng vi??n: {{ $sinhvien_chitiet->doanthe }}</div>
        <div class="col f-12" style="width:40%">Th???i gian k???t n???p: {{ $sinhvien_chitiet->ngayketnap ? \Carbon\Carbon::make($sinhvien_chitiet->ngayketnap)->format('d-m-Y') : "N/A" }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Nh???p h???c theo h??nh th???c x??t tuy???n (x??t k???t qu??? h???c t???p, tuy???n sinh
            ri??ng, k???t qu??? thi THPT):</div>
    </div>
</div>
<div class="heading">II. PH???N TH??NG TIN GIA ????NH SINH VI??N</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">H??? v?? t??n Cha: {{ $sinhvien_chitiet->hotencha }}</div>
        <div class="col f-12" style="width:42%">Ng??y sinh cha: {{ $sinhvien_chitiet->namsinhcha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">D??n t???c: {{ $sinhvien_chitiet->dantoc_cha }}</div>
        <div class="col f-12" style="width: 28%;">Ngh??? nghi???p: {{ $sinhvien_chitiet->nghenghiep_cha }}</div>
        <div class="col f-12" style="width:48%">S??? CMND/CCCD: {{ $sinhvien_chitiet->cmnd_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">N??i ???: {{ $sinhvien_chitiet->diachi_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (n???u c??): {{ $sinhvien_chitiet->email_cha }}</div>
        <div class="col f-12" style="width:48%">S??? ??i???n tho???i: {{ $sinhvien_chitiet->sdt_cha }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">H??? v?? t??n M???: {{ $sinhvien_chitiet->hotenme }}</div>
        <div class="col f-12" style="width:42%">Ng??y sinh M???: {{ $sinhvien_chitiet->namsinhme }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 20%;">D??n t???c: {{ $sinhvien_chitiet->dantoc_me}}</div>
        <div class="col f-12" style="width: 28%;">Ngh??? nghi???p: {{ $sinhvien_chitiet->nghenghiep_me }}</div>
        <div class="col f-12" style="width:48%">S??? CMND/CCCD: {{ $sinhvien_chitiet->cmnd_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">N??i ???: {{ $sinhvien_chitiet->diachi_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 48%;">Email (n???u c??): {{ $sinhvien_chitiet->email_me }}</div>
        <div class="col f-12" style="width:48%">S??? ??i???n tho???i: {{ $sinhvien_chitiet->sdt_me }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;">Th??nh ph???n gia ????nh g???m nh???ng ai (ghi r?? h??? t??n c???a anh/ch???/em,
            ...): @if(is_array($sinhvien_chitiet->thanhphangiadinh)) @forelse($sinhvien_chitiet->thanhphangiadinh as $value) {{$value}}, @empty @endforelse @endif
        </div>
    </div>
</div>
<div class="heading">III. PH???N LI??N L???C V???I SINH VI??N:</div>
<div class="">
    <div class="line">
        <div class="col f-12" style="width: 55%;">S??? ??i???n tho???i: {{ $sinhvien_chitiet->dienthoai }}</div>
        <div class="col f-12" style="width:42%">Email: {{ $sinhvien_chitiet->email_khac }}</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 98%;"> ?????a ch??? li??n l???c khi c???n: ph???i ghi c??? th???, ch??nh x??c, n???u ??? tr???
            th?? ghi ?????a ch??? nh?? tr???, n???u ??? nh?? th?? ghi ?????a ch??? nh??: @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->sonha . ", " . $sinhvien_tamtru->thonto .", ".$sinhvien_tamtru->xaphuong." ".$sinhvien_tamtru->quanhuyen. " " . $sinhvien_tamtru->tinhthanh}} @endif</div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">H??? t??n ng?????i nh???n: {{ $sinhvien->hodem . " " .$sinhvien->ten }}</div>
        <div class="col f-12" style="width:42%">S??? ??i???n tho???i: {{$sinhvien_chitiet->dienthoai}} </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 55%;">Th??n (t??? d??n ph???, s??? nh??): @if($sinhvien_tamtru != null){{$sinhvien_tamtru->thonto}}  @endif </div>
        <div class="col f-12" style="width:42%">X?? (ph?????ng, ???????ng): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->xaphuong}} @endif  </div>
    </div>
    <div class="line">
        <div class="col f-12" style="width: 53%;">Huy???n (qu???n): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->quanhuyen}} @endif </div>
        <div class="col f-12" style="width:42%">T???nh (th??nh ph???): @if($sinhvien_tamtru != null) {{$sinhvien_tamtru->tinhthanh}} @endif </div>
    </div>
    <div class="" style="">
        <div class="col f-12" style="width: 98%;"> T??i xin cam ??oan nh???ng th??ng tin ???? k?? khai tr??n l?? ????ng s??? th???t
            v?? xin ch???u ho??n to??n tr??ch nhi???m. </div>
    </div>
    <div class="">
        <div class="col f-12" style="width: 55%;"></div>
        <div class="col f-12" style="width:42%;text-align: center;"><b>NG?????I KHAI</b><br />
            <i>(k??, ghi r?? h??? t??n)</i>
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