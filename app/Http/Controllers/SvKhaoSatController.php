<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SvKhaoSatController extends Controller
{
    function lamKhaoSat(Request $request, $slug){
        $mau = DB::table('khaosat_mau')->where('slug', $slug)->first();
        $cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $mau->id)->where('trangthai', 1)->get();
        $phieutraloi = DB::table('khaosat_traloi')->where('mau_id', $mau->id)->where('masv', session('masv'))->first();


       if($phieutraloi != null){
           $tracnghiem = explode(',', $phieutraloi->traloi);
           $tuluan = explode('][', $phieutraloi->tuluan);


           foreach ($cauhoi as $key => $value){
               if($value->loai == 4){
                   $value->traloi = array_shift($tracnghiem);
               } elseif($value->loai == 2) {
                   $value->traloi = array_shift($tuluan);
               }
           }
       }

        return view('Sv.KhaoSat.MauKhaoSat')->with([
            'mau' => $mau,
            'cauhoi' => $cauhoi
        ]);
    }
    function lamKhaoSatPost(Request $request){

        $flag = 1;
        $count_truong_tracnghiem = 0;
        $count_truong_tuluan = 0;
        //Check thong tin mau
        $cauhoi = DB::table('khaosat_cauhoi')->where('mau_id', $request->mau_id)->where('trangthai', 1)->get();
        foreach ($cauhoi as $key => $value){
            if($value->loai == 4){
                $count_truong_tracnghiem +=1;
            } elseif($value->loai == 2) {
                $count_truong_tuluan +=1;
            }
        }
        DB::beginTransaction();
        while ($flag){
            $data = [];

            $tontai = DB::table('khaosat_traloi')
                    ->where('masv', session('masv'))
                    ->where('mau_id', $request->mau_id)
                    ->first();
            $temp_tracnghiem = $request->all()['traloi'];
            $temp_tuluan = $request->all()['tuluan'];
            $hocky_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();


            // Validate giá trị ảo
            foreach ($temp_tracnghiem as $key => $item){
                if($item > 5 || $item < 1 || !is_numeric($item)){
                    $temp_tracnghiem[$key] = 3;
                }
                if(is_array($item)){
                    $temp_tracnghiem[$key] = implode('|', $item);
                }
            }
            // Validate giá trị rỗng
            foreach ($temp_tuluan as $key => $item){
                if($item == null || $item == ''){
                    $temp_tuluan[$key] = "Không có ý kiến!";
                }
            }
            // Check so luong truong hop le
            if($count_truong_tracnghiem > count($temp_tracnghiem) || $count_truong_tuluan > count($temp_tuluan)){
                $flag = 0;
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
            if(!$flag){
                break;
            }
            DB::commit();
            return back();
        }
        DB::rollBack();
        return back();
    }
}
