<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Zalo\Builder\MessageBuilder;
use Zalo\Exceptions\ZaloAuthenticationException;
use Zalo\Exceptions\ZaloClientException;
use Zalo\Exceptions\ZaloOAException;
use Zalo\Exceptions\ZaloOtherException;
use Zalo\Exceptions\ZaloSDKException;
use Zalo\Zalo;
use Zalo\ZaloEndPoint;
use GuzzleHttp\Client;
use Carbon\Carbon;

class ZaloAPI extends Controller
{



    const BASE_URL = 'https://openapi.zalo.me';
    const ZALO_ACCESS_TOKEN = 'c0zYIWSCA5-H3sH220uhKPSER5fiJI1BfYzk8rnmScctEKeZHr5PGQKxT5PcNZW2Z04H46jcBcMe83eoD2KCSjz-C3iI87zH-dzIDJyPM4NHHq1KC4PDDVioGcXbS0HWd118FLnGK6x3KaCF1JGBO-WnCG0KTIjcmGCP0JnqKqBQQLKtM2bZ8yugPp8sV4DFsXLR1Jji47hT42qQBLbaQB4TS7XHOLGCqsXYMp5lA3hGA61p2YWgPvOl671WTYmFcpGMJmHcBJFU939r66Gc9_y5O4muT6slC7ub114fLm';
    const SINHVIEN = 1;
    const PHUHUYNH = 0;
    public $zalo;




    function __construct()
    {
        $config = array(
            'app_id' => '58034093286116009',
            'app_secret' => 'X8JdN422NPeU5T71HQq1',
            'callback_url' => 'https://www.callback.com'
        );
        $this->zalo = new Zalo($config);
    }
    public function linkPage(){
        return view("Khach.Zalo.LinkPage");
    }
    public function linkPagePost(Request $request){
        $phone = (int) $request->phone;

        $checkSinhVien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_sinhvien_chitiet.dienthoai', $phone)
            ->first();

        if($checkSinhVien != null){
           $user_data = ZaloAPI::getThongTinNguoiDung($request->phone);
           $user_id = $user_data['user_id'];

           $tontai = DB::table('table_zalo_connect')->where('masv', $checkSinhVien->masv)->first();

            if ($tontai != null) {
                $update = DB::table('table_zalo_connect')
                    ->where('masv', $checkSinhVien->masv)
                    ->update([
                        'zalo_id_sinhvien' => $user_id,
                        'updated_at' => Carbon::now()
                    ]);
            } else {
                $insert = DB::table('table_zalo_connect')->insert([
                    'masv' => $checkSinhVien->masv,
                    'zalo_id_sinhvien' => $user_id,
                    'created_at' => Carbon::now()
                ]);
            }
            $this->guiTinNhanText($user_id, "Tài khoản của bạn đã được kết nối với Zalo OA");
            return  "Đã được cập nhật";
        } else {
            return "Số điện thoại chưa được đăng kí trên hệ thống. Vui lòng kiểm tra lại!";
        }
    }


    public function guilienKetTaiKhoan($uid){
        $msgBuilder = new MessageBuilder('list');
        $msgBuilder->withUserId($uid);
        $msgBuilder->withText("Hehe");

        $actionOpenUrl = $msgBuilder->buildActionOpenURL(route('zalo.linkpage'));
        $msgBuilder->withElement('Liên kết với OA', 'https://lh3.googleusercontent.com/proxy/VsefwbMr0Dbl8BZ8-V_P37ogR3kDTlPcvg-9pk3nqTD4ldADR2pZo5kHxuZ7i9uLi00NN__nmD7BUbeBcitt-ky0ETdixTzj3iF9yJz15Dugvzq7', 'Để tra cứu thông tin bạn cần phải liên kết với VKU OA. Ấn vào đây tiến hành để liên kết', $actionOpenUrl);

        $actionOpenSMS = $msgBuilder->buildActionOpenURL("https://google.com");
        $msgBuilder->withElement('Trợ giúp', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/faqs.png?alt=media&token=6ab31658-89f2-4cd7-bebe-982470bca4b0', '', $actionOpenSMS);

        $msgList = $msgBuilder->build();
        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgList);
        $result = $response->getDecodedBody(); // result
        return $result;
    }


