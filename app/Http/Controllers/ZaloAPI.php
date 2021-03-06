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
            $this->guiTinNhanText($user_id, "T??i kho???n c???a b???n ???? ???????c k???t n???i v???i Zalo OA");
            return  "???? ???????c c???p nh???t";
        } else {
            return "S??? ??i???n tho???i ch??a ???????c ????ng k?? tr??n h??? th???ng. Vui l??ng ki???m tra l???i!";
        }
    }


    public function guilienKetTaiKhoan($uid){
        $msgBuilder = new MessageBuilder('list');
        $msgBuilder->withUserId($uid);
        $msgBuilder->withText("Hehe");

        $actionOpenUrl = $msgBuilder->buildActionOpenURL(route('zalo.linkpage'));
        $msgBuilder->withElement('Li??n k???t v???i OA', 'https://lh3.googleusercontent.com/proxy/VsefwbMr0Dbl8BZ8-V_P37ogR3kDTlPcvg-9pk3nqTD4ldADR2pZo5kHxuZ7i9uLi00NN__nmD7BUbeBcitt-ky0ETdixTzj3iF9yJz15Dugvzq7', '????? tra c???u th??ng tin b???n c???n ph???i li??n k???t v???i VKU OA. ???n v??o ????y ti???n h??nh ????? li??n k???t', $actionOpenUrl);

        $actionOpenSMS = $msgBuilder->buildActionOpenURL("https://google.com");
        $msgBuilder->withElement('Tr??? gi??p', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/faqs.png?alt=media&token=6ab31658-89f2-4cd7-bebe-982470bca4b0', '', $actionOpenSMS);

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
        $msgBuilder->withElement('?????i h???c CNTT v?? Truy???n th??ng Vi???t H??n', 'http://vku.udn.vn/nhaphoc2020/thutuc_nhaphoc.jpg', 'Trang ch???', $actionOpenUrl);

        $actionQueryShow = $msgBuilder->buildActionQueryShow('Xem ??i???m sinh vi??n');
        $msgBuilder->withElement('Xem ??i???m sinh vi??n', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/paper.png?alt=media&token=76404974-e310-45fc-923c-47b8101d6466', '', $actionQueryShow);

        $actionQueryHide = $msgBuilder->buildActionQueryHide('Xem h???c ph?? ???? ????ng');
        $msgBuilder->withElement('Tra c???u h???c ph??', 'https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/invoice.png?alt=media&token=e84e0019-25a5-4a4d-9095-256beb5716af', '', $actionQueryHide);

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
        echo "<hr/>Xin info t??? ng?????i d??ng";
    }

    /**
     * Follow Event
     * @param $data Object D??? li???u t??? hook
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
            $this->guiTinNhanText($user_info['user_id'], "B???n ???? li??n k???t th??nh c??ng v???i C???ng th??ng tin VKU! T??? b??y gi??? b???n c?? th??? th???c hi???n ???????c c??c ch???c n??ng nh??");
        }
    }
    /**
     *
     */
    function  getHocKy($hienhanh){
        // Hi???n h??nh
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




        $diem = "???????????? K???t qu??? h???c t???p c???a b???n l??:\n???? Thang 4: " . $response_t4 . "\n" . "4??????Thang 10: " . $response_t10;

        $response_t4 = (float) $response_t4;
        if($response_t4 > 3.19){
            $tips = "???? B???n ?????t h???c l???c gi???i trong k?? n??y. Ch??c b???n lu??n d???i d??o s???c kho??? v?? lu??n ?????t ???????c th??nh t??ch cao trong h???c t???p";
        } elseif ($response_t4 > 2.2 && $diem_t4 < 3.2){
            $tips = "???? B???n ?????t h???c l???c kh?? trong k?? n??y. Ch??c b???n lu??n d???i d??o s???c kho??? v?? v?? ?????t ???????c th??nh t??ch cao h??n trong t????ng l???i nh??";
        } elseif ($response_t4 < 2.2){
            $tips = "???? B???n ?????t ???????c h???c l???c trung b??nh trong h???c k?? n??y. B???n c???n c??? g???ng nhi???u h??n ????? ?????t ???????c th??nh t??ch t???t trong h???c k?? ti???p theo nh??";
        }

        $this->guiTinNhanText($uid, $diem);
        $this->guiTinNhanText($uid, $tips);
    }

    function traCuuLichHocNgay($uid, $masv)
    {

        $ketqua = json_decode(file_get_contents("json_test/tkb_ngay.json"));
//        dump($ketqua);
        $text = "???? L???ch h???c ng??y h??m nay c???a b???n nh?? sau\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text = $text . "Ti???t " . $value->tiet . ": " . $value->mon . " [" . $value->phong . "]\n";
            }
        } else {
            $text = "B???n kh??ng c?? l???ch h???c h??m nay";
        }

//        dump($text);

        $this->guiTinNhanText($uid, $text);

    }
    function traCuuLichHocTuan($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/tkb_tuan.json"));
        $text = "???? L???ch h???c tu???n n??y c???a b???n\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text = $text . " " .$this->returnDayIcon($value->thu) . " Th??? ". $value->thu . " \n";
                foreach ($value->lich as $key2 => $value2){
                    $text = $text . "Ti???t " . $value2->tiet . ": " . $value2->mon . " [" . $value2->phong . "]\n";
                }

            }
        } else {
            $text = "B???n kh??ng c?? l???ch h???c h??m nay";
        }
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuHocVu($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/hocvu.json"));
        $text = "???? K???t qu??? x??t h???c v??? c???a b???n\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text .= $this->returnDayIcon($value->hocky) . " H???c k??? " . $value->hocky . " N??m h???c " . $value->namhoc. ": " . $value->thang4 . " - " . $value->thang10. " - " . $value->xeploai ."\n";
            }
        } else {
            $text = "Kh??ng c?? k???t qu??? x??t h???c v???";
        }
