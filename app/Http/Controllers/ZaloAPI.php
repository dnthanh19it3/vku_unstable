<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Zalo\Zalo;
use Zalo\Builder\MessageBuilder;
use Zalo\ZaloEndPoint;
use Illuminate\Support\Facades\DB;

class ZaloAPI extends Controller
{
    const BASE_URL = 'https://openapi.zalo.me';
    const ZALO_ACCESS_TOKEN = 'c0zYIWSCA5-H3sH220uhKPSER5fiJI1BfYzk8rnmScctEKeZHr5PGQKxT5PcNZW2Z04H46jcBcMe83eoD2KCSjz-C3iI87zH-dzIDJyPM4NHHq1KC4PDDVioGcXbS0HWd118FLnGK6x3KaCF1JGBO-WnCG0KTIjcmGCP0JnqKqBQQLKtM2bZ8yugPp8sV4DFsXLR1Jji47hT42qQBLbaQB4TS7XHOLGCqsXYMp5lA3hGA61p2YWgPvOl671WTYmFcpGMJmHcBJFU939r66Gc9_y5O4muT6slC7ub114fLm';


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


    public function getDanhSachTheoDoi()
    {


    }

    public function guiTinNhanText($user_id)
    {
        $msgBuilder = new MessageBuilder('text');
        $msgBuilder->withUserId($user_id);
        $msgBuilder->withText('Tính năng này đang được xây dựng và sẽ sớm có mặt trên cổng thôn tin VKU!');


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


    function callback_1(Request $request){
        return "200";
    }
    function callback(Request $request){
        $store = DB::table('table_zalo_callback')->insert(['body' => $request->getContent()]);

        $data = json_decode($request->getContent());

        $content_key = $data->message->text;
        DB::table('table_zalo_callback')->insert(['body' => $content_key]);

        switch ($content_key) {
            case "#tuyensinh":
            case "#sinhvien":
                DB::table('table_zalo_callback')->insert(['body' => $this->guiTinNhanText($data->sender->id)]);
//            DB::table('table_zalo_callback')->insert(['body' => $this->chamSocPhuHuynh($data->sender->id)]);
                break;
            case "#phuhuynh":
                DB::table('table_zalo_callback')->insert(['body' => $this->chamSocPhuHuynh($data->sender->id)]);
                break;
        }

        return response(200);
    }
}