    public function getDanhSachTheoDoi()
    {

    }

    public function guiTinNhanText($user_id, $content)
    {
//        $msgBuilder = new MessageBuilder('text');
//        $msgBuilder->withUserId($user_id);
//        $msgBuilder->withText($content);
//
//        $msgText = $msgBuilder->build();
//        // send request
//        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgText);
//        $result = $response->getDecodedBody(); // result





        return response("OK", 200);
    }

    public function chamSocPhuHuynh($user_id)
    {
        $msgBuilder = new MessageBuilder('list');
        $msgBuilder->withUserId($user_id);
        $msgBuilder->withText("");

        $actionOpenUrl = $msgBuilder->buildActionOpenURL('http://www.vku.udn.vn');
        $msgBuilder->withElement('Đại học CNTT và Truyền thông Việt Hàn', 'http://vku.udn.vn/nhaphoc2020/thutuc_nhaphoc.jpg', 'Trang chủ', $actionOpenUrl);

        $actionQueryShow = $msgBuilder->buildActionQueryShow('Xem điểm sinh viên');
        $msgBuilder->withElement('Xem điểm sinh viên', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/paper.png?alt=media&token=76404974-e310-45fc-923c-47b8101d6466', '', $actionQueryShow);

        $actionQueryHide = $msgBuilder->buildActionQueryHide('Xem học phí đã đóng');
        $msgBuilder->withElement('Tra cứu học phí', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/invoice.png?alt=media&token=e84e0019-25a5-4a4d-9095-256beb5716af', '', $actionQueryHide);

        $actionOpenPhone = $msgBuilder->buildActionOpenPhone('0919018791');
        $msgBuilder->withElement('Open Phone', 'https://cdn.iconscout.com/icon/premium/png-256-thumb/phone-275-123408.png', '', $actionOpenPhone);

        $actionOpenSMS = $msgBuilder->buildActionOpenSMS('0919018791', 'sms text');
        $msgBuilder->withElement('Open SMS', 'https://cdn0.iconfinder.com/data/icons/new-design/512/42-Chat-512.png', '', $actionOpenSMS);


        $msgList = $msgBuilder->build();

        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgList);
        $result = $response->getDecodedBody(); // result
        return $result;
    }

    function getThongTinNguoiDung($phone)
    {
        $data = [
            'data' => json_encode(array('user_id' => $phone))
        ];
        $response = $this->zalo->get(ZaloEndpoint::API_OA_GET_USER_PROFILE, self::ZALO_ACCESS_TOKEN, $data);
        $user_info = $response->getDecodedBody();

        if($user_info['error'] == 0){
            return $user_info['data'];
        }
        return false;
    }

    function requestSharedInfo($uid)
    {
        echo "<hr/>Xin info từ người dùng";
    }

    /**
     * Follow Event
     * @param $data Object Dữ liệu từ hook
     */
    function followEvent($data)
    {

    }

    function userSubmitInfoEvent($inputData)
    {
        $data = ['data' => json_encode(array(
            'user_id' => $inputData->user_id_by_app
        ))];

        $response = $this->zalo->get(ZaloEndpoint::API_OA_GET_USER_PROFILE, self::ZALO_ACCESS_TOKEN, $data);
        $user_info = $response->getDecodedBody()['data'];
        $tempPhone = trim($user_info['shared_info']['phone']);
        $phone = "";

        if (str_starts_with($tempPhone, "84")) {
            $phone = "0" . ltrim($tempPhone, "84");
        } else {
            $phone = $tempPhone;
        }

        $checkSinhVien = DB::table('table_sinhvien')
            ->join('table_sinhvien_chitiet', 'table_sinhvien.masv', '=', 'table_sinhvien_chitiet.masv')
            ->where('table_sinhvien_chitiet.dienthoai', $phone)
            ->first();

        if ($checkSinhVien != null) {
            $tontai = DB::table('table_zalo_connect')->where('masv', $checkSinhVien->masv)->first();

            if ($tontai != null) {
                $update = DB::table('table_zalo_connect')
                    ->where('masv', $checkSinhVien->masv)
                    ->update([
                        'zalo_id_sinhvien' => $user_info['user_id'],
                        'updated_at' => Carbon::now()
                    ]);
            } else {
                $insert = DB::table('table_zalo_connect')->insert([
                    'masv' => $checkSinhVien->masv,
                    'zalo_id_sinhvien' => $user_info['user_id'],
                    'created_at' => Carbon::now()
                ]);
            }
            $this->guiTinNhanText($user_info['user_id'], "Bạn đã liên kết thành công với Cổng thông tin VKU! Từ bây giờ bạn có thể thực hiện được các chức năng như");
        }
    }
    /**
     *
     */
    function  getHocKy($hienhanh){
        // Hiện hành
        $output= null;
        $client = new Client();
        $hocky_url = "http://daotao.vku.udn.vn/api/get_namhochocky";
        $response_hocky = $client->get($hocky_url)->getBody()->getContents();
        $hocky_array = json_decode($response_hocky);

        if($hocky_array){
            if($hienhanh){
                foreach ($hocky_array as $key => $item){
                    if($item->hienhanh == 1){
                        return [$item];
                    }                }
            } else {
                return $hocky_array;
            }
        }


        return null;
    }

    function traCuuDiem($uid, $masv, $namhoc = null, $hocky = null)
    {
        $tips = "";
        $hocluc = "";
        $client = new Client();

        $diem_t4 = "http://daotao.vku.udn.vn/api/diem_sv?namhoc=$namhoc&hocky=$hocky&masv=$masv";
        $diem_t10 = "http://daotao.vku.udn.vn/api/diem_sv_t10?namhoc=$namhoc&hocky=$hocky&masv=$masv";

        $response_t4 = $client->get($diem_t4)->getBody()->getContents();
        $response_t10 = $client->get($diem_t10)->getBody()->getContents();




        $diem = "🔔🔔🔔 Kết quả học tập của bạn là:\n🔟 Thang 4: " . $response_t4 . "\n" . "4️⃣Thang 10: " . $response_t10;

        $response_t4 = (float) $response_t4;
        if($response_t4 > 3.19){
            $tips = "😇 Bạn đạt học lực giỏi trong kì này. Chúc bạn luôn dồi dào sức khoẻ và luôn đạt được thành tích cao trong học tập";
        } elseif ($response_t4 > 2.2 && $diem_t4 < 3.2){
            $tips = "😎 Bạn đạt học lực khá trong kì này. Chúc bạn luôn dồi dào sức khoẻ và và đạt được thành tích cao hơn trong tương lại nhé";
        } elseif ($response_t4 < 2.2){
            $tips = "😂 Bạn đạt được học lực trung bình trong học kì này. Bạn cần cố gắng nhiều hơn để đạt được thành tích tốt trong học kì tiếp theo nhé";
        }

        $this->guiTinNhanText($uid, $diem);
        $this->guiTinNhanText($uid, $tips);
    }

    function traCuuLichHocNgay($uid, $masv)
    {

        $ketqua = json_decode(file_get_contents("json_test/tkb_ngay.json"));
//        dump($ketqua);
        $text = "📅 Lịch học ngày hôm nay của bạn như sau\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text = $text . "Tiết " . $value->tiet . ": " . $value->mon . " [" . $value->phong . "]\n";
            }
        } else {
            $text = "Bạn không có lịch học hôm nay";
        }

//        dump($text);

