<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Scalar\String_;

class ZaloAPI extends Controller
{
    const BASE_URL = 'https://openapi.zalo.me';
    const ZALO_ACCESS_TOKEN = 'c0zYIWSCA5-H3sH220uhKPSER5fiJI1BfYzk8rnmScctEKeZHr5PGQKxT5PcNZW2Z04H46jcBcMe83eoD2KCSjz-C3iI87zH-dzIDJyPM4NHHq1KC4PDDVioGcXbS0HWd118FLnGK6x3KaCF1JGBO-WnCG0KTIjcmGCP0JnqKqBQQLKtM2bZ8yugPp8sV4DFsXLR1Jji47hT42qQBLbaQB4TS7XHOLGCqsXYMp5lA3hGA61p2YWgPvOl671WTYmFcpGMJmHcBJFU939r66Gc9_y5O4muT6slC7ub114fLm';

    function sendZaloRequest($method, $uri, $body){
        $client = new Client([
            'base_uri' => self::BASE_URL
        ]);
        $headers = ['access_token' => self::ZALO_ACCESS_TOKEN];
        $response = $client->request($method, 'v2.0/oa/getfollowers', [
            'headers' => $headers,
            'body' => json_encode($body)
        ]);

        $result = $response->getBody()->read(10000);
        return $result;
    }

    public function getDanhSachTheoDoi()
    {
        $client = new Client([
            'base_uri' => self::BASE_URL
        ]);
        $headers = ['access_token' => self::ZALO_ACCESS_TOKEN];
        $body = (object)[
            'offset' => 1,
            'count' => 10
        ];

        $response = $client->request('GET', 'v2.0/oa/getfollowers', [
            'headers' => $headers,
            'body' => json_encode($body)
        ]);

        $result = $response->getBody()->read(10000);

    }
    public function guiTinNhanText()
    {

        $client = new Client([
            'base_uri' => self::BASE_URL
        ]);
        $headers = ['access_token' => self::ZALO_ACCESS_TOKEN];
        $body = (object)[
            'recipient' => [
                'user_id' => '2450557789985135397'
            ],
            'message' => [
                'text' => "Chào Thanh Đỗ. Đây là tin nhắn từ ZaloAPI"
            ]
        ];

        $response = $client->request('POST', 'v2.0/oa/message', [
            'headers' => $headers,
            'body' => json_encode($body)
        ]);

        $result = $response->getBody()->read(10000);
        dd($result);
    }
}
