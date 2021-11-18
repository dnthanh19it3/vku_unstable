<?php

namespace App\Http\Controllers;

class Regex extends Controller
{
    function get_http_response_code($url)
    {
        $chitiet_raw = [];
        $temp = [
            "ngaytuyendung" => $tuyendung_hopdong_raw['ngaytuyendung'],
              "ngaybnngach" => $tuyendung_hopdong_raw['ngaybnngach'],
              "loaicanbo_id" => $tuyendung_hopdong_raw['loaicanbo_id'],
              "ngayky" => $tuyendung_hopdong_raw['ngayky'],
              "tungay" => $tuyendung_hopdong_raw['tungay'],
              "denngay" => $tuyendung_hopdong_raw['denngay'],
              "vieckhituyendung_id" => $tuyendung_hopdong_raw['vieckhituyendung_id'],
              "dvsh" => $tuyendung_hopdong_raw['dvsh'],
              "nghi_baohiemxahoi_id" => $tuyendung_hopdong_raw['nghi_baohiemxahoi_id'],
              "file" => $tuyendung_hopdong_raw['file'],
              "sobhxh" => $tuyendung_hopdong_raw['sobhxh'],
              "lienketscv" => $tuyendung_hopdong_raw['lienketscv'],
        ];
    }
}