        $this->guiTinNhanText($uid, $text);

    }
    function traCuuLichHocTuan($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/tkb_tuan.json"));
        $text = "📅 Lịch học tuần này của bạn\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text = $text . " " .$this->returnDayIcon($value->thu) . " Thứ ". $value->thu . " \n";
                foreach ($value->lich as $key2 => $value2){
                    $text = $text . "Tiết " . $value2->tiet . ": " . $value2->mon . " [" . $value2->phong . "]\n";
                }

            }
        } else {
            $text = "Bạn không có lịch học hôm nay";
        }
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuHocVu($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/hocvu.json"));
        $text = "📅 Kết quả xét học vụ của bạn\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text .= $this->returnDayIcon($value->hocky) . " Học kỳ " . $value->hocky . " Năm học " . $value->namhoc. ": " . $value->thang4 . " - " . $value->thang10. " - " . $value->xeploai ."\n";
            }
        } else {
            $text = "Không có kết quả xét học vụ";
        }
//        dd($text);
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuRenLuyen($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/renluyen.json"));
        $text = "📅 Kết quả xét rèn luyện của bạn\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text .= $this->returnDayIcon($value->hocky) . " Học kỳ " . $value->hocky . " Năm học " . $value->namhoc. ": " . $value->diem . " - " . $value->xeploai ."\n";
            }
        } else {
            $text = "Không có kết quả xét rèn luyện";
        }
