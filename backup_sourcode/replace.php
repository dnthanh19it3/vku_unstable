<?php
/**
*   Hop dong
**/
function hopDongView(Request $request, $ma_gv= null){
$giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
$data = DB::table('table_giangvien_hopdong')
->leftJoin('table_giangvien_dm_ngachcc', 'table_giangvien_hopdong.ngachcc_id', 'table_giangvien_dm_ngachcc.key')
->select(['table_giangvien_hopdong.*', 'table_giangvien_dm_loaicanbo.loaicanbo'])
->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
->get();
$loaicanbo = DB::table('table_giangvien_dm_loaicanbo')->get();
return view('Admin.HRM.QuaTrinh.HopDong')->with([
'giangvien' => $giangvien,
'data' => $data,
'loaicanbo' => $loaicanbo
]);
} //OK
function hopDongGetData(Request $request, $ma_gv= null){
$data = DB::table('table_giangvien_hopdong')->where('id', $request->id)->first();
return json_encode($data);
} //OK
function hopDongThemPost(Request $request, $ma_gv= null){
$data = $request['data']['HopDong'];
$data['created_at'] = now();
$data['trangthai'] = 1;
$insert = DB::table('table_giangvien_hopdong')->insert($data);
dd($insert);
} //OK
function hopDongSuaPost(Request $request, $ma_gv= null){
$data = $request['data']['HopDong'];
unset($data['ma_gv']);
$data['updated_at'] = now();
$update = DB::table('table_giangvien_hopdong')->where('id', $request->id)->update($data);
dd($update);
} //OK
function hopDongXoa(Request $request, $ma_gv = null){
$data = ['updated_at' => now(), 'trangthai'=> 2];
$delete = DB::table('table_giangvien_hopdong')->where('id', $request->id)->update($data);
dd($delete);
} //OK