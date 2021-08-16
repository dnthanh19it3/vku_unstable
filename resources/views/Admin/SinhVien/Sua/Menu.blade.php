<h5>Hồ sơ lý lịch</h5>
<ul>
    <li class="@if($index == 1) selected @endif "><a href="{{route('ad.suasinhvien.canhan', ['masv' => $sinhvien->masv])}}">Thông tin cá nhân</a></li>
    <li class="@if($index == 2) selected @endif "><a href="{{route('ad.suasinhvien.anh', ['masv' => $sinhvien->masv])}}">Ảnh @isset($sinhvien->avatar_temp) <span class="badge badge-warning">Đang chờ duyệt</span> @endisset</a></li>
    <li class="@if($index == 3) selected @endif "><a href="{{route('ad.suasinhvien.khenthuong', ['masv' => $sinhvien->masv])}}">Khen thưởng</a></li>
    <li class="@if($index == 4) selected @endif "><a href="{{route('ad.suasinhvien.kyluat', ['masv' => $sinhvien->masv])}}">Kỷ luật</a></li>
{{--    <li class="@if($index == 5) selected @endif "><a href="#">Tạm trú</a></li>--}}
</ul>
