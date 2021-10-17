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
        $flag = 1;
        $noidungcauhoi = $request->noidungcauhoi;
        $loai = $request->loai;
        while ($flag){
            DB::beginTransaction();
            $thongtin = [
                'tenmau' => $request->tenmau,
                'mota' => $request->mota,
                'slug' => $request->slug,
                'trangthai' => 1,
                'created_at' => now()
            ];
            $mau_id = DB::table('khaosat_mau')->insertGetId($thongtin);
            if($mau_id){
                $array_cauhoi = [];
                foreach ($noidungcauhoi as $key => $cauhoi){
                    $cauhoi_temp = [];
                    $cauhoi_temp['cauhoi'] = $cauhoi;
                    $cauhoi_temp['loai'] = $loai[$key];
                    $cauhoi_temp['mau_id'] = $mau_id;
                    $cauhoi_temp['created_at'] = now();
                    array_push($array_cauhoi, $cauhoi_temp);
                }
                $insert = DB::table('khaosat_cauhoi')->insert($array_cauhoi);
                $cauhoi =  DB::table('khaosat_cauhoi')->where('mau_id', $mau_id)->get();


                $loaicau_array = [
                  'tracnghiem' => [],
                  'tuluan' => []
                ];

                if($insert){
                    DB::commit();
                    dd($insert);
                    return back();
                } else {
                    $flag = 0;
                }
            } else {
                $flag = 0;
            }
        }
        DB::rollBack();
    }

    /**
     *Sua khao sat
     */
    function suaKhaoSat(Request $request, $id){
        $mau = DB::table('khaosat_mau')->where('id', $id)->first();
        $ds_cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $id)->get();
        $ds_loai = DB::table('khaosat_loai')->get();
        return view('Admin.KhaoSat.SuaKhaoSat')->with([
           'mau' => $mau,
           'ds_cauhoi' => $ds_cauhoi,
            'ds_loai' => $ds_loai
        ]);
    }
    function suaKhaoSatPost(Request $request, $id){
//        dd($request->all());
        $flag = 1;
        $noidungcauhoi = $request->noidungcauhoi;
        $loai = $request->loai;
        while ($flag){
            DB::beginTransaction();
            $thongtin = [
                'tenmau' => $request->tenmau,
                'mota' => $request->mota,
                'slug' => $request->slug,
                'updated_at' => now()
            ];
            $update_mau = DB::table('khaosat_mau')->where('id', $id)->update($thongtin);
            if(true){
                $array_cauhoi = [];
                foreach ($noidungcauhoi as $key => $cauhoi){
                    $cauhoi_temp = [];
                    $cauhoi_temp['cauhoi'] = $cauhoi;
                    $cauhoi_temp['loai'] = $loai[$key];
                    $cauhoi_temp['mau_id'] = $id;
                    $cauhoi_temp['updated_at'] = now();
                    array_push($array_cauhoi, $cauhoi_temp);
                }

                $update_cauhoi = 0;
                foreach ($array_cauhoi as $key => $item){
                    $update = DB::table('khaosat_cauhoi')->where('id', $request->cauhoi_id[$key])->update($item);
                    if($update){
                        $update_cauhoi = 1;
                    }
                }


                if($update_mau || $update_cauhoi ){
                    DB::commit();
                    dd($update);
                    return back();
                } else {
                    $flag = 0;
                }
            } else {
                $flag = 0;
            }
        }
        DB::rollBack();
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
        $mau = DB::table('khaosat_mau')->where('id', $id)->first();
        $cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $id)->get();
        $cauhoi_thongke = DB::table('khaosat_cauhoi')->where('mau_id', $id)->get();


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
                unset($cauhoi_thongke[$key]);
            }
        }


        foreach ($phieutraloi as $key => $phieu){
            $cauhoi_canhan = $cauhoi;
            $tracnghiem = explode(',', $phieu->traloi);
            $tuluan = explode('][', $phieu->tuluan);
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
                if($value->loai == 4){
                    $cauhoi_thongke[$key]->traloi[$value->traloi] += 1;
                } elseif($value->loai == 2) {
                    array_push($cauhoi_thongke[$key]->traloi, $value->traloi);
                }

            }
        }

        foreach ($cauhoi_thongke as $value){
            if($value->loai == 4){
                $total = array_sum($value->traloi);
                $value->label = ['Hoàn toàn không đồng ý', 'Không đồng ý', 'Phân vân', 'Đồng ý', 'Hoàn toàn không đồng ý'];
                $value->data = array_values($value->traloi);
                //Get AVG
                $sum = 0;
                foreach ($value->traloi as $key2 => $value2){
                    $sum += (int) $key2 * $value2;
                }

                $value->avg = round($sum / array_sum($value->traloi), 2);

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

        return view('Admin.KhaoSat.Report')->with([
            'cauhoi' => $cauhoi_thongke,
            'mau' => $mau
        ]);
    }
}
