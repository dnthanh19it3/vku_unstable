<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdKhaoSatController extends Controller
{

    /**
     * Show list va tao mau
     */
    function danhSachMau(){
        $ds_mau = DB::table('khaosat_mau')->where('trangthai', 1)->get();

        return view('Admin.KhaoSat.DanhSachMau')->with([
            'ds_mau' => $ds_mau
        ]);
    }
    /**
     * Tao mau
     */
    function taoKhaoSat(){
        $ds_loai = DB::table('khaosat_loai')->get();

        return view('Admin.KhaoSat.TaoKhaoSat')->with([
            'ds_loai' => $ds_loai,
        ]);
    }
    function taoKhaoSatPost(Request $request){
//        dd($request->all());
        $flag = 1;
        $noidungcauhoi = $request->noidungcauhoi;
        $loai = $request->loai;
        DB::beginTransaction();
        $thongtin = [
            'tenmau' => $request->tenmau,
            'mota' => $request->mota,
            'slug' => $request->slug,
            'trangthai' => 1,
            'created_at' => now()
        ];
        $mau_id = DB::table('khaosat_mau')->insertGetId($thongtin);
        if ($mau_id) {
            $array_cauhoi = [];
            foreach ($noidungcauhoi as $key => $cauhoi) {
                $cauhoi_temp = [];
                $cauhoi_temp['cauhoi'] = $cauhoi;
                $cauhoi_temp['loai'] = $loai[$key];
                $cauhoi_temp['mau_id'] = $mau_id;
                $cauhoi_temp['trangthai'] = 1;
                $cauhoi_temp['created_at'] = now();
                array_push($array_cauhoi, $cauhoi_temp);
            }
            $insert = DB::table('khaosat_cauhoi')->insert($array_cauhoi);
            if (!$insert) {
                $flag = 0;
            }
        } else {
            $flag = 0;
        }
        if ($flag) {
            DB::commit();
            return back();
        } else {
            DB::rollBack();
            return back();
        }
    }

    /**
     *Sua khao sat
     */
    function suaKhaoSat(Request $request, $id){
        $mau = DB::table('khaosat_mau')->where('id', $id)->first();
        $ds_cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $id)->where('trangthai', '=', 1)->get();
        $ds_loai = DB::table('khaosat_loai')->get();
        return view('Admin.KhaoSat.SuaKhaoSat')->with([
           'mau' => $mau,
           'ds_cauhoi' => $ds_cauhoi,
            'ds_loai' => $ds_loai
        ]);
    }
    function suaKhaoSatPost(Request $request, $id){
        $flag = 1;
        $noidungcauhoi = $request->noidungcauhoi;
        $noidungcauhoi_add = $request->noidungcauhoi_add;
        $loai = $request->loai;
        $loai_add = $request->loai_add;
        $delete = $request->delete_key;
        $delete_cauhoi = null;

        //Check delete cau hoi
        if ($delete != null) {
            $delete = explode(',', $delete);
            $delete_cauhoi = DB::table('khaosat_cauhoi')->whereIn('id', $delete)->update(['trangthai' => 2, 'updated_at' => now()]);
        }


        DB::beginTransaction();
        $thongtin = [
            'tenmau' => $request->tenmau,
            'mota' => $request->mota,
            'slug' => $request->slug,
            'updated_at' => now()
        ];
        $update_mau = DB::table('khaosat_mau')->where('id', $id)->update($thongtin);

        // Cap nhat cau hoi cu
        $array_cauhoi = [];
        foreach ($noidungcauhoi as $key => $cauhoi) {
            $cauhoi_temp = [];
            $cauhoi_temp['cauhoi'] = $cauhoi;
            $cauhoi_temp['loai'] = $loai[$key];
            $cauhoi_temp['mau_id'] = $id;
            $cauhoi_temp['updated_at'] = now();
            array_push($array_cauhoi, $cauhoi_temp);
        }
        $update_cauhoi = 0;
        foreach ($array_cauhoi as $key => $item) {
            $update = DB::table('khaosat_cauhoi')->where('id', $request->cauhoi_id[$key])->update($item);
            if ($update) {
                $update_cauhoi = 1;
            }
        }
        // Them cau hoi moi
        $insert_cauhoi = null;
        if ($noidungcauhoi_add != null) {
            $array_cauhoi_add = [];
            foreach ($noidungcauhoi_add as $key => $cauhoi) {
                $cauhoi_temp = [];
                $cauhoi_temp['cauhoi'] = $cauhoi;
                $cauhoi_temp['loai'] = $loai_add[$key];
                $cauhoi_temp['mau_id'] = $id;
                $cauhoi_temp['trangthai'] = 1;
                $cauhoi_temp['created_at'] = now();
                array_push($array_cauhoi_add, $cauhoi_temp);
            }
            $insert = DB::table('khaosat_cauhoi')->insert($array_cauhoi_add);
            if (!$insert) {
                $flag = 0;
            }
        }
        if (!$flag) {
            DB::rollBack();
            return back()->with(['flash_level'=>'danger','flash_message'=>'Thất bại!']);
        } else {
            if ($update_mau || $update_cauhoi || $insert_cauhoi || $delete_cauhoi) {
                DB::commit();
                return back()->with(['flash_level'=>'success','flash_message'=>'Thành công!']);
            }
        }


    }
    /**
     * Xoa khao sat (trangthai => 2)
     */
    function getXoaKhaoSat(Request $request, $id){
        $delete = DB::table('khaosat_mau')->where('id', $id)->update(['trangthai' => 2]);
        if($delete){
            return back()->with(['flash_level'=>'success','flash_message'=>'Xoá thành công!']);
        } else {
            return back()->with(['flash_level'=>'failed','flash_message'=>'Xoá thất bại!']);
        }
    }

    /**
     * THỐNG KÊ
     */

    function getbaoCao(Request $request, $id){
        $sinhvien = DB::table('table_sinhvien')->where('trangthai', 0)->count();
        $mau = DB::table('khaosat_mau')->where('id', $id)->first();
        $cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $id)->where('trangthai', '=', 1)->get();
        $cauhoi_thongke = DB::table('khaosat_cauhoi')->where('mau_id', $id)->where('trangthai', '=', 1)->get();


        $phieutraloi = DB::table('khaosat_traloi')->where('mau_id', $id)->get();


        // Tao cau truc dap an
        foreach ($cauhoi_thongke as $key => $value){
            if($value->loai == 4){
                $value->traloi = [
                    '1' => 0,
                    '2' => 0,
                    '3' => 0,
                    '4' => 0,
                    '5' => 0,
                ];
            } elseif($value->loai == 2) {
                $value->traloi = [];
            } else {
//                unset($cauhoi_thongke[$key]);
            }
        }


        foreach ($phieutraloi as $key => $phieu){
            $cauhoi_canhan = $cauhoi;
            $tracnghiem = explode(',', $phieu->traloi);
            $tuluan = explode('][', $phieu->tuluan);
            $error_count = 0;
            //
            foreach ($cauhoi_canhan as $key => $value){
                if($value->loai == 4){
                    $value->traloi = array_shift($tracnghiem);
                } elseif($value->loai == 2) {
                    $value->traloi = array_shift($tuluan);
                } else {
                    unset($cauhoi_canhan[$key]);
                }
            }

            foreach ($cauhoi_canhan as $key => $value){
                try {
                    if(is_numeric($key)){
                        if($value->loai == 4){
                            $cauhoi_thongke[$key]->traloi[$value->traloi] = $cauhoi_thongke[$key]->traloi[$value->traloi] + 1;
                        } elseif($value->loai == 2) {
                            array_push($cauhoi_thongke[$key]->traloi, $value->traloi);
                        }
                    }
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        //Section lv1
        $section_1_sum = 0;
        $section_1_count = 0;
        $remember_1_key = 0;
        //Section lv2
        $section_2_sum = 0;
        $section_2_count = 0;
        $remember_2_key = 0;


        foreach ($cauhoi_thongke as $key_2_section => $value){
            if($value->loai == 1){
                $section_2_sum = 0;
                $section_2_count = 0;
                $remember_2_key = $key_2_section;
                $value->section_2_avg = 0;
            }

            if($value->loai == 4){
                $total = array_sum($value->traloi);
                $value->label = ['Hoàn toàn không đồng ý', 'Không đồng ý', 'Phân vân', 'Đồng ý', 'Hoàn toàn không đồng ý'];
                $value->data = array_values($value->traloi);
                //Get AVG
                $sum = 0;
                foreach ($value->traloi as $key2 => $value2){
                    $sum += (int) $key2 * $value2;
                }

                $avg = round(@($sum / array_sum($value->traloi)), 2);
                //Section_avg
                $section_2_sum += $avg;
                $value->avg = $avg;
                $section_2_count += 1;
                $cauhoi_thongke[$remember_2_key]->avg = round(@($section_2_sum / $section_2_count), 2);
                //Get Percent
                $value->traloi_percent = [
                    '1' => ceil(@((int) $value->traloi['1'] / $total * 100)),
                    '2' => ceil(@((int) $value->traloi['2'] / $total * 100)),
                    '3' => ceil(@((int) $value->traloi['3'] / $total * 100)),
                    '4' => ceil(@((int) $value->traloi['4'] / $total * 100)),
                    '5' => ceil(@((int) $value->traloi['5'] / $total * 100))
                ];
            }
        }

        $tb_khaosat = 0;
        $tong_khaosat = 0;
        $soluong_hanmuc = 0;
        foreach ($cauhoi_thongke as $key_2_section => $value){
            if($value->loai == 1){
                $tong_khaosat += $value->avg;
                $soluong_hanmuc++;
                $tb_khaosat = (round(@($tong_khaosat/$soluong_hanmuc),2));
            }
        }


        if($request->xem == "chart"){
            return view('Admin.KhaoSat.Report_chart')->with([
                'cauhoi' => $cauhoi_thongke,
                'mau' => $mau,
                'thamgia' => count($phieutraloi),
                'tongso' => $sinhvien,
                'tile' => round(count($phieutraloi) / $sinhvien * 100, 2),
                'tb_khaosat' => $tb_khaosat
            ]);
        } else {
            return view('Admin.KhaoSat.Report')->with([
                'cauhoi' => $cauhoi_thongke,
                'mau' => $mau,
                'thamgia' => count($phieutraloi),
                'tongso' => $sinhvien,
                'tile' => round(count($phieutraloi) / $sinhvien * 100, 2),
                'tb_khaosat' => $tb_khaosat
            ]);
        }
    }
}
