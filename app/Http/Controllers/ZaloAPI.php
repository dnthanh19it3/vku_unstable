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

    public function guiTinNhanText()
    {
        $msgBuilder = new MessageBuilder('list');
        $msgBuilder->withUserId('2450557789985135397');
        $msgBuilder->withText("");

        $actionOpenUrl = $msgBuilder->buildActionOpenURL('https://www.google.com');
        $msgBuilder->withElement('Open Link Google', 'https://img.icons8.com/bubbles/2x/google-logo.png', 'Search engine', $actionOpenUrl);

        $actionQueryShow = $msgBuilder->buildActionQueryShow('Xem điểm sinh viên');
        $msgBuilder->withElement('Xem điểm', 'https://www.computerhope.com/jargon/q/query.jpg', '', $actionQueryShow);

        $actionQueryHide = $msgBuilder->buildActionQueryHide('Xem học phí đã đóng');
        $msgBuilder->withElement('Query Xem học phí sinh viêni', 'https://www.computerhope.com/jargon/q/query.jpg', '', $actionQueryHide);

        $actionOpenPhone = $msgBuilder->buildActionOpenPhone('0919018791');
        $msgBuilder->withElement('Open Phone', 'https://cdn.iconscout.com/icon/premium/png-256-thumb/phone-275-123408.png', '', $actionOpenPhone);

        $actionOpenSMS = $msgBuilder->buildActionOpenSMS('0919018791', 'sms text');
        $msgBuilder->withElement('Open SMS', 'https://cdn0.iconfinder.com/data/icons/new-design/512/42-Chat-512.png', '', $actionOpenSMS);


        $msgList = $msgBuilder->build();
        $response = $this->zalo->post(ZaloEndpoint::API_OA_SEND_MESSAGE, self::ZALO_ACCESS_TOKEN, $msgList);
        $result = $response->getDecodedBody(); // result
        dd($result);
    }
    function callback(Request $request){
        $store = DB::table('table_zalo_callback')->insert(['body' => $request->message->text]);
        return response(200);
    }
}
