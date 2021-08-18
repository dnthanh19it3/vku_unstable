<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use mikehaertl\pdftk\Pdf;

class SvHosoController extends Controller
{

    public function blobAvatarUpload($blob_in, $masv)
    {
        $folderPath = public_path('AnhHoSoTam/');
        $image_parts = explode(";base64,", $blob_in);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName =  $masv .'_'. time() . '.png';
        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);
        $result = 'AnhHoSoTam/'.$imageName;
        return $result;
    }

    public function duyetAnh($masv, $loai, $trangthai, $image){
        /*
           Loại
         */
        $url = $this->blobAvatarUpload($image, $masv);
        $id = DB::table('table_sinhvien_anh')->insertGetId([
            'masv' => $masv,
            'loai' => $loai,
            'duongdan' => $url,
            'trangthai' => $loai,
            'created_at' => Carbon::now()
        ]);
        return $url;
    }

    public function suahosoStore(Request $request){

            if($request->encoded_avatar){
                $values3 = [
                    'avatar_temp' => $this->blobAvatarUpload($request->encoded_avatar, session('masv')),
                    'ma_bhyt'=> $request->ma_bhyt,
                    'facebook' => $request->facebook,
                    'dienthoai' => $request->dienthoai,
                    'dienthoaigiadinh' => $request->dienthoaigiadinh
                ];
            } else {
                $values3 = [
                    'facebook' => $request->facebook,
                    'ma_bhyt'=> $request->ma_bhyt,
                    'dienthoai' => $request->dienthoai,
                    'dienthoaigiadinh' => $request->dienthoaigiadinh
                ];
            }

        foreach($values3 as $key => $value){
            if(is_null($value)){
                unset($values3[$key]);
            }
        }

        $result3 = DB::table('table_sinhvien_chitiet')->where('masv', session('masv'))->update($values3);


        if($result3 == 1){
            if(isset($values3['avatar_temp'])){
                pushNotifyTimeline(1, session('masv'), 'Hồ sơ', 'Cập nhật ảnh hồ sơ', 'Ảnh hồ sơ mới được cập nhật và chờ duyệt', Carbon::now());
            } else {
                pushNotifyTimeline(1, session('masv'), 'Hồ sơ', 'Cập nhật hồ sơ', 'Cập nhật hồ sơ cá nhân', Carbon::now());
            }
        } else {
            pushNotify(0);
        }


        return redirect()->back();
    }

    public function imgUpload(Request $request)
    {
        $folderPath = public_path('images/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);
        $result = 'images/'.$imageName;
        return $result;
    }
    public function suahosoIndex(){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }

        return view('Sv/HoSo/suahoso')->with([
                    'sinhvien'=> $sinhvien,
                    'hocky' => $hocky_info,
        ]);
    }
    public function hosoIndex(){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->first();
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('masv', "=", session('masv'))->get();
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->join('table_namhoc_hocky', 'table_sinhvien_tamtru.namhoc_hocky','=','table_namhoc_hocky.namhoc_key')
            ->where('table_sinhvien_tamtru.masv', '=', session('masv'))
            ->get();
//        $avatar = DB::table('table_sinhvien_anhcu')->where('id', $sinhvien->avatar)->first();
        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }
        $khenthuong = DB::table('table_sinhvien_khenthuong')->where('masv', session('masv'))->get();
        $kyluat = DB::table('table_sinhvien_kyluat')->where('masv', session('masv'))->get();
        $timeline = DB::table('table_sinhvien_timeline')->where('masv', session('masv'))->orderBy('thoigian', 'DESC')->get();

        $renluyen = DB::table('table_danhgiarenluyen')
            ->where('table_danhgiarenluyen.masv', session('masv'))
            ->get();


        if(isset($sinhvien->avatar)){
            $sinhvien->avatar = asset($sinhvien->avatar);
        } else {
            $sinhvien->avatar = "https://iptc.org/wp-content/uploads/2018/05/avatar-anonymous-300x300.png";
        }

        return view('Sv/HoSo/xemhoso')
            ->with('sinhvien', $sinhvien)
            ->with('sinhvienTamtru', $sinhhvienTamtru)
            ->with('tamtru', $tamtru)
            ->with('kyluat', $kyluat)
            ->with('khenthuong', $khenthuong)
            ->with('timeline', $timeline)
            ->with('renluyen', $renluyen);
    }
    function tamTruIndex(Request $request){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first();
        $listtamtru = DB::table('table_sinhvien_tamtru')
            ->join('table_namhoc_hocky', 'table_sinhvien_tamtru.namhoc_hocky', '=', 'table_namhoc_hocky.namhoc_key')
            ->where('table_sinhvien_tamtru.masv', '=', $sinhvien->masv)
            ->orderBy('thoigian', 'asc')->get();
        $tamtru = DB::table('table_sinhvien_tamtru')->where('id', '=', $sinhvien->tamtru)->first();
        $tamtrucount = DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
            ->where('namhoc_hocky', '=', $hocky_info->namhoc_key)
            ->count('id');
        return view('Sv.HoSo.TamTruIndex')->with([
            'tamtru' => $tamtru,
            'tamtrucount' => $tamtrucount,
            'listtamtru' => $listtamtru,
            'hocky' => $hocky_info
        ]);

    }
    public function hosoIndex2(){
        $sinhvien = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')->first();
        $sinhhvienTamtru = DB::table('table_sinhvien_tamtru')->where('id', $sinhvien->tamtru_id)->first();

        return view('Sv/HoSo/xemhoso2')->with('sinhvien', $sinhvien)->with('sinhvienTamtru', $sinhhvienTamtru);
    }
    public function taoTamTru(Request $request){
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
            ->where('id', '=', $request->tamtru_id)
            ->where('masv', session('masv'))
            ->first();
        $tamtrukey =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
            ->orderBy('created_at', 'desc')
            ->first();
        $tamtrukey = $tamtrukey->id;

        return view('Sv.HoSo.TaoTamTru')->with([
            'tamtru' => $tamtru,
            'tamtrukey' => $tamtrukey
        ]);
    }
    public function taoTamTruStore(Request $request){
        $update = false;
        $hocky_info = DB::table('table_namhoc_hocky')->where('hienhanh', '=', 1)->first(); // Thông tin học kì
        $tamtrucu = DB::table('table_sinhvien_chitiet')->select('tamtru')->where('masv', session('masv'))->first();    //Tạm trú cũ
        $data = $request->validate([
            'so_nha' => 'required',
            'thon_to' => 'required',
            'xa_phuong' => 'required',
            'quan_huyen' => 'required',
            'tinh_thanh' => 'required',
            'tenchuho' => 'required|min:8',
            'sdtchuho' => 'required',
            'thoigian' => 'required'
        ]);
        $data['masv'] = session('masv');
        $data['namhoc_hocky'] = $hocky_info->namhoc_key;
        $data['created_at'] = Carbon::now();

        foreach ($data as $key => $value){
            $data[$key] = trim($value);
        }
        $id = DB::table('table_sinhvien_tamtru')->insertGetId($data);
        if(isset($tamtrucu)){
            $disabletamtrucu = DB::table('table_sinhvien_tamtru')
                ->where('id', '=', $tamtrucu->tamtru)
                ->update(['trangthai' => 0]);
        }
        if($id != null){
            $update = DB::table('table_sinhvien_chitiet')->where('masv', '=', session('masv'))->update(['tamtru' => $id]);
        }
        if($update){
            pushNotifyTimeline(1, session('masv'), 'Hồ sơ', 'Cập nhật tạm trú', 'Bạn đã khai báo thông tin tạm trú cho học kì'.$hocky_info->hocky.' năm học '.$hocky_info->nambatdau.' '.$hocky_info->namketthuc, Carbon::now());
            return redirect(route('suahoso'));
        } else {
            pushNotify(0);
            return redirect(route('taotamtru'));
        }

    }
    public function suaTamTru(Request  $request, $tamtru_id){
        $tamtru =  DB::table('table_sinhvien_tamtru')
            ->where('masv', '=', session('masv'))
            ->where('id', $tamtru_id)
            ->first();
        return view('Sv.HoSo.SuaTamTru')->with([
            'tamtru' => $tamtru
        ]);
    }
    public function suaTamTruStore(Request  $request, $tamtru_id){
        $update = false;
        $data = $request->validate([
            'so_nha' => 'required',
            'thon_to' => 'required',
            'xa_phuong' => 'required',
            'quan_huyen' => 'required',
            'tinh_thanh' => 'required',
            'tenchuho' => 'required|min:8',
            'sdtchuho' => 'required',
            'thoigian' => 'required'
        ]);
        $data['updated_at'] = Carbon::now();
        foreach ($data as $key => $value){
            $data[$key] = trim($value);
        }
        $update = DB::table('table_sinhvien_tamtru')->where('id', '=', $tamtru_id)->update($data);
        if($update){
            return redirect(route('suahoso'));
        } else {
            return redirect(route('taotamtru'));
        }
    }



    /*
        API Controller
    */

    public function getProfile(Request $request, $masv){
        $response = DB::table('table_sinhvien')->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_sinhvien.masv', '=', $masv)->first();

        if(isset($response->avatar)){
            $response->avatar = asset($response->avatar);
        }

        return response()->json($response);
    }

    public function getRenLuyen(Request $request, $masv){
        $renluyen = DB::table('table_danhgiarenluyen')
            ->join('table_namhoc_hocky', 'table_danhgiarenluyen.namhoc_key', '=', 'table_namhoc_hocky.namhoc_key')
            ->where('table_danhgiarenluyen.masv', $masv)
            ->get();
        return response()->json($renluyen);
    }

    public function getKhenThuong(Request $request, $masv){
        $response = DB::table('table_sinhvien_khenthuong')->join('table_sinhvien', 'table_sinhvien_khenthuong.masv', '=', 'table_sinhvien.masv')
            ->select(['noidung', 'thoigian', 'capkhenthuong', 'soquyetdinh'])->where('table_sinhvien.masv', '=', $masv)->get();
        return response()->json($response);
    }
    public function getKyLuat(Request $request, $masv){
        $response = DB::table('table_sinhvien_kyluat')
            ->join('table_sinhvien', 'table_sinhvien_kyluat.masv', '=', 'table_sinhvien.masv')
            ->select(['noidung', 'thoigian', 'capquyetdinh', 'soquyetdinh', 'hinhthuckyluat'])->where('table_sinhvien.masv', '=', $masv)->get();
        return response()->json($response);
    }
    function  exportPDF(){
        $filename = time();
        $data = DB::table('table_sinhvien')->where('table_sinhvien.masv', session('masv'))
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->join('table_nganh', 'table_sinhvien.nganh_id', '=', 'table_nganh.id')
            ->join('table_lopsh', 'table_sinhvien.lopsh_id', '=', 'table_lopsh.id')
            ->first();
//        dd($data);

        $data->hoten = $data->hodem . " " . $data->ten;
        dd($data);

        $pdf = new Pdf(asset('Templete/pdf2.pdf'));
        $pdf->fillForm((array) $data)
            ->flatten()
//            ->saveAs($filename.".pdf");
            ->send( $filename . '.pdf');
    }


}
//public function luuAnh($masv, $loai, $trangthai, $image){
//    $id = DB::table('table_sinhvien_anh')->insertGetId([
//        'masv' => $masv,
//        'loai' => $loai,
//        'trangthai' => $trangthai,
//        'duongdan' => $this->blobAvatarUpload($image, $masv)
//    ]);
//    return $id;
//}
