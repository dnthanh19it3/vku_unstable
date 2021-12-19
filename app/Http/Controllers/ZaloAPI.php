<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Zalo\Builder\MessageBuilder;
use Zalo\Exceptions\ZaloOtherException;
use Zalo\Zalo;
use Zalo\ZaloEndPoint;
use GuzzleHttp\Client;

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
                        'updated_at' => now()
                    ]);
            } else {
                $insert = DB::table('table_zalo_connect')->insert([
                    'masv' => $checkSinhVien->masv,
                    'zalo_id_sinhvien' => $user_id,
                    'created_at' => now()
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
        $msgBuilder = new MessageBuilder('text');
        $msgBuilder->withUserId($user_id);
        $msgBuilder->withText($content);

        $msgText = $msgBuilder->build();
        // send request
        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgText);
        $result = $response->getDecodedBody(); // result
        return $result;
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
        $data = ['data' => json_encode(array(
            'user_id' => $phone
        ))];
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
                        'updated_at' => now()
                    ]);
            } else {
                $insert = DB::table('table_zalo_connect')->insert([
                    'masv' => $checkSinhVien->masv,
                    'zalo_id_sinhvien' => $user_info['user_id'],
                    'created_at' => now()
                ]);
            }
            $this->guiTinNhanText($user_info['user_id'], "Bạn đã liên kết thành công với Cổng thông tin VKU! Từ bây giờ bạn có thể thực hiện được các chức năng như");
        }
    }

    function  getHocKy(){
        // Hiện hành
        $output= null;

        $client = new Client();
        $hocky_url = "http://daotao.vku.udn.vn/api/get_namhochocky";
        $response_hocky = $client->get($hocky_url)->getBody()->getContents();
        $hocky_array = json_decode($response_hocky);
        $output = array_multisort(array_column($hocky_array, 'nambatdau'),  SORT_ASC,
            array_column($hocky_array, 'hocky'), SORT_ASC,
            $hocky_array);
        foreach ($hocky_array as $key => $item){
            if($item->hienhanh == 1){
                $tam = $hocky_array[$key - 1];
                if($tam->hocky == 3){
                    $output = $hocky_array[$key - 2];
                    break;
                } else {
                    $output = $tam;
                    break;
                }
            }
        }
        return $output;
    }

    function traCuuDiem($uid, $masv)
    {
        $hocky = ZaloAPI::getHocKy();
        ZaloAPI::getHocKy();
        $tips = "";
        $hocluc = "";
        $client = new Client();
        $diem_t4 = "http://daotao.vku.udn.vn/api/diem_sv?namhoc=$hocky->id&hocky=$hocky->hocky&masv=$masv";
        $diem_t10 = "http://daotao.vku.udn.vn/api/diem_sv_t10?namhoc=$hocky->id&hocky=$hocky->hocky&masv=$masv";
        $response_t4 = $client->get($diem_t4)->getBody()->getContents();
        $response_t10 = $client->get($diem_t10)->getBody()->getContents();




        $diem = "🔔🔔🔔 Kết quả học tập của bạn trong học kỳ $hocky->hocky năm học $hocky->nambatdau - $hocky->namketthuc là:\n🔟 Thang 4: $response_t4\n4️⃣Thang 10: $response_t10";

        $response_t4 = (float) $response_t4;
        if($response_t4 > 3.19){
            $tips = "😇 Bạn đạt học lực giỏi trong kì này. Chúc bạn luôn dồi dào sức khoẻ và luôn đạt được thành tích cao trong học tập và... suôn sẻ trong tình duyên nhé!";
        } elseif ($response_t4 > 2.2 && $diem_t4 <3.2){
            $tips = "😎 Bạn đạt học lực khá trong kì này. Chúc bạn luôn dồi dào sức khoẻ và và đạt được thành tích cao hơn trong tương lại nhé";
        } elseif ($response_t4 < 2.2){
            $tips = "😂 Bạn đạt được học lực trung bình trong học kì này. Bạn cần cố gắng nhiều hơn để đạt được thành tích tốt trong học kì tiếp theo nhé";
        }

        $this->guiTinNhanText($uid, $diem);
        $this->guiTinNhanText($uid, $tips);
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
                case "#tracuudiem":
                    $sinhvien = DB::table('table_zalo_connect')->where('zalo_id_sinhvien', $zalo_uid)->first();
                    if($sinhvien != null){
                        $this->traCuuDiem($zalo_uid, $sinhvien->masv);
                    } else {
                        $this->guilienKetTaiKhoan($zalo_uid);
                    }
                    break;
                case "#tracuulichhoc":
                    $this->guiTinNhanText($zalo_uid, "Tính năng đang được phát triển!");
                    break;
                case "#tracuuhocphi":
                    $this->guiTinNhanText($zalo_uid, "Tính năng đang được phát triển!");
                    break;
                case "#tracuulichthi":
                    $this->guiTinNhanText($zalo_uid, "Tính năng đang được phát triển!");
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
            $output = null;
            if($request_result){
                if($request_result->command){
                    $output = key((array) $request_result->response[0]);
                    $data->message->text = $output;
                    ZaloAPI::userSendText($data);
                }
            } else {
                $output = "Đối thoại";
                ZaloAPI::guiTinNhanText($zalo_uid, "Đối thoại");
            }
//            ZaloAPI::guiTinNhanText($zalo_uid, $output);
        }
    }


    function  aiSolve($msg){
        // Hiện hành
        $output= null;

        $client = new Client();
        $client_url = "http://localhost:5000/chatbot?msg=" . $msg;
        $response_raw = $client->get($client_url)->getBody()->getContents();
        $predict_result = json_decode($response_raw);
        return $predict_result;
    }

    function hook(Request $request)
    {
        $data = json_decode($request->getContent());
        $event = $data->event_name;


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

//        try {
//
//        } catch (\Exception $e) {
//            $this->writeDebugHook("Lỗi case Event");
//            return response(200);
//        }
//        return response(200);
    }
    function test(){
        $this->traCuuDiem(null, "19IT195");
    }
}
