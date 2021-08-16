<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;



class SvDonTuController extends Controller

{
    function endsWith($string, $endString){
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return (substr($string, -$len) === $endString);
    }
    function save_file($file, $dir){
        $path = $file->storeAs($dir, $file->hashName());
        Storage::move($path, 'public/'.$path);
        return $path;
    }

    /*
        Tạo đơn
    */

    // View tạo đơn


    // Danh sách mẫu đơn
    function taoDonIndex(Request $request){
        $danhsachdon = DB::table('table_maudon')->get();
        return view('Sv/DonTu/TaoDon')->with(['danhsachdon' => $danhsachdon]);
    }
    // Lưu đơn
    function nopdonStore(Request $request, $maudon_id){
        $flag = 1;
        $thongtindon = [
            'masv' => session('masv'),
            'maudon_id' => $maudon_id,
            'thoigiantao' => Carbon::now(),
            'trangthai' => 0,
            'thoigianhethan' => Carbon::now()->addDays(DB::table('table_maudon')->where('maudon_id', $maudon_id)->first()->thoigianxuly),
            'phongban_xuly' => DB::table('table_maudon')->where('maudon_id', $maudon_id)->first()->donvi_id
        ];

        $donid = DB::table('table_don')->insertGetId($thongtindon);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $donid,
            'thoigian' => Carbon::now(),
            'trangthai' => 0,
            'noidung' => "Nộp đơn"
        ]);
        if(!$donid){
            $flag = 0;
        }

        $rawRecord = $request->tentruong;

        $fileField = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->where('table_maudon_loai.input_type', 'file')->get();

        foreach ($rawRecord as $key => $item){

            if($this->endsWith($item, ".tmp")){
                $record = [
                    'don_id' => $donid,
                    'truong_id' => $key,
                    'noidung' => $this->save_file($item, 'public/HoSo/DinhKem'),
                ];
                $result = DB::table('table_don_chitiet')->insert($record);
                if(!$result){
                    $flag = 0;
                }
            } else {
                $record = [
                    'don_id' => $donid,
                    'truong_id' => $key,
                    'noidung' => $item,
                ];
                $result = DB::table('table_don_chitiet')->insert($record);
                if(!$result){
                    $flag = 0;
                }
            }
        }
        pushNotify($flag);
        return redirect()->back();
    }

    // Chi tiet mau
    function chiTietThuTuc(Request $request, $maudon_id){
        $don = DB::table('table_maudon')->where('maudon_id', $maudon_id)->first();
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->where('table_sinhvien.masv', '=', session('masv'))
            ->first();
        if($sinhvien->gioitinh){
            $sinhvien->gioitinh = "Nam";
        } else {
            $sinhvien->gioitinh = "Nữ";
        }
        $sinhvien->ten = $sinhvien->hodem . " " .$sinhvien->ten;

        $listtruong = explode(',', $don->truong);
        $mangTruong = array();

        foreach ($listtruong as $item){
            $rs = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->where('id', $item)->first();
            if($rs != null){
                array_push($mangTruong, $rs);
            }
        }
        return view('Sv.DonTu.ChiTietMau')->with([
            'truong' => $mangTruong,
            'maudon_id' => $request->maudon_id,
            'tendon' => $don->tenmaudon,
            'don' => $don,
            'sinhvien' => get_object_vars($sinhvien)
        ]);
    }
    // Ajax trường sang html
    function ajaxTruongDon(Request $request){
        $don = DB::table('table_maudon')->where('maudon_id', $request->maudon_id)->first();
        $listtruong = explode(',', $don->truong);

        $mangTruong = array();

        foreach ($listtruong as $item){
            $rs = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->where('id', $item)->first();
            if($rs != null){
                array_push($mangTruong, $rs);
            }
        }
        return view('Sv/DonTu/AjaxTruongDon')->with([
            'truong' => $mangTruong,
            'maudon_id' => $request->maudon_id,
            'tendon' => $don->tenmaudon
        ]);
    }
    function ajaxCamKet(Request $request){
        $don = DB::table('table_maudon')->where('maudon_id', $request->maudon_id)->first();
        return view('Sv/DonTu/AjaxCamKet')->with(['camket' => $don->dieukhoan]);
    }

    /*
        Tạo đơn
    */

    // Danh sách đơn
    function donDaNop(Request $request){
        $dondanop = DB::table('table_don')
            ->join('table_maudon', 'table_maudon.maudon_id', '=','table_don.maudon_id')
            ->join('table_don_trangthai', 'table_don.trangthai', '=', 'table_don_trangthai.id')
            ->where('masv', session('masv'))
            ->get();
        return view('Sv/DonTu/DonDaNop')->with(['dondanop' => $dondanop]);
    }
    // Xem và sửa lại
    function donChiTiet(Request $request, $don_id){
        $don = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.maudon_id')
            ->join('table_phongban', 'table_maudon.donvi_id', '=', 'table_phongban.id')
            ->where('table_don.don_id', $don_id)->first();
        $donvihientai = DB::table('table_don')
            ->join('table_phongban', 'table_don.phongban_xuly', '=', 'table_phongban.id')
            ->where('table_don.don_id', $don_id)
            ->first()->tenphongban;
        $sinhvien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->where('table_sinhvien.masv', session('masv'))
            ->first();
        // Sua format
        $sinhvien->ten = $sinhvien->hodem . $sinhvien->ten;
        $sinhvien->ngaysinh = Carbon::make($sinhvien->ngaysinh)->format('d-m-Y');
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        $timeline = DB::table('table_don_logs')->where('don_id', $don_id)->where('an', '<>', '1')->orderBy('thoigian', 'DESC')->get();
        $filedList = explode(',', $don->truong);
        foreach ($filedList as $key => $item) {
            if($item == null){
                unset($filedList[$key]);
            }
        }
        $mangTruong = array();
        foreach ($filedList as $key => $item) {
            $rs = DB::table('table_maudon_chitiet')
                ->join('table_don_chitiet', 'table_maudon_chitiet.id', '=', 'table_don_chitiet.truong_id')
                ->where('table_maudon_chitiet.id', $item)
                ->where('table_don_chitiet.don_id', $don_id)
                ->first();
            if ($rs != null) {
                $mangTruong[$rs->id] = $rs;
            } else {
                $rs_emp = DB::table('table_maudon_chitiet')
                    ->where('table_maudon_chitiet.id', $item)
                    ->first();

                $mangTruong[$rs_emp->id] = (object) [
                    'tentruong' => $rs_emp->tentruong,
                    'lienket' => $rs_emp->lienket,
                    'loai_id' => $rs_emp->loai_id,
                ];
            }
        }


        return view('Sv.DonTu.ChiTietDon')->with([
            'mangTruong' => $mangTruong,
            'don' => $don,
            'sinhvien' => $sinhvien,
            'sinhvien_arr' => get_object_vars($sinhvien),
            'timeline' => $timeline
        ]);
    }


    function capNhatDon(Request $request, $don_id){
        $don = DB::table('table_don')->where('don_id', $don_id)->first();
        $maudon = DB::table('table_maudon')->where('maudon_id', $don->maudon_id)->first();
        $listtruong = explode(',', $maudon->truong);
        $mangTruong = array();

        foreach ($listtruong as $item){
            $rs = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->join('table_don_chitiet', 'table_maudon_chitiet.id', '=', 'table_don_chitiet.truong_id')->where('table_maudon_chitiet.id', $item)->where('table_don_chitiet.don_id', $don_id)->first();
            if($rs != null){
                array_push($mangTruong, $rs);
            }
        }
        return view('Sv/DonTu/SuaDon')->with([
            'truong' => $mangTruong,
            'maudon_id' => $request->maudon_id,
            'tendon' => $maudon->tenmaudon,
            'don' => $don

        ]);
    }
    // Lưu sửa đổi
    function capnhatdonStore(Request $request, $don_id){
        $flag = 1;
        $rawRecord = $request->tentruong;

        $fileField = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->where('table_maudon_loai.input_type', 'file')->get();

        foreach ($rawRecord as $key => $item){
            $result = 1;
            if($item != null){
                if($this->endsWith($item, ".tmp")){
                    $record = [
                        'noidung' => $this->save_file($item, 'public/HoSo/DinhKem'),
                    ];
                    $result = DB::table('table_don_chitiet')->where('table_don_chitiet.truong_id', $key)->where('table_don_chitiet.don_id', $don_id)->update($record);
                    if(!$result){
                        $flag = 0;
                    }
                } else {
                    $record = [
                        'noidung' => $item,
                    ];
                    $result = DB::table('table_don_chitiet')->where('table_don_chitiet.truong_id', $key)->where('table_don_chitiet.don_id', $don_id)->update($record);
                    if(!$result){
                        $flag = 0;
                    }
                }
            }
        }
        pushNotify($flag);
        return redirect()->back();
    }

    /*
        API Controller
    */

    function getAll(Request $request, $masv){
        $listdon = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.maudon_id')
            ->join('table_don_trangthai', 'table_don.trangthai_id', '=', 'table_don_trangthai.trangthai_id')
            ->where('table_don.masv', '=', $masv)
            ->get();
        // dd($listdon);
        if($listdon){
            return $listdon;
        }
    }
    function getSingle(Request $request, $masv, $don_id){
        $don = DB::table('table_don')->join('table_don_trangthai', 'table_don.trangthai_id', '=', 'table_don_trangthai.trangthai_id')->where('don_id', $don_id)->first();
        $maudon = DB::table('table_maudon')->where('maudon_id', $don->maudon_id)->first();
        $listtruong = explode(',', $maudon->truong);
        $mangTruong = array();
        $response = null;
        foreach ($listtruong as $item){
            $rs = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->join('table_don_chitiet', 'table_maudon_chitiet.id', '=', 'table_don_chitiet.truong_id')->where('table_maudon_chitiet.id', $item)->where('table_don_chitiet.don_id', $don_id)->first();
            if($rs != null){
                array_push($mangTruong, $rs);
            }
        }
        $response = [
            'tendon' => $maudon->tenmaudon,
            'don' => $don,
            'truong' => $mangTruong
        ];
        return $response;
    }
}