//        dd($text);
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuRenLuyen($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/renluyen.json"));
        $text = "???? K???t qu??? x??t r??n luy???n c???a b???n\n_________________\n";
        if($ketqua){
            foreach ($ketqua as $key => $value){
                $text .= $this->returnDayIcon($value->hocky) . " H???c k??? " . $value->hocky . " N??m h???c " . $value->namhoc. ": " . $value->diem . " - " . $value->xeploai ."\n";
            }
        } else {
            $text = "Kh??ng c?? k???t qu??? x??t r??n luy???n";
        }
//        dd($text);
        $this->guiTinNhanText($uid, $text);
    }

    function traCuuHocPhi($uid, $masv)
    {
        $ketqua = json_decode(file_get_contents("json_test/hocphi.json"));
        $text = "???? Th??ng tin h???c ph?? c???a b???n nh?? sau:\n_________________\n";
        if($ketqua){
           $text .= "T???ng s??? t??n ch??? ????ng k?? " . $ketqua->sotinchi . "\n" . "T???ng thu: " . $ketqua->hocphi . "VN??\n" .
               "Tr???ng th??i: " .$ketqua->trangthai;
           if($ketqua->ngaynop){
               $text .= "\n Ng??y n???p:" . $ketqua->ngaynop;
           }
        } else {
            $text = "Kh??ng c?? th??ng tin h???c ph??";
        }
        $this->guiTinNhanText($uid, $text);
    }


    function returnDayIcon($day){
        switch ($day){
            case "2":
                return "2??????";
            case "3":
                return "3??????";
            case "4":
                return "4??????";
            case "5":
                return "5??????";
            case "6":
                return "6??????";
            case "7":
                return "7??????";
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

                $msgBuilder->withText('N??m h???c ' . $item['namhoc']);

                foreach ($item['hocky'] as $key2 => $item2){
                    $msgBuilder->withButton("H???c k??? $item2->hocky", $msgBuilder->buildActionQueryHide("#tracuudiem|$item2->id|$item2->hocky"));
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
                            $this->guiTinNhanText($zalo_uid, "M???i b???n ch???n h???c k?? mu???n tra c???u");
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
                    $this->guiTinNhanText($zalo_uid, "T??nh n??ng tra c???u l???ch thi ??ang ???????c ph??t tri???n!");
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
                        $this->guiTinNhanText($zalo_uid, "Ta?? kho???n c???a b???n ???? ???????c li??n k???t v???i VKU OA tr?????c ????!");
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
                    $data->message->text = $predict_result; //Ouput: H???c ph??
                    ZaloAPI::guiTinNhanText($zalo_uid, $data->message->text);
                    ZaloAPI::userSendText($data);
                }
            } else {
                $output = "?????i tho???i";
                ZaloAPI::guiTinNhanText($zalo_uid, "?????i tho???i");
            }
        }
    }

    // Get d??? ??o??n t??? API
    function  aiSolve($msg){
        // Hi???n h??nh
        $output= null;

        $client = new Client();
        $client_url = "http://localhost:5000/predict?msg=" . $msg;
        $response_raw = $client->get($client_url)->getBody()->getContents();
        $predict_result = json_decode($response_raw);
        return $predict_result;
    }
    // Nh???n data t??? hook
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

    // Get h???c k??? theo nh??m
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