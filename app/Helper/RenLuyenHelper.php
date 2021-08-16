<?php
    use Illuminate\Support\Facades\DB;
    
    function xepLoai($diem){
        if($diem >= 90){
            return "Xuất sắc";
        } elseif($diem <90 && $diem >=80) {
            return "Tốt";
        } elseif($diem <80 && $diem >=70) {
            return "Khá";
        } elseif($diem <70 && $diem >=60) {
            return "Trung bình";
        } elseif($diem <60 && $diem >=50) {
            return "Yếu";
        } elseif($diem <50) {
            return "Kém";
        }
    }