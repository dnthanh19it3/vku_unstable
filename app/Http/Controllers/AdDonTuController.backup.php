<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class AdDonTuController extends Controller
{
    function getLoaiDon($don_id){
        $don = DB::table('table_don')->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id')
            ->where('table_don.don_id', $don_id)
            ->first();
        if ($don->loai_id){
            return "Đơn";
        } else {
            return "Yêu cầu";
        }
    }
    /*
        Mẫu đơn controller
    */

    //View thêm đơn
    function themDonIndex(Request $request)
    {
        $filedList = DB::table('table_maudon_chitiet')->get();
        $fileType = DB::table('table_maudon_loai')->get();
        $phongban = DB::table('table_donvi_phongban')
            ->orWhere('id', 2)
            ->orWhere('id', 7)
            ->orWhere('id', 8)
            ->orWhere('id', 9)
            ->orWhere('id', 10)->get();

        return view('Admin/DonTu/TaoDon')->with([
            'listTruong' => $filedList,
            'fileType' => $fileType,
            'phongban' => $phongban
        ]);
    }

    //Ajax search truong
    function ajaxSearchTruong(Request $request)
    {
        $result = DB::table('table_maudon_chitiet')->where('tentruong', 'LIKE', '%' . $request->name . '%')->orderBy('thoigiantao', 'DESC')->get();
        return $result;
    }

    //Ajax thêm trường
    function ajaxTruong(Request $request)
    {
        $result = DB::table('table_maudon_chitiet')->where('tentruong', 'LIKE', '%' . $request->tentruong . '%')->get();
        return $result;
    }

    //Lưu đơn
    function maudonStore(Request $request)
    {
        $value1 = [
            'tenmaudon' => $request->tenmaudon,
            'truong' => $request->truong,
            'thoigianxuly' => $request->thoigianxuly,
            'loai_id' => $request->loai_id,
            'mota' => $request->mota,
            'donvi_id' => $request->donvi_id
        ];
        $response1 = DB::table('table_maudon')->insertGetId($value1);
        pushNotify($response1);
        return redirect()->back();
    }

    function maudonUpdate(Request $request, $mau_id)
    {
        $value1 = [
            'tenmaudon' => $request->tenmaudon,
            'truong' => $request->truong,
            'thoigianxuly' => $request->thoigianxuly,
            'loai_id' => $request->loai_id,
            'mota' => $request->mota,
            'donvi_id' => $request->donvi_id
        ];
        $response1 = DB::table('table_maudon')->where('maudon_id', $mau_id)->update($value1);
        pushNotify($response1);
        return redirect()->back();
    }

    //Lưu trường dữ liệu
    function truongStore(Request $request)
    {
        $values = [
            'tentruong' => $request->tentruong,
            'ghichutruong' => $request->ghichutruong,
            'loai_id' => $request->loai_id,
            'thoigiantao' => Carbon::now()->toDateString()
        ];
        $response1 = DB::table('table_maudon_chitiet')->insertGetId($values);
        $num = $response1;

        if ($response1 != null) {
            $response2 = DB::table('table_maudon_chitiet')->where('id', $num)->first();
        }
        return json_encode($response2);
    }

    // Danh sách mẫu
    function danhSachMauView(Request $request)
    {
        $danhsachmau = DB::table('table_maudon');

        if(isset($request->loai_id)){
            $danhsachmau->where('loai_id', '=', $request->loai_id);
        }

        $danhsachmau = $danhsachmau->paginate(20);
        return view('Admin/DonTu/XemMau')->with([
            'danhsachmau' => $danhsachmau
        ]);
    }

    // Chi tiết mẫu
    function chiTietMauView(Request $request, $mau_id)
    {
        $maudon = DB::table('table_maudon')->where('maudon_id', $request->mau_id)->first();
        $listtruong = explode(',', $maudon->truong);
        $mangTruong = array();
        $filedList = DB::table('table_maudon_chitiet')->get();
        $fileType = DB::table('table_maudon_loai')->get();
        $phongban = DB::table('table_donvi_phongban')
            ->orWhere('id', 2)
            ->orWhere('id', 7)
            ->orWhere('id', 8)
            ->orWhere('id', 9)
            ->orWhere('id', 10)
            ->get();


        foreach ($listtruong as $item) {
            $rs = DB::table('table_maudon_chitiet')->join('table_maudon_loai', 'table_maudon_chitiet.loai_id', '=', 'table_maudon_loai.loai_id')->where('id', $item)->first();
            if ($rs != null) {
                array_push($mangTruong, $rs);
            }
        }
        return view('Admin.DonTu.SuaMau')
            ->with([
                'mangTruong' => $mangTruong,
                'maudon' => $maudon,
                'listTruong' => $filedList,
                'fileType' => $fileType,
                'phongban' => $phongban]);
    }

    function xoaMau(Request $request, $mau_id)
    {
        $flag = 1;
        $flag_delete_field = 0;
        DB::beginTransaction();

        // Get form DB
        $maudon = DB::table('table_maudon')->where('maudon_id', $mau_id)->first();
        $listmauddon = DB::table('table_maudon')->where('maudon_id', '<>', $mau_id)->get();
        // Convert to array
        $maudon->truong = explode(',', $maudon->truong);
        foreach ($listmauddon as $key => $item){
            $item->truong = explode(',', $item->truong);
        }
        //Loop for compare
        foreach ($maudon->truong as $key_truongxoa => $value_truongxoa){
            foreach ($listmauddon as $key_maudon => $value_maudon){
                $check = array_search($value_truongxoa, $value_maudon->truong);
                dump($value_maudon, $value_truongxoa, $check);
                if(is_numeric($check)){
                    echo "Tìm $value_truongxoa | Tìm thấy | $check | Bỏ qua<hr/>";
                    unset($maudon->truong[$key_truongxoa]);
                    break;
                } else {
                    echo "Tìm $value_truongxoa |Không tìm thấy, tìm tiếp<hr/>";
                }

            }
        }
        // Tìm trường không phải trường tĩnh (Họ tên, ngày sinh, giới tính, blah blah
        $dynamic_field = array();
        foreach ($maudon->truong as $key => $item){
            $item = DB::table('table_maudon_chitiet')->where('id', $item)->where('lienket', null)->first();
            array_push($dynamic_field, $item);
        }

        foreach ($dynamic_field as $key => $item){
            $delete = DB::table('table_maudon_chitiet')->delete($item->id);
            if(!$delete){
                $flag = 0;
            }
        }
        $delete = DB::table('table_maudon')->where('maudon_id', $mau_id)->delete();
        if(!$delete){
            $flag = 0;
        }



        if(!$flag){
            DB::rollBack();
            return back()->with(['flash_level'=>'danger','flash_message'=>'Thất bại!']);
        } else {
            DB::commit();
            return back()->with(['flash_level'=>'success','flash_message'=>'Thành công!']);
        }
    }




    /*
        Xử lý đơn controller
    */


    // List hồ sơ
    function danhSachHoSoIndex(Request $request)
    {
        $trangthai = DB::table('table_don_trangthai')->get();
        $maudon = DB::table('table_maudon')->get();

        $listdon = DB::table('table_don as don')
            ->join('table_don_trangthai as tt', 'don.trangthai', 'tt.id')
            ->join('table_sinhvien as sv', 'don.masv', 'sv.masv')
            ->join('table_maudon as mau', 'don.maudon_id', 'mau.id');
        if($request->maudon_id){
            $listdon->orWhere('don.maudon_id', $request->maudon_id);
        }
        if($request->masv){
            $listdon->orWhere('sv.masv', $request->masv);
        }
        if($request->trangthai){
            $listdon->orWhere('don.trangthai', $request->trangthai);
        }
        $listdon = $listdon->get(['don.*', 'sv.hodem', 'sv.ten', 'mau.tenmaudon', 'tt.tentrangthai']);
//        dd($listdon);
        dump($listdon, $request->all());

        return view('Admin/DonTu/DanhSachDon')->with([
            'trangthai' => $trangthai,
            'maudon' => $maudon,
            'listdon' => $listdon
        ]);
    }

    //Ajax xem bang ho so
    function ajaxDsHoSo(Request $request)
    {
        Carbon::setLocale('vi');

        $stmt = DB::table('table_don')
            ->join('table_sinhvien', 'table_sinhvien.masv', '=', 'table_don.masv')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id');

        if (isset($request->trangthai)) {
            $stmt->where('table_don.trangthai', $request->trangthai);
        }
        if (isset($request->masv)) {
            $stmt->where('table_sinhvien.masv', 'LIKE', "%" . $request->masv . "%");
        }
        if (isset($request->maudon_id)) {
            $stmt->where('table_don.maudon_id', $request->maudon_id);
        }
        if (isset($request->loai)) {
            $stmt->where('table_maudon.loai_id', $request->loai);
        }

        $danhsachdon = $stmt->orderBy('table_don.thoigiantao', 'DESC')->get();

        foreach ($danhsachdon as $item) {
            //Get link
            $item->url = route('xem_hs', ['don_id' => $item->don_id]);
            //Ngay het han
            $ngayhethan = Carbon::make($item->thoigianhethan);

            if ($item->hoanthanh == 0 && $ngayhethan->isToday() == false){
                $item->thoigianhethan = $item->thoigianhethan . " (" . $ngayhethan->diffForHumans(Carbon::now()) .')';
            } elseif ($item->hoanthanh == 0 && $ngayhethan->isToday()){
                $item->thoigianhethan = "Hôm nay";
            }
            //Trang thai

            $timeline = DB::table('table_don_logs')->where('don_id', $item->don_id)->orderBy('thoigian', 'DESC')->get();

            if($item->hoanthanh == 0 && $item->trangthai > 0) {
                $item->tentrangthai = "Đang xử lý";
            } elseif($item->trangthai == 0) {
                $item->tentrangthai = "Chưa hoàn thành";
            } elseif($item->hoanthanh == 1){
                $item->hoanthanh = "Hoàn thành";
            }
        }

        return $danhsachdon;
    }

    // View xem hồ sơ
    function xemHoSo(Request $request, $don_id)
    {
        $phongban = DB::table('table_donvi_phongban')
            ->orWhere('id', 2)
            ->orWhere('id', 7)
            ->orWhere('id', 8)
            ->orWhere('id', 9)
            ->orWhere('id', 10)
            ->get();
        $don = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id')
            ->join('table_donvi_phongban', 'table_maudon.donvi_id', '=', 'table_donvi_phongban.id')
            ->where('table_don.don_id', $don_id)
            ->first();
        $donvihientai = DB::table('table_don')
            ->join('table_donvi_phongban', 'table_don.phongban_xuly', '=', 'table_donvi_phongban.id')
            ->where('table_don.don_id', $don_id)
            ->first()->tenphongkhoa;
        $sinhvien = getSinhVienData($don->masv);


        $timeline = DB::table('table_don_logs')->where('don_id', $don_id)->orderBy('thoigian', 'DESC')->get();
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
        $hocky_hientai =  DB::table('table_namhoc_hocky')->where('hienhanh', 1)->first();
        $landcap = DB::table('table_don')->where('maudon_id', $don->maudon_id)->where('namhoc', $hocky_hientai->id)->where('hoanthanh', 1)->count('don_id');


        return view('Admin/DonTu/ChiTietDon')->with([
            'mangTruong' => $mangTruong,
            'don' => $don,
            'donvihientai' => $donvihientai,
            'sinhvien' => $sinhvien,
            'sinhvien' => get_object_vars($sinhvien),
            'timeline' => $timeline,
            'phongban' => $phongban,
            'lancap' => $landcap
        ]);
    }

    // Controller xử lý
    function tiepNhanHoSo(Request $request, $don_id)
    {
        $loai = $this->getLoaiDon($don_id);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon\Carbon::now(),
            'trangthai' => 1,
            'noidung' => $loai ." đã được tiếp nhận",
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        $capnhat = DB::table('table_don')
            ->where('don_id', "=", $don_id)
            ->update([
                'chuyenvien_id' => session('hoten'),
                'trangthai' => 1
            ]);

        pushNotify($addLog);
        return redirect()->back();
    }

    function duyet(Request $request, $don_id) {
        $loai = $this->getLoaiDon($don_id);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon::now(),
            'trangthai' => 2,
            'noidung' => $loai." của bạn đã được chấp nhận và chờ chuyên viên ký xác nhận",
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        $capnhat = DB::table('table_don')
            ->where('don_id', "=", $don_id)
            ->update([
                'trangthai' => 2
            ]);

        pushNotify($addLog);
        return redirect()->back();
    }

    function chuyenTiep(Request $request, $don_id){
        $don = DB::table('table_don')->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id')->where('don_id', '=', $don_id)->first();
        $update = DB::table("table_don")->where('don_id', '=', $don_id)->update([
            'chuyentiep' => 1,
            'phongban_xuly' => $request->phongban,
            'lydo' => $request->lydo,
            'thoigianhethan' => Carbon::make($don->thoigianhethan)->addDays($don->thoigianxuly),
        ]);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon::now(),
            'noidung' => "Đơn đã được chuyển tiếp sang phòng " . DB::table('table_donvi_phongban')->where('id', $request->phongban)->first()->tenphongkhoa,
            'an' => 1,
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        return redirect()->back();
    }

    function daXacNhan(Request $request, $don_id) {
        $loai = $this->getLoaiDon($don_id);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon::now(),
            'trangthai' => 4,
            'noidung' => "Hiệu trưởng xác nhận " .$loai.". Hẹn nhận tại phòng ABC từ ".$request->thoigianhennhan,
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        $capnhat = DB::table('table_don')
            ->where('don_id', "=", $don_id)
            ->update([
                'trangthai' => 4,
                'hoanthanh' => 1,
                'thoigianhoanthanh' => Carbon::now()
            ]);
        if($addLog && $capnhat){
            pushNotify(1);
        }
        $don_info = DB::table('table_don')
            ->join('table_sinhvien_taikhoan', 'table_don.masv', '=', 'table_sinhvien_taikhoan.masv')
            ->select('ftoken')
            ->where('table_don.don_id', '=', $don_id)
            ->first();
        $to = $don_info->ftoken;
        $data = array(
            'title' => 'Bộ phân một cửa VKU',
            'body' => $loai . ' của bạn đã được chấp nhận. Bạn có thể nhận '. $loai .' từ '.$request->thoigianhennhan
        );
        notify($to, $data);
        return redirect()->back();
    }

    function tuchoiHoSo(Request $request, $don_id)
    {
        $loai = $this->getLoaiDon($don_id);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon::now(),
            'buoc' => 4,
            'noidung' => "Đơn bị từ chối!",
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        $capnhat = DB::table('table_don')
            ->where('don_id', "=", $don_id)
            ->update(['trangthai_id' => 2]);
        if($addLog && $capnhat){
            pushNotify(1);
        }
        return redirect()->back();
    }

    function kinhanHoSo(Request $request, $don_id)
    {
        $loai = $this->getLoaiDon($don_id);
        $addLog =  DB::table('table_don_logs')->insert([
            'don_id' => $don_id,
            'thoigian' => Carbon::now(),
            'buoc' => 4,
            'noidung' => "Sinh viên đã nhận kết quả",
            'chuyenvien_id' => "chuyenvien@vku.udn.vn"
        ]);
        $capnhat = DB::table('table_don')
            ->where('don_id', "=", $don_id)
            ->update(['danhan' => 1]);
        if($addLog && $capnhat){
            pushNotify(1);
        }
        return redirect()->back();
    }

    /*
        DASHBOARD
    */
    function thuTucDashboard(Request $request)
    {
        $listphongban = DB::table('table_donvi_phongban')
            ->orWhere('id', 2)
            ->orWhere('id', 7)
            ->orWhere('id', 8)
            ->orWhere('id', 9)
            ->orWhere('id', 10);
        $chuahoanthanh = DB::table('table_don')
            ->join('table_maudon', 'table_don.maudon_id', '=', 'table_maudon.id')
            ->join('table_sinhvien', 'table_don.masv', '=', 'table_sinhvien.masv')
            ->where('table_don.hoanthanh', 0);
        if(isset($request->phongban)){
            $chuahoanthanh = $chuahoanthanh->where('phongban_xuly', $request->phongban)->get();
            $listphongban = $listphongban->where('id', $request->phongban)->get();
        }else{
            $chuahoanthanh = $chuahoanthanh->get(['table_don.*', 'table_sinhvien.masv']);
            $listphongban = $listphongban->get();
        }


        // Tạo bộ đếm chưa hoàn thnahf
        foreach ($listphongban as $key => $value){
            $value->soluong = 0;
        }
        // Đếm
        foreach ($chuahoanthanh as $key1 => $value1){
            foreach ($listphongban as $key2 => $value2){
                if($value1->phongban_xuly == $value2->id){
                    $listphongban[$key2]->soluong += 1;
                }
            }
        }


        $chotiepnhan = array();
        $dangxuly = array();
        $hethanhomnay = array();
        $dahethan = array();
        $hethantuannay = array();


        foreach ($chuahoanthanh as $key => $item){
            if($item->trangthai == 0){
                array_push($chotiepnhan, $item);
            }
            if($item->trangthai > 0){
                array_push($dangxuly, $item);
            }
            if ($item->thoigianhethan == Carbon::now()->toDateString()){
                array_push($hethanhomnay, $item);
            }
            if (Carbon::make($item->thoigianhethan)->addDay()->isPast()){
                array_push($dahethan, $item);
            }
            if (Carbon::make($item->thoigianhethan)->isCurrentWeek()){
                array_push($hethantuannay, $item);
            }
        }
        $listphongban_chart = (object) [];
        $tenphongkhoa = array();
        $soluong = array();
        foreach ($listphongban as $item){
            array_push($tenphongkhoa, $item->tenphongkhoa);
            array_push($soluong, $item->soluong);
        }
        (object) $listphongban_chart->tenphongkhoa = $tenphongkhoa;
        (object) $listphongban_chart->soluong =  $soluong;

//        Stats
        $tongso = DB::table('table_don')->count(); //OK
        $dunghan = DB::table('table_don')
            ->where('hoanthanh', 1)
            ->whereRaw('thoigianhoanthanh < thoigianhethan')
            ->count();
        $quahan = DB::table('table_don')
            ->where('hoanthanh', 1)
            ->whereRaw('thoigianhoanthanh > thoigianhethan')
            ->count();
        $dunghan_percent = ($tongso - count($chuahoanthanh) > 0) ?($dunghan / ($tongso - count($chuahoanthanh))) * 100 : 0;
        $quahan_percent = ($tongso - count($chuahoanthanh) > 0) ?($quahan / ($tongso - count($chuahoanthanh))) * 100 : 0;
        $stats = [
            'tongso' => $tongso,
            'dahoanthanh' => ($tongso - count($chuahoanthanh)),
            'chuahoanthanh' => count($chuahoanthanh),
            'dunghan' => $dunghan,
            'dunghan_percent' => $dunghan_percent,
            'quahan' => $quahan,
            'quahan_percent' => $quahan_percent
        ];


        return view('Admin/DonTu/DonTuDash')->with([
            'listphongban_chart' => $listphongban_chart,
            'listphongban' => $listphongban,
            'chotiepnhan' => $chotiepnhan,
            'dangxuly' => $dangxuly,
            'hethanhomnay' => $hethanhomnay,
            'hethantuannay' => $hethantuannay,
            'dahethan' => $dahethan,
            'stats' => (object) $stats
        ]);
    }

}
/*
 *
 * Helper
 *
 * */

