<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvDanhGiaRenLuyen extends Controller
{
    function taoPhieuView(){
        return view('Sv/RenLuyen/TaoPhieu');
    }
    

    /*
        API
    */

    function getDanhSach(Request $request, $masv){
        $response = DB::table('table_dgrl')
            ->join('table_hocky', 'table_hocky.id', '=', 'table_dgrl.hocky_id')
            ->where('table_dgrl.masv', '=', $masv)->get();
        return $response;
    }
}
