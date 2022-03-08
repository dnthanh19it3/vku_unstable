<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class SvDonTuController extends Controller

{
    /**
     *Lấy file từ GoogleDrive
     * @param file $originalfile File cần lưu
     * @param string $dir thư mục lưu file
     * @return string đường dẫn GoogleDrive
     */
    function uploadGoogleDrive($originalfile, $dir = "/"){
        $fileName = Storage::disk('google')->put('/', $originalfile);
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($fileName, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!

        return Storage::disk('google')->url($file['path']);
    }

    /**
     *   Tạo đơn
     */

    // View tạo đơn


    // Danh sách mẫu đơn
    function taoDonIndex(Request $request){
        $danhsachdon = DB::table('table_maudon')->get();
        return view('Sv/DonTu/TaoDon')->with(['danhsachdon' => $danhsachdon]);
    }

    // Get file field with format
    function dinhDangTruong($input){
        $output = array();
        foreach ($input as $key => $value){
            $numkey = ltrim($key, "field");
            $rs = DB::table('table_maudon_chitiet')
                ->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')
                ->where('id', $numkey)
                ->first();
            $output[$key]['truong_id'] = $numkey;
            $output[$key]['noidung'] = $value;
            $output[$key]['input_type'] = $rs->input_type;
            $output[$key]['nullable'] = $rs->nullable;
        }
        return $output;
    }

    //Validate logic
    function setValidateLogic($type, $required = null){
        switch ($type){
            case "number":
                return 'required|numeric';
            case "datetime":
                return 'required|date';
            case "textarea":
                return "required";
            case "text":
                return 'required';
            case "file":
                return 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240';
        }
    }

    // Lưu đơn
    function nopdonStore(Request $request, $maudon_id)
    {
        //Flag lỗi
        $flag = 1;
        //Get hoc ki hien tai
        $namhoc_hocky = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        // Prepare mẫu đơn data
        $thongtindon = [
            'masv' => session('masv'),
            'maudon_id' => $maudon_id,
            'thoigiantao' => Carbon::now(),
            'trangthai' => 0,
            'thoigianhethan' => Carbon::now()->addDays(DB::table('table_maudon')->where('maudon_id', $maudon_id)->first()->thoigianxuly),
            'phongban_xuly' => DB::table('table_maudon')->where('maudon_id', $maudon_id)->first()->donvi_id,
            'namhoc' => $namhoc_hocky->id,
            'hocky' => $namhoc_hocky->hocky,
            'created_at' => now()
        ];

        //Lấy format của field để validate
        $fieldWithFormat = $this->dinhDangTruong($request->except('_token'));
        //Xây dựng biểu thức logic validate
        $validate_logic = array();

        foreach ($request->except('_token') as $key => $item) {
            $validate_logic[$key] = $this->setValidateLogic($fieldWithFormat[$key]['input_type']);
        }
        //Validate dữ liệu theo logic
        $validated_data = $this->validate($request, $validate_logic);

        DB::beginTransaction();

        //Chèn thông tin cơ bản của đơn
        $donid = DB::table('table_don')->insertGetId($thongtindon);
        //Check và insert data
        if ($donid) { //Thành công thì prepare dữ liệu và add vào array insert data
            $insert_data = array();
            foreach ($validated_data as $key => $value) {
                if (is_object($value)) {
                    $file_path = $this->uploadGoogleDrive($item);
                    if ($file_path) {
                        $record = [
                            'don_id' => $donid,
                            'truong_id' => ltrim($key, "field"),
                            'noidung' => $file_path,
                            'created_at' => now()
                        ];
                        array_push($insert_data, $record);
                    }
                } else {
                    $record = [
                        'don_id' => $donid,
                        'truong_id' => ltrim($key, "field"),
                        'noidung' => $value,
                        'created_at' => now()
                    ];
                    array_push($insert_data, $record);
                }
            }
            $insert = DB::table('table_don_chitiet')->insert($insert_data);
            if (!$insert) { // Thất bại báo vào biến
                $flag = 0;
            } else {
                $addLog = DB::table('table_don_logs')->insert([
                    'don_id' => $donid,
                    'thoigian' => Carbon::now(),
                    'trangthai' => 0,
                    'noidung' => "Nộp đơn"
                ]);
            }
        } else { // Thất bại báo vào biến
            $flag = 0;
        }
        if (!$flag) {
            DB::rollBack();
            return back()->with(['flash_level'=>'danger','flash_message'=>'Thất bại!']);
        } else {
            DB::commit();
            return back()->with(['flash_level'=>'success','flash_message'=>'Thành công!']);
        }
    }

    // Chi tiet mau
    function chiTietThuTuc(Request $request, $maudon_id){
        $don = DB::table('table_maudon')->where('maudon_id', $maudon_id)->first();
        $sinhvien = $this->getSinhVienData(session('masv'));

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
            'sinhvien' => $sinhvien
        ]);
    }

    // Danh sách đơn
    function donDaNop(Request $request){
        $dondanop = DB::table('table_don')
            ->join('table_maudon', 'table_maudon.maudon_id', '=','table_don.maudon_id')
            ->join('table_don_trangthai', 'table_don.trangthai', '=', 'table_don_trangthai.id')
            ->where('masv', session('masv'))
            ->get();
        return view('Sv/DonTu/DonDaNop')->with(['dondanop' => $dondanop]);
    }

    // Xem đơn
    function donChiTiet(Request $request, $don_id){
        $don = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.maudon_id')
            ->join('table_donvi_phongban', 'table_maudon.donvi_id', '=', 'table_donvi_phongban.id')
            ->where('table_don.don_id', $don_id)->first();
        $donvihientai = DB::table('table_don')
            ->join('table_donvi_phongban', 'table_don.phongban_xuly', '=', 'table_donvi_phongban.id')
            ->where('table_don.don_id', $don_id)
            ->first()->tenphongkhoa;
        $sinhvien = $this->getSinhVienData($don->masv);
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
                    'noidung' => $this->getTruongTinh($rs_emp->lienket, $sinhvien)
                ];
            }
        }

