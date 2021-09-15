<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\RenLuyenImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
//use Google\Service\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\SvDonTuController;


class AdDanhGiaRenLuyen extends Controller
{
    public function danhGiaRenLuyenView()
    {
        return view('Admin.DiemRenLuyen.Index');
    }
    function getGoogleFile($filename, $dir = "/"){
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first(); // there can be duplicate file names!

        $url = Storage::disk('google')->url($file['path']);

        return $url;
    }

    public function getExcel(Request $request)
    {
        $array = Excel::toArray(new RenLuyenImport, $request->file('excel_file'));
        $array_excel_data = array();
        $regex_hocky = "/HK(\d)\s*(\d*)-(\d*)/";
        $regex_kyhoc = "/HK([1-2])/";
        $regex_namhoc = "/(HK)/";
        $array_hocky = array();
        $array_lop = array();
        $listhocky = DB::table('table_namhoc_hocky')->get();

        for($i = 7; $i < sizeof($array[0]); $i++){
            $item = $array[0][$i];
            if($item[0] != null){
                array_push($array_excel_data, $item);
            }
        }
        // Lưu tạm dữ liệu vào session
        session(['excel_data' =>$array_excel_data]);

        // Lấy tất cả học kỳ trong list trên line 6
        foreach ($array[0][6] as $key => $value){
            if($key > 4 && $value != null){
                $output = null;
                preg_match_all($regex_hocky, $value, $output);
                $hocky = $output[1];
                $nambatdau = $output[2];
                $namketthuc = $output[3];
                $array_hocky[$key]['text'] = $value;
                // Chuyển dạng học kỳ text sang key
                foreach ($listhocky as $key2 => $value2){
                    if(($nambatdau[0] == $value2->nambatdau) && ($namketthuc[0] == $value2->namketthuc)){
                        $array_hocky[$key]['namhoc'] = $value2->id;
                    }
                }
                $array_hocky[$key]['hocky'] = $hocky[0];
            }

        }


        for($i = 7; $i < sizeof($array[0]); $i++){
            $item = $array[0][$i];
            if($item[0] != null && !in_array($item[4], $array_lop)){
                array_push($array_lop, $item[4]);
            }
        }


        $array_hocky = (object) $array_hocky;
        session(['hocky_data' => $array_hocky]);



        return view('Admin.DiemRenLuyen.TuyChonNhap')->with([
            'array_hocky' => $array_hocky,
            'array_lop' => $array_lop
        ]);
    }


    function  commitData(Request $request){
        //Lấy dữ liệu tạm từ session
        $excel_data = session('excel_data');
        $hocky_data = session('hocky_data');
        $output = array();

        //Biến thống kê
        $insert_count= 0;
        $update_count = 0;
        $skip_count = 0;
        $error_count = 0;
        $total = 0;
        $error_list = array();
        $created_list = array();
        $updated_list = array();
        $skiped_list = array();

        //Du lieu theo ca nhan
        foreach ($excel_data as $key => $sinhvien_data){
            foreach ($hocky_data as $hocky_excelkey => $hocky){
                if($sinhvien_data[$hocky_excelkey] != null){
                    array_push($output, [
                        'masv' => $sinhvien_data[1],
                        'namhoc' => $hocky['namhoc'],
                        'hocky' => $hocky['hocky'],
                        'diem' => $sinhvien_data[$hocky_excelkey],
                        'xeploai' => xepLoai($sinhvien_data[$hocky_excelkey])
                    ]);
                }
            }
        }

        // Lưu dữ liệu
        foreach($output as $item){
            // Tăng biến thống kê
            $total += 1;
            // Tạo truy vấn
            $stmt = DB::table('table_danhgiarenluyen');
            // Tìm bản ghi đã có trong CSDL chưa
            $check_exist = DB::table('table_danhgiarenluyen')
                ->where('masv', $item['masv'])
                ->where('namhoc', $item['namhoc'])
                ->where('hocky', $item['hocky'])
                ->first();
            // Nếu tìm thấy bản ghi
            if($check_exist != null){
                // Check cập nhật hay không
                if($request->capnhat){
                    $response = $stmt->where('id', $check_exist->id)->update($item);
                    if($response){
                        $update_count += 1;
                        array_push($updated_list, $item);
                    } else {
                        $skip_count += 1;
                        if($item != null){
                            array_push($skiped_list, $item);
                        }
                    }
                }
                // Bỏ qua
                else {
                    $skip_count += 1;
                    array_push($skiped_list, $item);
                }
            } else {
                $response = $stmt->insert($item);
                if($response){
                    $insert_count += 1;
                    array_push($created_list, $item);
                } else {
                    $error_count += 1;
                    array_push($error_list, $item);
                }
            }
        }

        return view('Admin.DiemRenLuyen.KetQua')->with([
            'taomoi' => $insert_count,
            'capnhat' => $update_count,
            'boqua' => $skip_count,
            'loi' => $error_count,
            'tongcong' => $total,
            'list_loi' => $error_list,
            'list_tao' => $created_list,
            'list_capnhat' => $updated_list,
            'list_boqua' => $skiped_list
        ]);
    }
    function xemDiemRenluyen(Request $request, $lop_id){
        // Lấy danh sách học kỳ
        $danhsachhocky = DB::table("table_danhgiarenluyen")
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->distinct()
            ->get(['table_danhgiarenluyen.namhoc', 'table_danhgiarenluyen.hocky', 'table_namhoc_hocky.nambatdau', 'table_namhoc_hocky.namketthuc']);

        // Lấy kết quả theo lớp và năm học
        $ketquadanhgia = DB::table("table_danhgiarenluyen")
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->join("table_namhoc_hocky", function ($join){
                $join->on("table_danhgiarenluyen.namhoc", "=", "table_namhoc_hocky.id");
                $join->on("table_danhgiarenluyen.hocky", "=", "table_namhoc_hocky.hocky");
            })
            ->where('table_sinhvien.lopsh_id', $lop_id)
            ->where('table_danhgiarenluyen.namhoc', $request->namhoc)
            ->where('table_danhgiarenluyen.hocky', $request->hocky)
            ->get();
        dd($ketquadanhgia);

//        if(isset($request->lop)){
//            $namhoc = DB::table('table_danhgiarenluyen')
//                ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
//                ->join('table_namhoc_hocky', 'table_danhgiarenluyen.namhoc', '=', 'table_namhoc_hocky.id')
//                ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
//                ->where('table_lopsh.id', 'like', $request->lop)
//                ->distinct()
//                ->get(['table_danhgiarenluyen.namhoc as namhoc_id',
//                    'table_namhoc_hocky.nambatdau as nambatdau',
//                    'table_namhoc_hocky.namketthuc as namketthuc']);
//
//        }
//        if(isset($request->lop) && isset($request->hocky) && isset($request->namhoc)){
//            $danhsach = DB::table('table_danhgiarenluyen')
//                ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
//                ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
//                ->where('table_lopsh.id', '=', $request->lop)
//                ->where('table_danhgiarenluyen.namhoc', '=', $request->namhoc)
//                ->where('table_danhgiarenluyen.hocky', '=', $request->hocky)
//                ->get();
//        }


        return view('admin.DiemRenLuyen.XemDiem')->with([
            'lop' => $lop,
            'namhoc' => $namhoc,
            'lop_dangchon' => $request->lop,
            'danhsach' => $danhsach,
            'selected_namhoc' => $request->namhoc,
            'selected_hocky' => $request->hocky
        ]);
    }
}
