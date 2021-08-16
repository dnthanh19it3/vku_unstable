<?php

namespace App\Http\Controllers;

use App\Imports\RenLuyenImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class AdDanhGiaRenLuyen extends Controller
{
    public function danhGiaRenLuyenView()
    {
        return view('Admin.DiemRenLuyen.Index');
    }
    public function getExcel(Request $request)
    {
        $array = Excel::toArray(new RenLuyenImport, $request->file('excel_file'));
        $array_excel_data = array();
        $regex_hocky = "/HK[1-2]\s20..-20../";
        $regex_kyhoc = "/HK([1-2])/";
        $regex_namhoc = "/(HK)/";
        $array_hocky = array();
        $array_lop = array();


        for($i = 7; $i < sizeof($array[0]); $i++){
            $item = $array[0][$i];
            if($item[0] != null){
                array_push($array_excel_data, $item);
            }
        }
        session(['excel_data' =>$array_excel_data]);
        foreach ($array[0][6] as $key => $value){
            if(preg_match_all($regex_hocky, $value)){

                $hocky = substr($value, 2, 1);
                $nambatdau = substr($value, 4, 4);
                $namketthuc = substr($value, 9, 4);

                $namhoc_key = DB::table('table_namhoc_hocky')
                    ->where('nambatdau', $nambatdau)
                    ->where('namketthuc', $namketthuc)
                    ->where('hocky', $hocky)
                    ->first();
                if($namhoc_key != null){
                    $array_hocky[$key]['text'] = $value;
                    $array_hocky[$key]['key'] = $namhoc_key->namhoc_key;
                }
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
        $excel_data = session('excel_data');
        $hocky_data = session('hocky_data');
        $lop_loc = $request->lop;
        $output = array();
        $excel_data_temp = array();

        // Lọc
        // Lọc theo lớp
        if(!in_array( "all", $lop_loc)){
            foreach ($lop_loc as $key => $item){
                foreach ($excel_data as $key_excel => $excel_item){
                    if($excel_item[4] == $item){
                        array_push($excel_data_temp, $excel_item);
                    }
                }
            }
            $excel_data = $excel_data_temp;
        }


        //Du lieu theo ca nhan
        foreach ($excel_data as $key => $sinhvien_data){
            //Du lieu theo cot
            if($request->hocky == "all"){
                foreach ($hocky_data as $hocky_excelkey => $hocky){
                    if($sinhvien_data[$hocky_excelkey] != null){
                        array_push($output, [
                            'masv' => $sinhvien_data[1],
                            'namhoc_key' => $hocky['key'],
                            'diem' => $sinhvien_data[$hocky_excelkey],
                            'xeploai' => xepLoai($sinhvien_data[$hocky_excelkey])
                        ]);
                    }
                }
            } else {

            }
        }


        $insert_count= 0;
        $update_count = 0;
        $skip_count = 0;
        $error_cont = 0;
        $total = 0;
        $error_list = array();
        $created_list = array();
        $updated_list = array();
        $skiped_list = array();

        foreach($output as $item){
            $total += 1;
            $stmt = DB::table('table_danhgiarenluyen');

            $check_exist = DB::table('table_danhgiarenluyen')
                ->where('masv', $item['masv'])
                ->where('namhoc_key', $item['namhoc_key'])
                ->first();
            if($check_exist != null){
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
                } else {
                    $skip_count += 1;
                }
            } else {
                $response = $stmt->insert($item);
                if($response){
                    $insert_count += 1;
                    array_push($created_list, $item);
                } else {
                    $error_cont += 1;
                    array_push($error_list, $item);
                }
            }
        }
//        echo "$insert_count|$update_count|$skip_count|$total";
        return view('Admin.DiemRenLuyen.KetQua')->with([
            'taomoi' => $insert_count,
            'capnhat' => $update_count,
            'boqua' => $skip_count,
            'loi' => $error_cont,
            'tongcong' => $total,
            'list_loi' => $error_list,
            'list_tao' => $created_list,
            'list_capnhat' => $updated_list,
            'list_boqua' => $skiped_list
        ]);
    }
    function xemDiemRenluyen(Request $request){
        $diemrenluyen_chung = null;
        $diemrenluyen_hocky = null;
        $diemrenluyen_chung_ds = null;
        $lop = DB::table('table_lopsh')->get();
        $hocky = DB::table('table_danhgiarenluyen')
            ->join('table_namhoc_hocky', 'table_danhgiarenluyen.namhoc_key', '=', 'table_namhoc_hocky.namhoc_key')
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->where('table_sinhvien.lopsh_id', '=', $request->lop)
            ->select(['table_danhgiarenluyen.namhoc_key', 'table_namhoc_hocky.hocky','table_namhoc_hocky.nambatdau','table_namhoc_hocky.namketthuc'])
            ->groupBy('table_danhgiarenluyen.namhoc_key')
            ->get();

        $stmt = DB::table('table_danhgiarenluyen')
            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id');

        if(isset($request->lop)){
            $stmt = $stmt->where('table_sinhvien.lopsh_id', '=', $request->lop);
        }

        if($request->hocky != "all"){
            $diemrenluyen_hocky = $stmt
                ->where('table_danhgiarenluyen.namhoc_key', '=', $request->hocky)
                ->get();
        } elseif($request->hocky == "all") {
//            $diemrenluyen_chung = DB::select("select `table_sinhvien`.`hodem`, `table_sinhvien`.`ten`, `table_sinhvien`.`masv`, `table_lopsh`.`tenlop` from `table_danhgiarenluyen` inner join `table_sinhvien` on `table_danhgiarenluyen`.`masv` = `table_sinhvien`.`masv` inner join `table_lopsh` on `table_sinhvien`.`lopsh_id` = `table_lopsh`.`id` where `table_sinhvien`.`lopsh_id` = $request->lop group by `table_sinhvien`.`masv`");
            $diemrenluyen_chung = $stmt->get();
            $diemrenluyen_chung_ds = $stmt
                ->select('table_sinhvien.hodem','table_sinhvien.ten','table_sinhvien.masv','table_lopsh.tenlop')
                ->groupBy('table_sinhvien.masv')
                ->get();

//            dd($diemrenluyen_chung);
            /*
             * Go to your config/database.php folder. In mysql configuration array, change strict => true to strict => false, and everything will work nicely.
             * */
        }

        return view('admin.DiemRenLuyen.XemDiem')->with([
            'lop' => $lop,
            'lop_dangchon' => $request->lop,
            'hocky' => $hocky,
            'hocky_dangchon' => $request->hocky,
            'diemrenluyen_hocky' => $diemrenluyen_hocky,
            'diemrenluyen_chung' => $diemrenluyen_chung,
            'diemrenluyen_chung_ds' => $diemrenluyen_chung_ds
        ]);
    }
}