//        dd($mangTruong);

        return view('Sv.DonTu.ChiTietDon')->with([
            'mangTruong' => $mangTruong,
            'don' => $don,
            'sinhvien' => $sinhvien,
            'sinhvien' => $sinhvien,
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

    function getSinhVienData($masv){
        $sinhvien_static = null;
        $sinhvien_all = json_decode(file_get_contents("json_test/sinhvien.json"));
        foreach ($sinhvien_all as $key => $item){
            if($item->masv == $masv){
                $sinhvien_static = $item;
                break;
            }
        }
        $sinhvien_chitiet = DB::table('table_sinhvien_chitiet')
            ->where('table_sinhvien_chitiet.masv', $masv)
            ->first();
        $sinhvien = array_merge((array) $sinhvien_chitiet, (array) $sinhvien_static);
        $sinhvien['email'] = DB::table('table_sinhvien')->where('masv', $masv)->first('email')->email;
//        dd($sinhvien);
        return $sinhvien;
    }
    function getTruongTinh($key, $data){
        $data = (object) $data;
        switch ($key) {
            case 'hoten':
                return $data->hodem." ".$data->ten;
            case 'ngaysinh':
                return vnDate($data->ngaysinh);
            case 'gioitinh':
                return $data->gioitinh ? 'Nữ' : 'Nam';
            case 'tongiao':
                if($data->tongiao == 0){
                    return "Không";
                }
                return $data->tongiao;
            case 'doanthe':
                switch ($data->doanthe) {
                    case 0:
                        return "Không";
                    case 1:
                        return "Đoàn viên";
                    case 2:
                        return "Đảng viên";
                }
            case 'ngayketnap':
                return \Illuminate\Support\Carbon::make($data->ngayketnap)->format('d/m/Y');
            case 'hokhauthuongtru':
                return $data->xa_phuong . ', ' . $data->quan_huyen . ', ' . $data->tinh_thanh;
            default:
                if(property_exists($data, $key)){
                    return ((array) $data)[$key];
                }
                return "N/A";
        }
    }
}


