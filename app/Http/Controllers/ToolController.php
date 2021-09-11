<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolController extends Controller
{
    function get_http_response_code($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
    function  crawlAvatar(){

        dd("HIHI");
        $s = 0;
        $e = 0;
        $listStudent = DB::table('table_sinhvien')->get();
        foreach ($listStudent as $student){
            $url = "http://daotao.vku.udn.vn/uploads/sinhvien/$student->masv.jpg";
            $img = "D:/crawl/avatar/$student->masv.jpg";


            if($this->get_http_response_code($url) != "200"){
                echo "error";
            }else{
                $content = file_get_contents($url);
                $save = file_put_contents($img, $content);
                if($save){
                    echo ($s+=1)."/".count($listStudent);
                    DB::table('table_sinhvien_chitiet')->where('masv', $student->masv)->update(['avatar' => "AnhHoSo/$student->masv.jpg"]);
                } else {
                    $e++;
                    echo "$student->masv get fail";
                }

            }
            echo "<hr/>";
        }

        echo "<hr/>Thành công $s, thất bại $e";
    }
}
