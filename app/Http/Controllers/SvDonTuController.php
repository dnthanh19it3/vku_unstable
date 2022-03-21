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
        $don_ctsv = DB::table('table_maudon')->where('donvi_id', 7)->get();
        $don_daotao = DB::table('table_maudon')->where('donvi_id', 8)->get();
//        dd($don_daotao, $don_ctsv);

        return view('Sv/DonTu/TaoDon')->with([
            'ctsv' => $don_ctsv,
            'daotao' => $don_daotao
        ]);
    }


    // Lưu đơn
    function nopdonStore(Request $request, $maudon_id)
    {
        //Flag lỗi
        $flag = 1;
        //Mau don
        $mau = DB::table('table_maudon')->where('id', $maudon_id)->first();
        //Get hoc ki hien tai
        $namhoc_hocky = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        // Prepare mẫu đơn data
        $thongtindon = [
            'masv' => session('masv'),
            'maudon_id' => $maudon_id,
            'thoigiantao' => Carbon::now(),
            'trangthai' => 0,
            'thoigianhethan' => Carbon::now()->addDays(DB::table('table_maudon')->where('id', $maudon_id)->first()->thoigianxuly),
            'phongban_xuly' => DB::table('table_maudon')->where('id', $maudon_id)->first()->donvi_id,
            'namhoc' => $namhoc_hocky->id,
            'hocky' => $namhoc_hocky->hocky,
            'created_at' => Carbon::now()
        ];
        $chitietdon = [
            'trangthai' => 1,
            'created_at' => Carbon::now()
        ];

        $traloi_cauhoi = $request['traloi'];
        $traloi_taptin = $request['taptin'];

        // Validate so luong cau hoi. Neu lon hon so cau -> khong hop le
        if (count($traloi_cauhoi) > count(json_decode($mau->cauhoi, true))) {
            $request->session()->flash('error', "Câu trả lời không hợp lệ! Vui lòng không thay đổi nội dung phản hồi!");
            return back();
        } else {
            $cauhoi = json_decode($mau->cauhoi, true);
            foreach ($cauhoi as $key => $item) {
                if (!isset($traloi_cauhoi[$key])) {
                    $chitietdon[$key] = [];
                }
            }
            ksort($traloi_cauhoi);
            $chitietdon['traloi_cauhoi'] = json_encode((object)$traloi_cauhoi);
        }


        // Upload Google Drive
        $array_file_url = [];
        if ($traloi_taptin) {
            if (count($traloi_taptin) > 0) {
                // Validate file size va dinh dang
                foreach ($traloi_taptin as $key => $item) {
                    if (($item->getSize() <= 10000000) && (preg_match('/jpg|jpeg|png|pdf|doc|docx/', $item->extension()))) {
                        continue;
                    } else {
                        $request->session()->flash('error', "Tập tin của bạn không hợp lệ! Vui lòng kiểm tra lại dung lượng và định dạng!");
                        return back();
                    }
                }
                $taptin = json_decode($mau->taptin, true);
                if ($taptin) {
                    foreach ($taptin as $key_tt => $item_tt) {
                        if (!isset($traloi_taptin[$key_tt])) {
                            $array_file_url[$key_tt] = null;
                        } else {
                            $temp_url = "https://google.com";
//            $temp_url = $this->uploadGoogleDrive($item);
                            if ($temp_url) {
                                $array_file_url[$key] = $temp_url;
                            } else {
                                $request->session()->flash('error', "Lỗi xảy ra khi upload tập tin lên Google Drive!");
                                return back();
                            }
                        }
                    }
                }

                if (count($array_file_url) > 0) {
                    ksort($array_file_url);
                    $chitietdon['traloi_taptin'] = json_encode((object)$array_file_url);
                } else {
                    $chitietdon['traloi_taptin'] = json_encode([]);
                }
            }
        }

        if ($flag) {
            DB::beginTransaction();
            $insert_id = DB::table('table_don')->insertGetId($thongtindon);
            if ($insert_id) {
                $chitietdon['don_id'] = $insert_id;
//                dd($thongtindon, $chitietdon);
                $insert_chitiet = DB::table('table_don_chitiet')->insertGetId($chitietdon);
                if ($insert_chitiet) {
                    DB::commit();
                    $request->session()->flash('success', "Đơn được tạo thành công! Mã hồ sơ " . $insert_id);
                    return back();
                } else {
                    DB::rollBack();
                    $request->session()->flash('error', "Nộp đơn thất bại! Vui lòng thử lại sau!");
                    return back();
                }
            } else {
                DB::rollBack();
                $request->session()->flash('error', "Nộp đơn thất bại! Vui lòng thử lại sau!");
                return back();
            }
        }
    }

    // Chi tiet mau
    function chiTietThuTuc(Request $request, $maudon_id)
    {
//        $masv = session('masv');
        $masv = "19IT195";
        $mau = DB::table('table_maudon')->where('id', $maudon_id)->first();

        $sinhvien = $this->getSinhVienData($masv);

        foreach ($sinhvien as $key => $value) {
            $sinhvien[$key] = $this->getTruongTinh($key, $sinhvien);
        }

        if (!$mau) {
            die('Mẫu đơn này không tồn tại! Vui lòng kiểm tra lại');
        }

        $cauhoi = json_decode($mau->cauhoi, true);
        $taptin = json_decode($mau->taptin, true);


        // 1 - Text 2 - Trac nghiem 3 Trac nghiem Multiple

//        $cauhoi = [
//            [
//                'cauhoi' => 'Họ và tên',
//                'loai' => 1,
//                'static' => 1,
//                'templete' => 'ten',
//                'placeholder' => 'Họ và tên sinh viên',
//                'require' => 1,
//                'dapan' => null
//            ],
//            [
//                'cauhoi' => 'Đối tượng',
//                'loai' => 2,
//                'static' => 0,
//                'templete' => null,
//                'placeholder' => null,
//                'require' => 1,
//                'dapan' => [
//                    'Gia đình có công cách mạng',
//                    'Con thương bình',
//                    'Gia đình có hoàng cảnh đặc biệt khó khăn'
//                ]
//            ],
//            [
//                'cauhoi' => 'Tên ngành',
//                'loai' => 1,
//                'static' => 1,
//                'templete' => 'tenNganh',
//                'placeholder' => null,
//                'require' => 1,
//                'dapan' => null
//            ],
//            [
//                'cauhoi' => 'Chọn môn',
//                'loai' => 3,
//                'static' => 0,
//                'templete' => null,
//                'placeholder' => null,
//                'require' => 1,
//                'dapan' => [
//                    'Gia đình có công cách mạng',
//                    'Con thương bình',
//                    'Gia đình có hoàng cảnh đặc biệt khó khăn'
//                ]
//            ],
//            [
//                'cauhoi' => 'Chọn mônn',
//                'loai' => 4,
//                'static' => 0,
//                'templete' => null,
//                'placeholder' => "Chọn đối tượng",
//                'require' => 0,
//                'dapan' => [
//                    'Gia đình có công cách mạng',
//                    'Con thương bình',
//                    'Gia đình có hoàng cảnh đặc biệt khó khăn'
//                ]
//            ],
//            [
//                'cauhoi' => 'Chọn mônn',
//                'loai' => 5,
//                'static' => 0,
//                'templete' => null,
//                'placeholder' => "Chọn đối tượng",
//                'require' => 1,
//                'dapan' => [
//                    'Gia đình có công cách mạng',
//                    'Con thương bình',
//                    'Gia đình có hoàng cảnh đặc biệt khó khăn'
//                ]
//            ]
//        ];
//
//        $taptin = [
//            [
//                'cauhoi' => 'Giấy chứng nhận của địa phương',
//                'placeholder' => "Chọn đối tượng",
//                'mota' => 'Mô tả chi tiết cho tập tin này',
//                'require' => 1,
//            ],
//            [
//                'cauhoi' => 'Bản sao bằng tốt nghiệp',
//                'placeholder' => "Chọn đối tượng",
//                'mota' => 'Mô tả chi tiết cho tập tin này',
//                'require' => 0,
//            ],
//            [
//                'cauhoi' => 'Công chứng thẻ BHYT mặt sau',
//                'placeholder' => "Chọn đối tượng",
//                'mota' => 'Mô tả chi tiết cho tập tin này hihi',
//                'require' => 0,
//            ]
//        ];

        return view('Sv.DonTu.ChiTietMau')->with([
            'mau' => $mau,
            'cauhoi' => $cauhoi,
            'sinhvien' => $sinhvien,
            'taptin' => $taptin
        ]);
    }

    // Danh sách đơn
    function donDaNop(Request $request)
    {
        $masv = session('masv');

        $dondanop = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id')
            ->join('table_don_trangthai', 'table_don.trangthai', '=', 'table_don_trangthai.id')
            ->where('masv', $masv)
            ->get(['table_don.*', 'table_maudon.tenmaudon', 'table_maudon.loai_id', 'table_don_trangthai.tentrangthai']);

        return view('Sv/DonTu/DonDaNop')->with(['dondanop' => $dondanop]);
    }

    // Xem đơn
    function donChiTiet(Request $request, $don_id)
    {
        $don = DB::table('table_don as don')
            ->join('table_maudon as mau', 'don.maudon_id', '=', 'mau.id')
            ->join('table_donvi_phongban as pb', 'mau.donvi_id', '=', 'pb.id')
            ->where('don.id', $don_id)->first(['don.*', 'pb.tenphongkhoa']);
        $mau = null;
        $traloi_cauhoi = null;
        $traloi_taptin = null;
        $cauhoi = null;
        $taptin = null;
        $sinhvien = null;
        $timeline = DB::table('table_don_logs')->where('don_id', $don_id)->where('an', '<>', '1')->orderBy('thoigian', 'DESC')->get();

        if ($don != null) {
            $don_chitiet = DB::table('table_don_chitiet')->where('don_id', $don->id)->where('trangthai', 1)->first();
            if ($don_chitiet) {
                $sinhvien = $this->getSinhVienData($don->masv);
                $mau = DB::table('table_maudon')->where('id', $don->maudon_id)->first();
                if ($mau) {
                    $cauhoi = json_decode($mau->cauhoi, true);
                    $traloi_cauhoi = json_decode($don_chitiet->traloi_cauhoi, true);
                    $taptin = json_decode($mau->taptin, true);
                    $traloi_taptin = json_decode($don_chitiet->traloi_taptin, true);


                    $taptin = [
                        [
                            'cauhoi' => 'Giấy chứng nhận của địa phương',
                            'placeholder' => "Chọn đối tượng",
                            'mota' => 'Mô tả chi tiết cho tập tin này',
                            'require' => 1,
                        ],
                        [
                            'cauhoi' => 'Bản sao bằng tốt nghiệp',
                            'placeholder' => "Chọn đối tượng",
                            'mota' => 'Mô tả chi tiết cho tập tin này',
                            'require' => 0,
                        ]
                    ];

                } else {
                    die("Lỗi khi truy xuất mẫu đơn! Vui lòng kiểm tra lại");
                }
            } else {
                die("Đơn này không tồn tại! Vui lòng kiểm tra lại!");
            }
        } else {
            die("Lỗi khi truy xuất mẫu đơn! Vui lòng kiểm tra lại");
        }


//        dd($traloi_taptin, $traloi_cauhoi, $mau);

        return view('Sv.DonTu.ChiTietDon')->with([
            'don' => $don,
            'mau' => $mau,
            'sinhvien' => $sinhvien,
            'timeline' => $timeline,
            'cauhoi' => $cauhoi,
            'taptin' => $taptin,
            'traloi_cauhoi' => $traloi_cauhoi,
            'traloi_taptin' => $traloi_taptin,
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
    function capnhatdonStore(Request $request, $don_id)
    {
        //Flag lỗi
        $flag = 1;
        //Don
        $don = DB::table('table_don as don')
            ->join('table_maudon as mau', 'don.maudon_id', '=', 'mau.id')
            ->join('table_donvi_phongban as pb', 'mau.donvi_id', '=', 'pb.id')
            ->where('don.id', $don_id)->first(['don.*', 'pb.tenphongkhoa']);
        if (!$don) {
            die("Không tìm thấy mẫu đơn!");
        }
        //Chitiet
        $don_chitiet = DB::table('table_don_chitiet')->where('don_id', $don->id)->where('trangthai', 1)->first();
        if(!$don_chitiet) {
            die("Dữ liệu đơn không toàn vẹn! Vui lòng kiểm tra lại");
        }
        //Mau don
        $mau = DB::table('table_maudon')->where('id', $don->maudon_id)->first();
        //Get hoc ki hien tai
        $namhoc_hocky = DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        // Prepare mẫu đơn data
        $thongtindon = [
            'updated_at' => Carbon::now()
        ];
        $chitietdon = [
            'don_id' => $don->id,
            'trangthai' => 1,
            'created_at' => Carbon::now()
        ];

        $traloi_cauhoi = $request['traloi'];
        $traloi_taptin = $request['taptin'];

        // Validate so luong cau hoi. Neu lon hon so cau -> khong hop le
        if (count($traloi_cauhoi) > count(json_decode($mau->cauhoi, true))) {
            $request->session()->flash('error', "Câu trả lời không hợp lệ! Vui lòng không thay đổi nội dung phản hồi!");
            return back();
        } else {
            $cauhoi = json_decode($mau->cauhoi, true);
            foreach ($cauhoi as $key => $item) {
                if (!isset($traloi_cauhoi[$key])) {
                    $traloi_cauhoi[$key] = [];
                }
            }
            ksort($traloi_cauhoi);
            $chitietdon['traloi_cauhoi'] = json_encode((object)$traloi_cauhoi);
        }


        // Validate file size va dinh dang

        // Upload Google Drive
        $array_file_url = [];
        if ($traloi_taptin) {
            if (count($traloi_taptin) > 0) {
                // Validate file size va dinh dang
                foreach ($traloi_taptin as $key => $item) {
                    if (($item->getSize() <= 10000000) && (preg_match('/jpg|jpeg|png|pdf|doc|docx/', $item->extension()))) {
                        continue;
                    } else {
                        $request->session()->flash('error', "Tập tin của bạn không hợp lệ! Vui lòng kiểm tra lại dung lượng và định dạng!");
                        return back();
                    }
                }
                $taptin = json_decode($mau->taptin, true);
                if ($taptin) {
                    foreach ($taptin as $key_tt => $item_tt) {
                        if (!isset($traloi_taptin[$key_tt])) {
                            $array_file_url[$key_tt] = null;
                        } else {
                            $temp_url = "https://google.com";
//            $temp_url = $this->uploadGoogleDrive($item);
                            if ($temp_url) {
                                $array_file_url[$key] = $temp_url;
                            } else {
                                $request->session()->flash('error', "Lỗi xảy ra khi upload tập tin lên Google Drive!");
                                return back();
                            }
                        }
                    }
                }

                if (count($array_file_url) > 0) {
                    ksort($array_file_url);
                    dd("Go there");
                    $chitietdon['traloi_taptin'] = json_encode((object)$array_file_url);
                } else {
                    dd("Go here");
                    $chitietdon['traloi_taptin'] = json_encode([]);
                }
            }
        } else {
            $chitietdon['traloi_taptin'] = $don_chitiet->traloi_taptin;
        }
        
        if ($flag) {
            DB::beginTransaction();
            $update = DB::table('table_don')->where('id', $don_id)->update($thongtindon);
            if($update){
                $disabled_all_oldrecord = DB::table('table_don_chitiet')->where('don_id', $don->id)->update(['trangthai' => 0]);
                $update_chitiet = DB::table('table_don_chitiet')->insert($chitietdon);
                if ($disabled_all_oldrecord && $update_chitiet) {
                    DB::commit();
                    $request->session()->flash('success', "Đơn được cập nhật thành công!");
                    return back();
                } else {
                    DB::rollBack();
                    $request->session()->flash('error', "Cập nhật đơn thất bại! Vui lòng thử lại sau!");
                    return back();
                }
            } else {
                DB::rollBack();
                $request->session()->flash('error', "Cập nhật đơn thất bại! Vui lòng thử lại sau!");
                return back();
            }

        }
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


