<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 *  Chuc danh
 **/
function hocHamView(Request $request, $ma_gv= null){
    $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
    $data = DB::table('table_giangvien_hocham')
        ->leftJoin('table_giangvien_dm_hocham', 'table_giangvien_hocham.hocham_id', 'table_giangvien_dm_hocham.key')
        ->leftJoin('table_giangvien_dm_danhhieu', 'table_giangvien_hocham.danhhieu_id', 'table_giangvien_dm_danhhieu.key')
        ->select(['table_giangvien_hocham.*', 'table_giangvien_dm_hocham.hocham', 'table_giangvien_dm_danhhieu.danhhieu'])
        ->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
        ->get();
    $danhhieu = DB::table('table_giangvien_dm_danhhieu')->get();
    $hocham = DB::table('table_giangvien_dm_hocham')->get();
    return view('Admin.HRM.QuaTrinh.ChucDanh')->with([
        'giangvien' => $giangvien,
        'data' => $data,
        'danhhieu' => $danhhieu,
        'hocham' => $hocham
    ]);
} //OK
function hocHamGetData(Request $request, $ma_gv= null){
    $data = DB::table('table_giangvien_hocham')->where('id', $request->id)->first();
    return json_encode($data);
} //OK
function hocHamThemPost(Request $request, $ma_gv= null){
    $data = $request['data']['Bosunghocham'];
    $data['created_at'] = now();
    $data['trangthai'] = 1;
    $insert = DB::table('table_giangvien_hocham')->insert($data);
    dd($insert);
} //OK
function hocHamSuaPost(Request $request, $ma_gv= null){
    $data = $request['data']['Bosunghocham'];
    unset($data['ma_gv']);
    $data['updated_at'] = now();
    $update = DB::table('table_giangvien_hocham')->where('id', $request->id)->update($data);
    dd($update);
} //OK
function hocHamXoa(Request $request, $ma_gv = null){
    $data = ['updated_at' => now(), 'trangthai'=> 2];
    $delete = DB::table('table_giangvien_hocham')->where('id', $request->id)->update($data);
    dd($delete);
} //OK