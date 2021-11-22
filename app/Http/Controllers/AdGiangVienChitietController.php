<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp;

class AdGiangVienChitietController extends Controller
{
    function getInfo(){

        $json = '[{"key":"","kyluat":"--"},{"key":"1","kyluat":"Buộc thôi việc"},{"key":"2","kyluat":"Cảnh cáo"},{"key":"3","kyluat":"Cách chức"},{"key":"4","kyluat":"Hạ bậc"},{"key":"5","kyluat":"Hạ ngạch"},{"key":"6","kyluat":"Khai trừ Đảng"},{"key":"7","kyluat":"Khiển trách"}]';
        $obj = json_decode($json);
        $table = 'table_giangvien_dm_kyluat';
        Schema::dropIfExists($table);
        Schema::create($table, function (Blueprint $table) {
                    $table->increments('id');
                    $table->string('key');
                    $table->string('kyluat');
                    $table->timestamps();
                });

        foreach ($obj as $key => $item){
            $obj[$key] = (array) $item;
        }

        dd(DB::table($table)->insert((array) $obj));


//        $json = '[{"1":"Khoa học giáo dục và đào tạo giáo viên"},{"2":"Nghệ thuật"},{"3":"Kinh doanh và quản lý","4":"Pháp luật"},{"5":"Khoa học và sự sống","6":"Khoa học tự nhiên"},{"7":"Toán và thống kê","8":"Máy tính và công nghệ thông tin","9":"Công nghệ kỹ thuật","10":"Kỹ thuật","11":"Sản xuất và chế biến","12":"Kiến trúc và xây dựng","13":"Nông lâm nghiệp và thủy sản","14":"Thú y"},{"15":"Sức khỏe"},{"16":"Nhân văn","17":"Khoa học xã hội và hành vi","18":"Báo chí và thông tin","19":"Dịch vụ xã hội","20":"Du lịch, khách sạn, thể thao và dịch vụ cá nhân","21":"Dịch vụ vận tải","22":"Môi trường và bảo vệ môi trường","23":"An ninh, quốc phòng"}]';
//        $obj = json_decode($json);
//
//        foreach ($obj as $key1 => $value1){
//            foreach ($value1 as $key2 => $value2){
//                DB::table('table_giangvien_dm_linhvuc')->insert([
//                    'key' => $key2,
//                    'linhvuc' => $value2,
//                    'khoinganh' => $key1+1
//                ]);
//            }
//        }
//
//
//        dd("STOP");
//        $listngach = DB::table('table_giangvien_dm_ngachcc')->get();
//
//        $raw_json = file_get_contents("D:/input.json");
//        $array = json_decode($raw_json);
//        $new_array = [];
//        foreach ($array as $value){
//            array_push($new_array, $value[0]->Ngachcongchuc);
//        }
//        foreach ($new_array as $value){
//            foreach ($listngach as $ngach){
//                if($value->ten == $ngach->ngachcc){
//                    $value->mangach = $ngach->key;
//                }
//            }
//        }
//        $pure_ngach = [];
//
//        foreach ($listngach as $ngach){
//            $pure_ngach[$ngach->key] = [];
//        }
//
//        foreach ($pure_ngach as $key => $value){
//            foreach ($new_array as $ngach){
//                if($key == $ngach->mangach){
//                    array_push($pure_ngach[$key], $ngach);
//                    unset($value);
//                }
//            }
//        }
//        $last_output = [];
//        foreach ($pure_ngach as $ngach){
//            $common = (array) $ngach[0];
//            $temp = [
//                'tenlcc' => $common['tenlcc'],
//                'ten' => $common['ten'],
//                'mangach' => $common['mangach']
//            ];
//
//            for($i = 0; $i < 12; $i++){
//                foreach ($ngach[$i] as $key1 => $value1){
//                    if(str_starts_with($key1, 'bac') && $key1 != 'bac'){
//                        $temp[$key1] = $value1;
//                    }
//                }
//            }
//            array_push($last_output, $temp);
//        }
//        $insert = DB::table('table_giangvien_dm_bluong')->insert($last_output);
//
//        dd($last_output, $insert);
//        dd($last_output, $pure_ngach);

//        dd($cookie_obj);
//        $cookie_array = [];
//
//        foreach ($cookie_obj as $key => $value){
//            $cookie = [
//              [
//                  $value->name => $value->value
//              ], $value->domain
//            ];
//            array_push($cookie_array, $cookie);
//        }

//        dd($cookie_array);
//
//
//
//        $client = new GuzzleHttp\Client();
//        $cookieJar = CookieJar::fromArray(['hrm' => '3u2ncu12kjhnks63pe8uh02a24'], 'hrm.udn.vn');
//
//        foreach ($listngach as $ngach){
//            for ($i = 1; $i < 13; $i++){
//                $url = "http://hrm.udn.vn/users/getbacluong/$ngach->key/$i";
//                $res = $client->request('post', $url, ['cookies' => $cookieJar]);
//                dump($res->getStatusCode(), $res->getBody()->getContents(), $url);
//            }
//        }
//
//
//
//        dd($listngach);




        //Get to text area

//        $tables = DB::select('SHOW TABLES');
//        $list = [];
//
//        foreach($tables as $table)
//        {
//            foreach ($table as $tbl){
//                if(str_starts_with($tbl, 'table_giangvien_dm')){
//                    $output = [];
//                    preg_match_all('/table_giangvien_dm_(.*)/', $tbl, $output);
//
//                    array_push($list, [
//                        'varible' => $output[1][0],
//                        'table' => $output[0][0]
//                    ]);
//                }
//            }
//        }
//        foreach ($list as $item){
//
//            echo "<textarea style='width: 100%'>@foreach(\$dm['". $item['varible']. "'] as \$item)";
//            echo '<option value="{{$item->key}}">{{$item->'.$item['varible'] .'}}</option>';
//            echo "@endforeach<br/></textarea>";
//        }

        //end get to text area


//        foreach ($list as $item){
//            echo "$" .$item['varible'] . " = DB::table('".$item['table']."')->get();<br/>";
//        }
//        echo "<hr/>";
//        foreach ($list as $item){
//            echo "'".$item['varible'] . "' => $" .$item['varible'] .",<br/>";
//        }




//        $html = file_get_contents("select.json");
//        $fulllist = [];
//        foreach (json_decode($html) as $key => $value){
//            echo "$key - $value->name - <select>$value->html</select><hr/>";
//            $list = AdGiangVienChitietController::getItemByRegex($value->html, $value->name);
//            array_push($fulllist, $list);
//        }
//        dump($fulllist);
//        DB::beginTransaction();
//        $i = 1;
//        try {
//            foreach ($fulllist as $key => $value){
//                Schema::dropIfExists($value['table_name']);
//                Schema::create($value['table_name'], function (Blueprint $table) use ($value) {
//                    $table->increments('id');
//                    $table->string('key');
//                    $table->string($value['nametag']);
//                    $table->timestamps();
//                });
//                $i++;
//
//                $db_insert = [];
//
//                foreach ($value['object'][1] as $key_child => $value_child){
//                    $temp = [
//                        'key' => $value['object'][1][$key_child],
//                        $value['nametag'] => $value['object'][2][$key_child]
//                    ];
//                    array_push($db_insert, $temp);
//                }
//                dump($db_insert);
//
//                DB::table($value['table_name'])->insert($db_insert);
//            }
//            DB::commit();
//            echo "Đã thực hiện $i Task";
//        } catch (\Exception $e) {
//            DB::rollBack();
//            dump($e);
//            echo "Fail!";
//        }
    }

    function getItemByRegex($html, $name_tag){
        $regex = "/<option value=\"(.*)\"\>(.*)<\/option\>/";
        $regex_withid = "/data\[User]\[(.*)_id]/";
        $regex_common = "/data\[User]\[(.*)]/";
        $output = null;
        $output_nametag = "";
        preg_match_all($regex, $html, $output);
        unset($output[0]);
        if($output[1][0] == ""){unset($output[1][0]);};

        $temp_nametag = null;

        if(preg_match_all($regex_common, $name_tag, $temp_nametag)){
            if(preg_match_all($regex_withid, $name_tag, $temp_nametag)) {
                $output_nametag = $temp_nametag[1][0];
            } elseif(preg_match_all($regex_common, $name_tag, $temp_nametag)) {
                $output_nametag = $temp_nametag[1][0];
            }
        } else {
            $output_nametag = $name_tag;
        }

        $return = [
            'nametag' => $output_nametag,
            'table_name' => "table_giangvien_dm_" . $output_nametag,
            'object' => $output
        ];
        return $return;
    }
    function testui(){
        return view('testui');
    }
    function themNhanVien(){

    }

}
