<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdSuKienController extends Controller
{
    function suKienIndex(){
        return view('Admin.SuKien.DanhSachSuKien');
    }
    function taoSuKienView(){
        $khoa = DB::table('table_lopsh')->distinct()->get('khoaK');
        $lopsh = DB::table('table_lopsh')->get();

        foreach ($khoa as $key1 => $item1){
            $lop = array();
            foreach ($lopsh as $key2 => $item2){
                if($item2->khoaK == $item1->khoaK){
                    array_push($lop, $item2);
                }
            }
            $item1->lopsh = $lop;
        }



        return view('Admin.SuKien.TaoSuKien')->with([
            'khoa' => $khoa
        ]);
    }
}
