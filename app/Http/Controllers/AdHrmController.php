<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdHrmController extends Controller
{
    function themNhanVienView()
    {
        return view('Admin.HRM.ThemNhanVien')->with([
            'dm' => AdHrmController::getDanhMuc()
        ]);
    }
    function suaNhanVienView(Request $request, $ma_gv)
    {
        $chitiet = DB::table('table_giangvien_chitiet')->where('ma_gv', $ma_gv)->first();
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $tuyendunghopdong = DB::table('table_giangvien_tuyendunghopdong')->where('ma_gv', $ma_gv)->first();
        $chucdanh = DB::table('table_giangvien_chucdanh')->where('ma_gv', $ma_gv)->first();
        $bonhiem = DB::table('table_giangvien_bonhiem')->where('ma_gv', $ma_gv)->first();
        $trinhdochuyenmon = DB::table('table_giangvien_trinhdo')->where('ma_gv', $ma_gv)->first();
        $trinhdolyluan = DB::table('table_giangvien_trinhdolyluan')->where('ma_gv', $ma_gv)->first();
        $trinhdolyluan->trinhdongoaingukhac = explode(',', $trinhdolyluan->trinhdongoaingukhac);


        return view('Admin.HRM.CapNhatNhanVien')->with([
            'dm' => AdHrmController::getDanhMuc(),
            'giangvien' => $giangvien,
            'chitiet' => $chitiet,
            'tuyendunghopdong' => $tuyendunghopdong,
            'chucdanh' => $chucdanh,
            'bonhiem' => $bonhiem,
            'trinhdochuyenmon' => $trinhdochuyenmon,
            'trinhdolyluan' => $trinhdolyluan
        ]);
    }
    function suaNhanVienPost(Request $request, $ma_gv)
    {
//        $tuyendung_hopdong_raw = $request->data['tuyendunghopdong'];
        // Tuyen dung hop dong
//        $tuyendung_hopdong = [
//            "ngaytuyendung" => $tuyendung_hopdong_raw['ngaytuyendung'],
//            "ngaybnngach" => $tuyendung_hopdong_raw['ngaybnngach'],
//            "loaicanbo_id" => $tuyendung_hopdong_raw['loaicanbo_id'],
//            "ngayky" => $tuyendung_hopdong_raw['ngayky'],
//            "tungay" => $tuyendung_hopdong_raw['tungay'],
//            "denngay" => $tuyendung_hopdong_raw['denngay'],
//            "vieckhituyendung_id" => $tuyendung_hopdong_raw['vieckhituyendung_id'],
//            "dvsh" => $tuyendung_hopdong_raw['dvsh'],
//            "nghi_baohiemxahoi_id" => $tuyendung_hopdong_raw['nghi_baohiemxahoi_id'],
//            "file" => $tuyendung_hopdong_raw['file'],
//            "sobhxh" => $tuyendung_hopdong_raw['sobhxh'],
//            "lienketscv" => $tuyendung_hopdong_raw['lienketscv']
//        ];
        //Chitiet
        $chitiet = $request->data['chitiet'];
        if(!isset($chitiet['doanvien'])){
            $chitiet['doanvien'] = 0;
        }
        $update_chitiet = DB::table('table_giangvien_chitiet')->where('ma_gv', $ma_gv)->update($chitiet);
        //Tuyen dung hop dong
        $tuyendung_hopdong = $request->data['tuyendunghopdong'];
        $update_tuyendung_hopdong = DB::table('table_giangvien_tuyendunghopdong')->where('ma_gv', $ma_gv)->update($tuyendung_hopdong);
        // Chuc danh
        $chucdanh = $request->data['chucdanh'];
        if(!isset($chucdanh['heso85'])){
            $chucdanh['heso85'] = 0;
        }
        $update_chucdanh = DB::table('table_giangvien_chucdanh')->where('ma_gv', $ma_gv)->update($chucdanh);
        // Bo nhiem
        $bonhiem = $request->data['bonhiem'];
        $update_bonhiem = DB::table('table_giangvien_bonhiem')->where('ma_gv', $ma_gv)->update($bonhiem);
        // chuyenmon
        $trinhdochuyenmon = $request->data['trinhdochuyenmon'];
        $update_trinhdochuyenmon = DB::table('table_giangvien_trinhdo')->where('ma_gv', $ma_gv)->update($trinhdochuyenmon);
        // ngoai ngu tin hoc
        $trinhdolyluan = $request->data['trinhdolyluan'];
        $trinhdolyluan['trinhdongoaingukhac'] = implode(",", $trinhdolyluan['trinhdongoaingukhac']);
        $update_trinhdolyluan = DB::table('table_giangvien_trinhdolyluan')->where('ma_gv', $ma_gv)->update($trinhdolyluan);

        if($update_chitiet || $update_tuyendung_hopdong || $update_chucdanh || $update_bonhiem || $update_trinhdolyluan || $update_trinhdochuyenmon){
            pushNotify(1);
        }
        return back();
    }

    function getBacLuong(Request $request, $ngach = null, $bac = null){
        $result = DB::table('table_giangvien_dm_bluong')
            ->select('tenlcc', 'ten', 'mangach', 'bac'.$bac.' as bac')
            ->where('mangach', $ngach)->first();
        return json_encode($result);
    }
    function getMaLoai(Request $request, $ngach = null){
        $result = DB::table('table_giangvien_dm_bluong')
            ->select('maloai', 'tenlcc', 'mangach')
            ->where('mangach', $ngach)->first();
        return json_encode($result);
    }
    function getKhoiNganh(Request $request, $khoinganh = null){
        $result = DB::table('table_giangvien_dm_linhvuc')
            ->select('key', 'khoinganh', 'linhvuc')
            ->where('khoinganh', $khoinganh)->get();
        return json_encode($result);
    }

    function getDanhMuc()
    {
        $bluong = DB::table('table_giangvien_dm_bluong')->get();
        $chucvudang = DB::table('table_giangvien_dm_chucvudang')->get();
        $chucvudoanthe = DB::table('table_giangvien_dm_chucvudoanthe')->get();
        $chucvuhientai = DB::table('table_giangvien_dm_chucvuhientai')->get();
        $danhhieu = DB::table('table_giangvien_dm_danhhieu')->get();
        $dantoc = DB::table('table_giangvien_dm_dantoc')->get();
        $dienuutien_bt = DB::table('table_giangvien_dm_dienuutien_bt')->get();
        $dienuutien_gd = DB::table('table_giangvien_dm_dienuutien_gd')->get();
        $dvsh = DB::table('table_giangvien_dm_dvsh')->get();
        $gioitinh = DB::table('table_giangvien_dm_gioitinh')->get();
        $hinhthucdaotao = DB::table('table_giangvien_dm_hinhthucdaotao')->get();
        $hocham = DB::table('table_giangvien_dm_hocham')->get();
        $honnhan = DB::table('table_giangvien_dm_honnhan')->get();
        $huyen_quan = DB::table('table_giangvien_dm_huyen_quan')->get();
        $khoinganh = DB::table('table_giangvien_dm_khoinganh')->get();
        $linhvuc = DB::table('table_giangvien_dm_linhvuc')->get();
        $loaicanbo = DB::table('table_giangvien_dm_loaicanbo')->get();
        $loaicongchuc = DB::table('table_giangvien_dm_loaicongchuc')->get();
        $ngachcc = DB::table('table_giangvien_dm_ngachcc')->get();
        $nghi_baohiemxahoi = DB::table('table_giangvien_dm_nghi_baohiemxahoi')->get();
        $ngoaingu = DB::table('table_giangvien_dm_ngoaingu')->get();
        $quocgia = DB::table('table_giangvien_dm_quocgia')->get();
        $tinh_thanhpho = DB::table('table_giangvien_dm_tinh_thanhpho')->get();
        $tongiao = DB::table('table_giangvien_dm_tongiao')->get();
        $trangthailamviec = DB::table('table_giangvien_dm_trangthailamviec')->get();
        $trinhdochinhtri = DB::table('table_giangvien_dm_trinhdochinhtri')->get();
        $trinhdochuyenmon = DB::table('table_giangvien_dm_trinhdochuyenmon')->get();
        $trinhdongoaingu = DB::table('table_giangvien_dm_trinhdongoaingu')->get();
        $trinhdongoaingukhac = DB::table('table_giangvien_dm_trinhdongoaingukhac')->get();
        $trinhdoqlgiaoduc = DB::table('table_giangvien_dm_trinhdoqlgiaoduc')->get();
        $trinhdoqlnhanuoc = DB::table('table_giangvien_dm_trinhdoqlnhanuoc')->get();
        $trinhdotinhoc = DB::table('table_giangvien_dm_trinhdotinhoc')->get();
        $vieckhituyendung = DB::table('table_giangvien_dm_vieckhituyendung')->get();
        $xuatthan = DB::table('table_giangvien_dm_xuatthan')->get();

        $dm = [
            'bluong' => $bluong,
            'chucvudang' => $chucvudang,
            'chucvudoanthe' => $chucvudoanthe,
            'chucvuhientai' => $chucvuhientai,
            'danhhieu' => $danhhieu,
            'dantoc' => $dantoc,
            'dienuutien_bt' => $dienuutien_bt,
            'dienuutien_gd' => $dienuutien_gd,
            'dvsh' => $dvsh,
            'gioitinh' => $gioitinh,
            'hinhthucdaotao' => $hinhthucdaotao,
            'hocham' => $hocham,
            'honnhan' => $honnhan,
            'huyen_quan' => $huyen_quan,
            'khoinganh' => $khoinganh,
            'linhvuc' => $linhvuc,
            'loaicanbo' => $loaicanbo,
            'loaicongchuc' => $loaicongchuc,
            'ngachcc' => $ngachcc,
            'nghi_baohiemxahoi' => $nghi_baohiemxahoi,
            'ngoaingu' => $ngoaingu,
            'quocgia' => $quocgia,
            'tinh_thanhpho' => $tinh_thanhpho,
            'tongiao' => $tongiao,
            'trangthailamviec' => $trangthailamviec,
            'trinhdochinhtri' => $trinhdochinhtri,
            'trinhdochuyenmon' => $trinhdochuyenmon,
            'trinhdongoaingu' => $trinhdongoaingu,
            'trinhdongoaingukhac' => $trinhdongoaingukhac,
            'trinhdoqlgiaoduc' => $trinhdoqlgiaoduc,
            'trinhdoqlnhanuoc' => $trinhdoqlnhanuoc,
            'trinhdotinhoc' => $trinhdotinhoc,
            'vieckhituyendung' => $vieckhituyendung,
            'xuatthan' => $xuatthan
        ];
        return $dm;
    }

    function themNhanVienPost(Request $request)
    {
        $chitiet_raw = $request->data['chitiet'];
        $tuyendung_hopdong_raw = $request->data['tuyendunghopdong'];

        // Chi tiet
        $chitiet = [
            "anh" => $chitiet_raw['anh'],
            "cmnd" => $chitiet_raw['cmnd'],
            "ngaycap" => $chitiet_raw['ngaycap'],
            "noicap" => $chitiet_raw['noicap'],
            "dienuutien_gd_id" => $chitiet_raw['dienuutien_gd_id'],
            "dienuutien_bt_id" => $chitiet_raw['dienuutien_bt_id'],
            "tongiao_id" => $chitiet_raw['tongiao_id'],
            "honnhan" => $chitiet_raw['honnhan'],
            "xuatthan_id" => $chitiet_raw['xuatthan_id'],
            "trangthailamviec_id" => $chitiet_raw['trangthailamviec_id'],
            "gioitinh" => $chitiet_raw['gioitinh'],
            "noisinh" => $chitiet_raw['noisinh'],
            "dantoc_id" => $chitiet_raw['dantoc_id'],
            "tinh_thanhpho_id" => $chitiet_raw['tinh_thanhpho_id'],
            "huyen_quan_id" => $chitiet_raw['huyen_quan_id'],
            "xa_phuong" => $chitiet_raw['xa_phuong'],
            "thuongtru" => $chitiet_raw['thuongtru'],
            "noiohiennay" => $chitiet_raw['noiohiennay']
        ];
//        $update_chitiet = DB::table('table_giangvien_chitiet')->where('ma_gv', $ma_gv)->update($chitiet);
        // Tuyen dung hop dong
        $tuyendung_hopdong = [
            "ngaytuyendung" => $tuyendung_hopdong_raw['ngaytuyendung'],
            "ngaybnngach" => $tuyendung_hopdong_raw['ngaybnngach'],
            "loaicanbo_id" => $tuyendung_hopdong_raw['loaicanbo_id'],
            "ngayky" => $tuyendung_hopdong_raw['ngayky'],
            "tungay" => $tuyendung_hopdong_raw['tungay'],
            "denngay" => $tuyendung_hopdong_raw['denngay'],
            "vieckhituyendung_id" => $tuyendung_hopdong_raw['vieckhituyendung_id'],
            "dvsh" => $tuyendung_hopdong_raw['dvsh'],
            "nghi_baohiemxahoi_id" => $tuyendung_hopdong_raw['nghi_baohiemxahoi_id'],
            "file" => $tuyendung_hopdong_raw['file'],
            "sobhxh" => $tuyendung_hopdong_raw['sobhxh'],
            "lienketscv" => $tuyendung_hopdong_raw['lienketscv']
        ];
        $update_tuyendung_hopdong = DB::table('table_giangvien_tuyendunghopdong')->where('ma_gv', $ma_gv)->update($tuyendung_hopdong);
        // Chuc danh
        $chucdanh = $request->data['chucdanh'];
//        $update_chucdanh = DB::table('table_giangvien_chucdanh')->where('ma_gv', $ma_gv)->update($chucdanh);
       // Bo nhiem
        $bonhiem = $request->data['bonhiem'];
//        $update_bonhiem = DB::table('table_giangvien_bonhiem')->where('ma_gv', $ma_gv)->update($bonhiem);
        // chuyenmon
        $trinhdochuyenmon = $request->data['trinhdochuyenmon'];
//        $update_trinhdochuyenmon = DB::table('table_giangvien_trinhdo')->where('ma_gv', $ma_gv)->update($trinhdochuyenmon);
        // ngoai ngu tin hoc
        $trinhdolyluan = $request->data['trinhdolyluan'];
//        $trinhdolyluan['trinhdongoaingukhac'] = implode(",", $trinhdolyluan['trinhdongoaingukhac']);
//        $update_trinhdolyluan = DB::table('table_giangvien_trinhdolyluan')->where('ma_gv', $ma_gv)->update($trinhdolyluan);
    }


    // Cong tac nuoc ngoai
    function congTacNuocNgoaiView(Request $request, $ma_gv= null){
        $quocgia = DB::table('table_giangvien_dm_quocgia')->get();
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $data = DB::table('table_giangvien_congtacnuocngoai')->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
            ->join('table_giangvien_dm_quocgia', 'table_giangvien_congtacnuocngoai.quocgia_id', 'table_giangvien_dm_quocgia.key')
            ->select(['table_giangvien_congtacnuocngoai.*', 'table_giangvien_dm_quocgia.quocgia'])
            ->get();

        return view('Admin.HRM.QuaTrinh.CongTacNuocNgoai')->with([
            'quocgia' => $quocgia,
            'giangvien' => $giangvien,
            'data' => $data
        ]);
    }
    function congTacNuocNgoaiGetData(Request $request, $ma_gv= null){
        $data = DB::table('table_giangvien_congtacnuocngoai')->where('id', $request->id)->first();
        return json_encode($data);
    }
    function congTacNuocNgoaiThemPost(Request $request, $ma_gv= null){
        $data = $request['data']['Congtacnuocngoai'];
//        dd($data);
        $data['created_at'] = now();
        $data['trangthai'] = 1;
        $insert = DB::table('table_giangvien_congtacnuocngoai')->insert($data);
        dd($insert);
    }
    function congTacNuocNgoaiSuaPost(Request $request, $ma_gv= null){
        $data = $request['data']['Congtacnuocngoai'];
        unset($data['ma_gv']);
        $data['updated_at'] = now();
        $update = DB::table('table_giangvien_congtacnuocngoai')->where('id', $request->id)->update($data);
        dd($update);
    }
    function congTacNuocNgoaiXoa(Request $request, $ma_gv = null){
        $data = ['updated_at' => now(), 'trangthai'=> 2];
        $delete = DB::table('table_giangvien_congtacnuocngoai')->where('id', $request->id)->update($data);
        dd($delete);
    }


    /**
     * Công tác
     **/
    // Cong tac nuoc ngoai
    function congTacView(Request $request, $ma_gv= null){
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $data = DB::table('table_giangvien_congtac')->where(['ma_gv' => $ma_gv, 'trangthai' => 1])->get();

        return view('Admin.HRM.QuaTrinh.CongTac')->with([
            'giangvien' => $giangvien,
            'data' => $data
        ]);
    } //OK
    function congTacGetData(Request $request, $ma_gv= null){
        $data = DB::table('table_giangvien_congtac')->where('id', $request->id)->first();
        return json_encode($data);
    } // OK
    function congTacThemPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhcongtac'];
//        dd($data);
        $data['created_at'] = now();
        $data['trangthai'] = 1;
        $insert = DB::table('table_giangvien_congtac')->insert($data);
        dd($insert);
    } // OK
    function congTacSuaPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhcongtac'];
        unset($data['ma_gv']);
        $data['updated_at'] = now();
        $update = DB::table('table_giangvien_congtac')->where('id', $request->id)->update($data);
        dd($update);
    } //OK
    function congTacXoa(Request $request, $ma_gv = null){
        $data = ['updated_at' => now(), 'trangthai'=> 2];
        $delete = DB::table('table_giangvien_congtac')->where('id', $request->id)->update($data);
        dd($delete);
    } //OK
    /**
     * Nghỉ phép
     **/
    // Cong tac nuoc ngoai
    function nghiPhepView(Request $request, $ma_gv= null){
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $data = DB::table('table_giangvien_nghiphep')
            ->join('table_giangvien_dm_nghi_baohiemxahoi', 'table_giangvien_nghiphep.nghi_baohiemxahoi_id', 'table_giangvien_dm_nghi_baohiemxahoi.key')
            ->select(['table_giangvien_nghiphep.*', 'table_giangvien_dm_nghi_baohiemxahoi.nghi_baohiemxahoi'])
            ->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
            ->get();
        $nghi_baohiemxahoi = DB::table('table_giangvien_dm_nghi_baohiemxahoi')->get();
        return view('Admin.HRM.QuaTrinh.NghiPhep')->with([
            'giangvien' => $giangvien,
            'data' => $data,
            'nghi_baohiemxahoi' => $nghi_baohiemxahoi
        ]);
    } //OK
    function nghiPhepGetData(Request $request, $ma_gv= null){
        $data = DB::table('table_giangvien_nghiphep')->where('id', $request->id)->first();
        return json_encode($data);
    } //
    function nghiPhepThemPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhnghiphep'];
        $data['created_at'] = now();
        $data['trangthai'] = 1;
        $insert = DB::table('table_giangvien_nghiphep')->insert($data);
        dd($insert);
    } //OK
    function nghiPhepSuaPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhnghiphep'];
        unset($data['ma_gv']);
        $data['updated_at'] = now();
        $update = DB::table('table_giangvien_nghiphep')->where('id', $request->id)->update($data);
        dd($update);
    } //OK
    function nghiPhepXoa(Request $request, $ma_gv = null){
        $data = ['updated_at' => now(), 'trangthai'=> 2];
        $delete = DB::table('table_giangvien_nghiphep')->where('id', $request->id)->update($data);
        dd($delete);
    } //OK

    /**
     * khen thướng
     **/
    function khenthuongView(Request $request, $ma_gv= null){
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $data = DB::table('table_giangvien_khenthuong')
            ->join('table_giangvien_dm_khenthuong', 'table_giangvien_khenthuong.khenthuong_id', 'table_giangvien_dm_khenthuong.key')
            ->select(['table_giangvien_khenthuong.*', 'table_giangvien_dm_khenthuong.khenthuong'])
            ->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
            ->get();
        $khenthuong = DB::table('table_giangvien_dm_khenthuong')->get();
        return view('Admin.HRM.QuaTrinh.KhenThuong')->with([
            'giangvien' => $giangvien,
            'data' => $data,
            'khenthuong' => $khenthuong
        ]);
    } // OK
    function khenThuongGetData(Request $request, $ma_gv= null){
        $data = DB::table('table_giangvien_khenthuong')->where('id', $request->id)->first();
        return json_encode($data);
    } //OK
    function khenThuongThemPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhkhenthuong'];
        $data['created_at'] = now();
        $data['trangthai'] = 1;
        $insert = DB::table('table_giangvien_khenthuong')->insert($data);
        dd($insert);
    } // OK
    function khenThuongSuaPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhkhenthuong'];
        unset($data['ma_gv']);
        $data['updated_at'] = now();
        $update = DB::table('table_giangvien_khenthuong')->where('id', $request->id)->update($data);
        dd($update);
    } // OK
    function khenThuongXoa(Request $request, $ma_gv = null){
        $data = ['updated_at' => now(), 'trangthai'=> 2];
        $delete = DB::table('table_giangvien_khenthuong')->where('id', $request->id)->update($data);
        dd($delete);
    } //OK

    /**
     *   Ky luat
     **/
    function kyLuatView(Request $request, $ma_gv= null){
        $giangvien = DB::table('table_giangvien')->where('ma_gv', $ma_gv)->first();
        $data = DB::table('table_giangvien_kyluat')
            ->join('table_giangvien_dm_kyluat', 'table_giangvien_kyluat.kyluat_id', 'table_giangvien_dm_kyluat.key')
            ->select(['table_giangvien_kyluat.*', 'table_giangvien_dm_kyluat.kyluat'])
            ->where(['ma_gv' => $ma_gv, 'trangthai' => 1])
            ->get();
        $kyluat = DB::table('table_giangvien_dm_kyluat')->get();
        return view('Admin.HRM.QuaTrinh.KyLuat')->with([
            'giangvien' => $giangvien,
            'data' => $data,
            'kyluat' => $kyluat
        ]);
    } //OK
    function kyLuatGetData(Request $request, $ma_gv= null){
        $data = DB::table('table_giangvien_kyluat')->where('id', $request->id)->first();
        return json_encode($data);
    } //OK
    function kyLuatThemPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhkyluat'];
        $data['created_at'] = now();
        $data['trangthai'] = 1;
        $insert = DB::table('table_giangvien_kyluat')->insert($data);
        dd($insert);
    } //OK
    function kyLuatSuaPost(Request $request, $ma_gv= null){
        $data = $request['data']['Quatrinhkyluat'];
        unset($data['ma_gv']);
        $data['updated_at'] = now();
        $update = DB::table('table_giangvien_kyluat')->where('id', $request->id)->update($data);
        dd($update);
    } //OK
    function kyLuatXoa(Request $request, $ma_gv = null){
        $data = ['updated_at' => now(), 'trangthai'=> 2];
        $delete = DB::table('table_giangvien_kyluat')->where('id', $request->id)->update($data);
        dd($delete);
    } //OK
}
