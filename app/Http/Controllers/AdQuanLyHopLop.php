<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdQuanLyHopLop extends Controller
{
    function listHopLopIndex(Request $request, $namhoc = null, $hocky = null)
    {

        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $list_kyhoc = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');

        //kỳ học truy vấn mặc định

        $selected = [
            'namhoc' => ($namhoc) ? $namhoc : $kyhoc_hienhanh->id,
            'hocky' => ($hocky) ? $hocky : $kyhoc_hienhanh->hocky,
            'thang' => ($request->thang) ? $request->thang : (int) now()->format('m')
        ];

        $kyhoc_query = $kyhoc_hienhanh = DB::table('table_namhoc_hocky')
            ->where('id', $selected['namhoc'])
            ->where('hocky', $selected['hocky'])
            ->first();

        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $lopsh = DB::table('table_lopsh')->get();
        $arrayMonth = array();
        $thang = ($request->thang != null) ? $request->thang : date('m');
        $months = [];
        $thongke = [];

        foreach ($result as $dt) {
            array_push($months, $dt->format('m'));
        }

        $arrayBienBan = [];
        foreach ($lopsh as $key => $lop_item) {
            $data = DB::table('table_lopsh_hoplop')
                ->where('lopsh', $lop_item->id)
                ->where('thang', $selected['thang'])
                ->where('namhoc', $selected['namhoc'])
                ->where('hocky', $selected['hocky'])
                ->first();
            $arrayBienBan[$lop_item->tenlop] = $data;
        }


        $thongke = [
            'danop' => 0,
            'chuanop' => 0,
            'tongso' => count($arrayBienBan)
        ];

        foreach ($arrayBienBan as $item) {
            if ($item != null) {
                $thongke['danop'] += 1;
            } else {
                $thongke['chuanop'] += 1;
            }
        }

        array_push($arrayMonth, (object)[
            'thang' => $thang,
            'thang_text' => Carbon::create()->month($thang)->format('M'),
            'bienban' => $arrayBienBan,
        ]);

        return view('Admin.HopLop.ListBienBan')->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'months' => $months,
            'thongke' => (object) $thongke,
            'list_kyhoc' => $list_kyhoc,
            'selected' => $selected
        ]);
    }
    function listPhanHoiIndex(Request $request, $namhoc = null, $hocky = null)
    {
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $list_kyhoc = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');

        //kỳ học truy vấn mặc định

        $selected = [
            'namhoc' => ($namhoc) ? $namhoc : $kyhoc_hienhanh->id,
            'hocky' => ($hocky) ? $hocky : $kyhoc_hienhanh->hocky,
            'thang' => ($request->thang) ? $request->thang : (int) now()->format('m')
        ];

        $kyhoc_query = $kyhoc_hienhanh = DB::table('table_namhoc_hocky')
            ->where('id', $selected['namhoc'])
            ->where('hocky', $selected['hocky'])
            ->first();

        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $lopsh = DB::table('table_lopsh')->get();
        $arrayMonth = array();
        $thang = ($request->thang != null) ? $request->thang : date('m');
        $months = [];
        $thongke = [];

        foreach ($result as $dt) {
            array_push($months, $dt->format('m'));
        }

        $arrayBienBan = [];
        foreach ($lopsh as $key => $lop_item) {
            $data = DB::table('table_lopsh_hoplop')
                ->where('lopsh', $lop_item->id)
                ->where('thang', $selected['thang'])
                ->where('namhoc', $selected['namhoc'])
                ->where('hocky', $selected['hocky'])
                ->first();
            if($data){
                if($data->gopy){
                    $arrayBienBan[$lop_item->tenlop] = $data;
                }
            }
        }


        $thongke = [
            'danop' => 0,
            'chuanop' => 0,
            'tongso' => count($arrayBienBan)
        ];

        foreach ($arrayBienBan as $item) {
            if ($item != null) {
                $thongke['danop'] += 1;
            } else {
                $thongke['chuanop'] += 1;
            }
        }

        array_push($arrayMonth, (object)[
            'thang' => $thang,
            'thang_text' => Carbon::create()->month($thang)->format('M'),
            'bienban' => $arrayBienBan,
        ]);
        return view('Admin.HopLop.ListPhanHoi')->with([
            'arrayMonth' => $arrayMonth,
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'months' => $months,
            'thongke' => (object) $thongke,
            'list_kyhoc' => $list_kyhoc,
            'selected' => $selected
        ]);
    }

    function xemBienBanIndex(Request $request, $id)
    {
        $data = DB::table('table_lopsh_hoplop')
            ->join('table_lopsh', 'table_lopsh_hoplop.lopsh', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_lopsh_hoplop.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_lopsh_hoplop.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_lopsh_hoplop.id','=', $request->id)
            ->first([
                'table_lopsh_hoplop.id',
                'table_lopsh_hoplop.lopsh',
                'table_lopsh_hoplop.thoigianhop',
                'table_lopsh_hoplop.chuongtrinh',
                'table_lopsh_hoplop.noidung',
                'table_lopsh_hoplop.gopy',
                'table_lopsh_hoplop.gvcn_nhanxet',
                'table_lopsh_hoplop.xacnhan_loptruong',
                'table_lopsh_hoplop.xacnhan_bithu',
                'table_lopsh_hoplop.xacnhan_gvcn',
                'table_lopsh_hoplop.xacnhan_khoa',
                'table_lopsh_hoplop.xacnhan_bgh',
                'table_lopsh_hoplop.xacnhan_ctsv',
                'table_lopsh_hoplop.phanhoi',
                'table_lopsh_hoplop.thoigianphanhoi',
                'table_lopsh_hoplop.thoigianduyet',
                'table_lopsh.tenlop',
                'table_namhoc_hocky.nambatdau',
                'table_namhoc_hocky.namketthuc',
                'table_namhoc_hocky.hocky',
                'table_lopsh_hoplop.thang',
                'table_lopsh_hoplop.created_at',
            ]);

        $bancansu = $bancansu = DB::table('table_lopsh_bancansu')
            ->join('table_lopsh_chucvu', 'table_lopsh_bancansu.chucvu_id', '=', 'table_lopsh_chucvu.id')
            ->join('table_sinhvien', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien.masv')
            ->join('table_sinhvien_chitiet', 'table_lopsh_bancansu.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_lopsh_bancansu.lopsh_id', $data->lopsh)
            ->where('table_lopsh_bancansu.trangthai', 1)
            ->orderBy('table_lopsh_chucvu.id', 'ASC')
            ->get();

        return view('Admin.HopLop.XemBienBan')->with([
            'data' => $data,
            'bancansu' => $bancansu
        ]);
    }
    function getLinkBienBan (Request $request){
        return redirect(route('ad.hoplop.listhoplop', ['namhoc' => $request->namhoc, 'hocky' => $request->hocky]));
    }
    function getLinkPhanHoi (Request $request){
        return redirect(route('ad.hoplop.tonghopphanhoi', ['namhoc' => $request->namhoc, 'hocky' => $request->hocky]));
    }
    function getLinkDuKien (Request $request){
        return redirect(route('ad.hoplop.noidungdukien', ['namhoc' => $request->namhoc, 'hocky' => $request->hocky]));
    }

    /**
     *
     * NHÓM ROUTE XỬ LÝ
     * Phản hồi góp ý từ biên bản
     * @param $id int Mã biên bản
     *
     */

    function phanHoi(Request $request, $id)
    {
        $update = DB::table('table_lopsh_hoplop')->where('id', $request->id)->update(['phanhoi' => $request->phanhoi]);
        return redirect()->back();
    }
    /**
     *
     * NHÓM ROUTE XỬ LÝ
     * Duyệt GVCN
     * @param $id int Mã biên bản
     *
     */
    function duyetGvcn(Request $request, $id){
        $flag = 1;
        $update_content = null;
        $check = DB::table('table_lopsh_hoplop')->where('id', $id)->first()->xacnhan_gvcn;
        if($check){
            $update_content = ['xacnhan_gvcn' => 0, 'updated_at' => now()];
        } else {
            $update_content = ['xacnhan_gvcn' => 1, 'updated_at' => now()];
        }
        $update = DB::table('table_lopsh_hoplop')->where('id', $id)->update($update_content);
        $flag = $update ? 1 : 0;
        return back();
    }
    /**
     *
     * NHÓM ROUTE XỬ LÝ
     * Duyệt Khoa
     * @param $id int Mã biên bản
     *
     */
    function duyetKhoa(Request $request, $id){
        $flag = 1;
        $update_content = null;
        $check = DB::table('table_lopsh_hoplop')->where('id', $id)->first()->xacnhan_khoa;
        if($check){
            $update_content = ['xacnhan_khoa' => 0, 'updated_at' => now()];
        } else {
            $update_content = ['xacnhan_khoa' => 1, 'updated_at' => now()];
        }
        $update = DB::table('table_lopsh_hoplop')->where('id', $id)->update($update_content);
        $flag = $update ? 1 : 0;
        return back();
    }
    /**
     *
     * NHÓM ROUTE XỬ LÝ
     * Duyệt CTSV
     * @param $id int Mã biên bản
     *
     */
    function duyetCTSV(Request $request, $id){
        $flag = 1;
        $update_content = null;
        $check = DB::table('table_lopsh_hoplop')->where('id', $id)->first()->xacnhan_gvcn;
        if($check){
            $update_content = ['xacnhan_ctsv' => 0, 'updated_at' => now()];
        } else {
            $update_content = ['xacnhan_ctsv' => 1, 'updated_at' => now()];
        }
        $update = DB::table('table_lopsh_hoplop')->where('id', $id)->update($update_content);
        $flag = $update ? 1 : 0;
        return back();
    }
    /**
     *
     * NHÓM ROUTE XỬ LÝ
     * Duyệt CTSV
     * @param $id int Mã biên bản
     *
     */
    function duyetBgh(Request $request, $id){
        $flag = 1;
        $update_content = null;
        $check = DB::table('table_lopsh_hoplop')->where('id', $id)->first()->xacnhan_gvcn;
        if($check){
            $update_content = ['xacnhan_bgh' => 0, 'updated_at' => now()];
        } else {
            $update_content = ['xacnhan_bgh' => 1, 'updated_at' => now()];
        }
        $update = DB::table('table_lopsh_hoplop')->where('id', $id)->update($update_content);
        $flag = $update ? 1 : 0;
        return back();
    }
    function noiDungDeXuatIndex(Request $request, $namhoc = null, $hocky = null){
        $kyhoc_hienhanh = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $list_kyhoc = DB::table('table_namhoc_hocky')->addSelect(['id', 'nambatdau', 'namketthuc'])->distinct()->get('id');

        //kỳ học truy vấn mặc định

        $selected = [
            'namhoc' => ($namhoc) ? $namhoc : $kyhoc_hienhanh->id,
            'hocky' => ($hocky) ? $hocky : $kyhoc_hienhanh->hocky,
            'thang' => ($request->thang) ? $request->thang : (int) now()->format('m')
        ];

        $kyhoc_query = $kyhoc_hienhanh = DB::table('table_namhoc_hocky')
            ->where('id', $selected['namhoc'])
            ->where('hocky', $selected['hocky'])
            ->first();

        $result = CarbonPeriod::create($kyhoc_hienhanh->batdau, '1 month', $kyhoc_hienhanh->ketthuc)->locale('vi');
        $lopsh = DB::table('table_lopsh')->get();
        $arrayMonth = array();
        $thang = ($request->thang != null) ? $request->thang : date('m');
        $months = [];
        $thongke = [];

        foreach ($result as $dt) {
            array_push($months, $dt->format('m'));
        }

        $noidung = DB::table('table_gvcn_noidungdukien')
            ->where('thang', $selected['thang'])
            ->where('namhoc', $selected['namhoc'])
            ->where('hocky', $selected['hocky'])
            ->first();

        array_push($arrayMonth, (object)[
            'thang' => $thang,
            'thang_text' => Carbon::create()->month($thang)->format('M'),
            'bienban' => $noidung,
        ]);

        return view('Admin.HopLop.ListDeXuat')->with([
            'kyhoc_hienhanh' => $kyhoc_hienhanh,
            'noidung' => $noidung,
            'months' => $months,
            'list_kyhoc' => $list_kyhoc,
            'selected' => $selected
        ]);
    }
    function duKienStore(Request $request){
        $flag = 1;
        $data = [
            'namhoc' => $request->namhoc,
            'hocky' => $request->hocky,
            'thang' => $request->thang,
            'noidung' => $request->noidung,
            'created_at' => now()
        ];

        $insert = DB::table('table_gvcn_noidungdukien')->insert($data);
        if(!$insert){
            $flag = 0;
        }
        dump($data, $insert);
        return back();
    }
    function duKienUpdate(Request $request){
        $flag = 1;
        $data = [
            'noidung' => $request->noidung,
            'updated_at' => now()
        ];

        $update = DB::table('table_gvcn_noidungdukien')->where('id', $request->id)->update($data);

        if(!$update){
            $flag = 0;
        }

        return back();
    }
}