//        dd($text);
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuHocPhi($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/hocphi.json"));
        $text = "📝 Thông tin học phí của bạn như sau:\n_________________\n";
        if($ketqua){
           $text .= "Tổng số tín chỉ đăng kí " . $ketqua->sotinchi . "\n" . "Tổng thu: " . $ketqua->hocphi . "VNĐ\n" .
               "Trạng thái: " .$ketqua->trangthai;
           if($ketqua->ngaynop){
               $text .= "\n Ngày nộp:" . $ketqua->ngaynop;
           }
        } else {
            $text = "Không có thông tin học phí";
        }
        $this->guiTinNhanText($uid, $text);
    }


    function returnDayIcon($day){
        switch ($day){
            case "2":
                return "2️⃣";
            case "3":
                return "3️⃣";
            case "4":
                return "4️⃣";
            case "5":
                return "5️⃣";
            case "6":
                return "6️⃣";
            case "7":
                return "7️⃣";
            default:
                return "";
        }
    }

    function traCuuDiemShowList($uid){
        $hocky = $this->getListHocKy();
        if($hocky != null){
            foreach ($hocky as $key => $item){
                // build data
                $msgBuilder = new MessageBuilder('text');
                $msgBuilder->withUserId($uid);

                $msgBuilder->withText('Năm học ' . $item['namhoc']);

                foreach ($item['hocky'] as $key2 => $item2){
                    $msgBuilder->withButton("Học kỳ $item2->hocky", $msgBuilder->buildActionQueryHide("#tracuudiem|$item2->id|$item2->hocky"));
                }


                $msgText = $msgBuilder->build();
                // send request
                $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgText);
                $result = $response->getDecodedBody(); // result
            }
        }
    }

    //Helper
    function writeDebugHook($data)
    {
        try {
            file_put_contents('data.json', $data . PHP_EOL, FILE_APPEND);
        } catch (Exception $exception) {
            return;
        }
    }

    //EventSolve
    function userSendText($data)
    {
        $zalo_uid = $data->sender->id;
        $message = $data->message->text;

        if(str_starts_with($message, '#')){
            switch ($message){
                case str_starts_with($message, "#tracuudiem"):
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    $hocky = null;
                    if($sinhvien != null){
                        $chitiet = explode("|", $message);
                        if(count($chitiet) == 3){
                            $this->traCuuDiem($zalo_uid, $sinhvien->masv, $chitiet[1], $chitiet[2]);
                        } elseif (count($chitiet) == 2){
                            $hocky = $this->getHocKy(1)[0];
                            $this->traCuuDiem($zalo_uid, $sinhvien->masv, $hocky->id, $hocky->hocky);
                        } elseif (count($chitiet) == 1){
                            $this->guiTinNhanText($zalo_uid, "Mời bạn chọn học kì muốn tra cứu");
                            $this->traCuuDiemShowList($zalo_uid);
                        }

                    } else {
                        $this->guilienKetTaiKhoan($zalo_uid);
                    }
                    break;
                case "#lichhochomnay":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuLichHocNgay($zalo_uid, $sinhvien->masv);
                    }
                    break;
                case "#lichhoctuan":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuLichHocTuan($zalo_uid, $sinhvien->masv);
                    }
                    break;
                case "#hocphi":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuHocPhi($zalo_uid, $sinhvien->masv);
                    }
                    break;
                case "#tracuulichthi":
                    $this->guiTinNhanText($zalo_uid, "Tính năng tra cứu lịch thi đang được phát triển!");
                    break;
                case "#ketquahocvu":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuHocVu($zalo_uid, $sinhvien->masv);
                    }
                    break;
                case "#ketquarenluyen":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuRenLuyen($zalo_uid, $sinhvien->masv);
                    }
                    break;
                case "#lienket":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->guiTinNhanText($zalo_uid, "Taì khoản của bạn đã được liên kết với VKU OA trước đó!");
                    } else {
                        $this->guilienKetTaiKhoan($zalo_uid);
                    }
                    break;
                case "#huongdan":

                    break;
            }
        } else {
            $request_result = ZaloAPI::aiSolve($message);
            ZaloAPI::guiTinNhanText($zalo_uid, $request_result->response);

            $output = null;
            if($request_result){
                if($request_result->type){
                    $predict_result = $request_result->class[0][0];
                    $data->message->text = $predict_result; //Ouput: Học phí
                    ZaloAPI::guiTinNhanText($zalo_uid, $data->message->text);
                    ZaloAPI::userSendText($data);
                }
            } else {
                $output = "Đối thoại";
                ZaloAPI::guiTinNhanText($zalo_uid, "Đối thoại");
            }
        }
    }

    // Get dự đoán từ API
    function  aiSolve($msg){
        // Hiện hành
        $output= null;

        $client = new Client();
        $client_url = "http://localhost:5000/predict?msg=" . $msg;
        $response_raw = $client->get($client_url)->getBody()->getContents();
        $predict_result = json_decode($response_raw);
        return $predict_result;
    }
    // Nhận data từ hook
    function hook(Request $request)
    {
        $data = json_decode($request->getContent());
        $event = $data->event_name;
        try {
            switch ($event) {
                case "follow":
                    $this->followEvent($data);
                    break;
                case "user_submit_info":
                    $this->userSubmitInfoEvent($data);
                    break;
                case "user_send_text":
                    $this->userSendText($data);
                    break;
            }
        } catch (\Exception $e) {
            $this->writeDebugHook($e);
            return response(200);
        } catch (ZaloAuthenticationException $e) {
            $this->writeDebugHook($e);
            return response(200);
        } catch (ZaloSDKException $e) {
            $this->writeDebugHook($e);
            return response(200);
        } catch (ZaloClientException $e) {
            $this->writeDebugHook($e);
            return response(200);
        } catch (Zalo\ZaloOAException $e) {
            $this->writeDebugHook($e);
            return response(200);
        }
        return response(200);
    }

    // Get học kỳ theo nhóm
    function getListHocKy(){
        $hocky_list = $this->getHocKy(0);
        $list_namhoc = [];
        foreach ($hocky_list as $hocky){
            $temp = ['namhoc_id' => $hocky->id, "hocky" => [], "namhoc" => $hocky->nambatdau ."-".$hocky->namketthuc];
            foreach ($hocky_list as $key_con => $hocky_con){
                if($hocky_con->id == $temp["namhoc_id"]){
                    array_push($temp["hocky"], $hocky_con);
                    unset($hocky_list[$key_con]);
                }
            }
            array_push($list_namhoc, $temp);
        }
        foreach ($list_namhoc as $key => $item){
            if(count($item['hocky']) == 0){
                unset($list_namhoc[$key]);
            }
        }
        return $list_namhoc;
    }
    function test(Request $request){
//
        $this->traCuuHocVu('ABC', "123");
    }

}

/*
 //http://daotao.vku.udn.vn/api/get_namhochocky

//http://daotao.vku.udn.vn/api/diem_sv?namhoc=4&hocky=1&masv=17IT044

//http://daotao.vku.udn.vn/api/diem_sv_t10?namhoc=4&hocky=1&masv=17IT044

//http://daotao.vku.udn.vn/api/gvcn_list

//http://daotao.vku.udn.vn/api/gvcn_list/1

//daotao.vku.udn.vn/api/sv/phbinh.17it2@vku.udn.vn
 *
 * */