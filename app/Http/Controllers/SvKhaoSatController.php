<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvKhaoSatController extends Controller
{
    function lamKhaoSat(Request $request, $slug){
        $mau = DB::table('khaosat_mau')->where('slug', $slug)->first();
        $cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $mau->id)->get();
        $phieutraloi = DB::table('khaosat_traloi')->where('mau_id', $mau->id)->where('masv', session('masv'))->first();

        $tracnghiem = explode(',', $phieutraloi->traloi);
        $tuluan = explode('][', $phieutraloi->tuluan);




        foreach ($cauhoi as $key => $value){
            if($value->loai == 4){
                $value->traloi = array_shift($tracnghiem);
            } elseif($value->loai == 2) {
                $value->traloi = array_shift($tuluan);
            }
        }

        return view('Sv.KhaoSat.MauKhaoSat')->with([
            'mau' => $mau,
            'cauhoi' => $cauhoi
        ]);
    }
    function lamKhaoSatPost(Request $request){
        $flag = 1;
        while ($flag){
            $data = [];

            $tontai = DB::table('khaosat_traloi')
                    ->where('masv', session('masv'))
                    ->where('mau_id', $request->mau_id)
                    ->first();
            $temp_tracnghiem = $request->all()['traloi'];
            $temp_tuluan = $request->all()['tuluan'];
            $hocky_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();


            foreach ($temp_tracnghiem as $key => $item){
                if(is_array($item)){
                    $temp_tracnghiem[$key] = implode('|', $item);
                }
            }
            // Xoá khoảng trắng
            foreach ($temp_tuluan as $value){
                $value = ltrim($value);
            }
            // Convert sang string
            $temp_tracnghiem = implode(',',$temp_tracnghiem);
            $temp_tuluan = implode('][',$temp_tuluan);





            $action = 1;
            if($tontai != null){
                $data = [
                    'traloi' => $temp_tracnghiem,
                    'tuluan' => $temp_tuluan,
                    'updated_at' => now()
                ];
                $action = DB::table('khaosat_traloi')->where('id', $tontai->id)->update($data);
            } else {
                $data = [
                    'masv' => session('masv'),
                    'traloi' => $temp_tracnghiem,
                    'tuluan' => $temp_tuluan,
                    'mau_id' => $request->mau_id,
                    'namhoc' => $hocky_hienhanh->id,
                    'hocky' => $hocky_hienhanh->hocky,
                    'created_at' => now()
                ];
                $action = DB::table('khaosat_traloi')->insert($data);
            }
            if(!$action){$flag = 0;};
            return back();
        }
        return back();
    }
}
