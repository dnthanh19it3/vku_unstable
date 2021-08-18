<?php

namespace App\Http\Controllers;

use App\Imports\RenLuyenImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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
        $regex_hocky = "/HK(\d)\s*(\d*)-(\d*)/";
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
            if($key > 4 && $value != null){
                $output = null;
                preg_match_all($regex_hocky, $value, $output);
                $hocky = $output[1];
                $nambatdau = $output[2];
                $namketthuc = $output[3];


                    $array_hocky[$key]['text'] = $value;
                    $array_hocky[$key]['namhoc'] = $nambatdau[0]."-".$namketthuc[0];
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
        $excel_data = session('excel_data');
        $hocky_data = session('hocky_data');



        $output = array();




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
                ->where('namhoc', $item['namhoc'])
                ->where('hocky', $item['hocky'])
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
        $hocky = null;
        $namhoc = null;
        $danhsach = null;
        $lop_dangchon = null;
        $lop = DB::table('table_lopsh')->get();

        $sinhvien = DB::table('table_sinhvien')->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id');

//        $stmt = DB::table('table_danhgiarenluyen')
//            ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
//            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id');

        if(isset($request->lop)){
            $namhoc = DB::table('table_danhgiarenluyen')
                ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
                ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
                ->where('table_lopsh.id', 'like', $request->lop)
                ->distinct()
                ->get('table_danhgiarenluyen.namhoc');

        }
        if(isset($request->lop) && isset($request->hocky) && isset($request->namhoc)){
            $danhsach = DB::table('table_danhgiarenluyen')
                ->join('table_sinhvien', 'table_danhgiarenluyen.masv', '=', 'table_sinhvien.masv')
                ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
                ->where('table_lopsh.id', '=', $request->lop)
                ->where('table_danhgiarenluyen.namhoc', '=', $request->namhoc)
                ->where('table_danhgiarenluyen.hocky', '=', $request->hocky)
                ->get();
        }





//        if(isset($request->lop)){
//            $sinhvien
//                ->where('table_lopsh.tenlop', 'like', '17BA')
//                ->get(['table_sinhvien.masv', 'table_sinhvien.masv', 'table_sinhvien.hodem', 'table_sinhvien.ten']);
//            }
        //            $stmt = $stmt->where('table_sinhvien.lopsh_id', '=', $request->lop);

//        $danhsachdiem = ($stmt->get(['table_sinhvien.masv','table_sinhvien.hodem', 'table_sinhvien.ten', 'table_lopsh.tenlop', 'table_danhgiarenluyen.diem', 'table_danhgiarenluyen.namhoc', 'table_danhgiarenluyen.hocky']));

//        foreach ((array) $sinhvien as $key1 => $value1){
//            foreach ($danhsachdiem as $key2 => $value2){
//                if('$value1->masv == $value20->masv'){
//                    $value1["Học kỳ" . $value2->hocky . "Năm học " . $value2->namhoc] = $value2;
//                }
//            }
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
