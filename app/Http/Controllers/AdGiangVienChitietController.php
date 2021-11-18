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

        $json = '[{"key":"","hinhthuc":"--"},{"key":"88","hinhthuc":"Bằng khen"},{"key":"92","hinhthuc":"Bằng khen"},{"key":"1","hinhthuc":"Bằng khen cấp Bộ"},{"key":"3","hinhthuc":"Bằng khen của Thủ tướng Chính phủ"},{"key":"2","hinhthuc":"Bằng khen của ủy ban Nhân dân Tỉnh"},{"key":"4","hinhthuc":"Bằng Lao động sáng tạo"},{"key":"5","hinhthuc":"Chiến sỹ thi đua cấp Bộ"},{"key":"94","hinhthuc":"Chiến sỹ thi đua cấp Bộ"},{"key":"6","hinhthuc":"Chiến sỹ thi đua cấp cơ sở"},{"key":"8","hinhthuc":"Chiến sỹ thi đua cấp tỉnh"},{"key":"7","hinhthuc":"Chiến sỹ thi đua cấp toàn quốc"},{"key":"9","hinhthuc":"Chiến sỹ Thi đua cấp trường"},{"key":"10","hinhthuc":"Giáo viên dạy giỏi cấp Bộ"},{"key":"12","hinhthuc":"Giáo viên dạy giỏi cấp Quận/Huyện"},{"key":"11","hinhthuc":"Giáo viên dạy giỏi cấp Tnh/Thành phố"},{"key":"16","hinhthuc":"Huân chương Chiến công giải phóng hạng 1"},{"key":"17","hinhthuc":"Huân chương Chiến công giải phóng hạng 2"},{"key":"18","hinhthuc":"Huân chương Chiến công giải phóng hạng 3"},{"key":"19","hinhthuc":"Huân chương Chiến công hạng 1"},{"key":"20","hinhthuc":"Huân chương Chiến công hạng 2"},{"key":"21","hinhthuc":"Huân chương chiến công hạng 3"},{"key":"22","hinhthuc":"Huân chương Chiến sỹ Giải phóng hạng 1"},{"key":"23","hinhthuc":"Huân chương Chiến sỹ Giải phóng hạng 2"},{"key":"24","hinhthuc":"Huân chương Chiến sỹ Giải phóng hạng 3"},{"key":"25","hinhthuc":"Huân chương Chiến sỹ vẻ vang hạng 1"},{"key":"26","hinhthuc":"Huân chương Chiến sỹ vẻ vang hạng 2"},{"key":"27","hinhthuc":"Huân chương Chiến sỹ vẻ vang hạng 3"},{"key":"28","hinhthuc":"Huân chương Chiến thắng hạng 1"},{"key":"29","hinhthuc":"Huân chương Chiến thắng hạng 2"},{"key":"30","hinhthuc":"Huân chương Chiến thắng hạng 3"},{"key":"31","hinhthuc":"Huân chương Giải phóng hạng 1"},{"key":"32","hinhthuc":"Huân chương Giải phóng hạng 2"},{"key":"33","hinhthuc":"Huân chương Giải phóng hạng 3"},{"key":"35","hinhthuc":"Huân chương Hồ Chí Minh"},{"key":"34","hinhthuc":"Huân chương Hữu nghị"},{"key":"36","hinhthuc":"Huân chương Kháng chiến  hạng 1"},{"key":"37","hinhthuc":"Huân chương Kháng chiến chống Mỹ hạng 1"},{"key":"38","hinhthuc":"Huân chương Kháng chiến chống Mỹ hạng 2"},{"key":"39","hinhthuc":"Huân chương Kháng chiến chống Mỹ hạng 3"},{"key":"40","hinhthuc":"Huân chương Kháng chiến chống Pháp hạng 1"},{"key":"41","hinhthuc":"Huân chương Kháng chiến chống Pháp hạng 2"},{"key":"42","hinhthuc":"Huân chương Kháng chiến chống Pháp hạng 3"},{"key":"43","hinhthuc":"Huân chương Kháng chiến hạng 1"},{"key":"44","hinhthuc":"Huân chương Kháng chiến hạng 2"},{"key":"45","hinhthuc":"Huân chương Kháng chiến hạng 2"},{"key":"46","hinhthuc":"Huân chương Kháng chiến hạng 3"},{"key":"47","hinhthuc":"Huân chương Kháng chiến hạng 3"},{"key":"48","hinhthuc":"Huân chương Lao động hạng 1"},{"key":"49","hinhthuc":"Huân chương Lao động hạng 2"},{"key":"50","hinhthuc":"Huân chương Lao động hạng 3"},{"key":"51","hinhthuc":"Huân chương Quân công giải phóng hạng 1"},{"key":"52","hinhthuc":"Huân chương Quân công giải phóng hạng 2"},{"key":"53","hinhthuc":"Huân chương Quân công giải phóng hạng 3"},{"key":"54","hinhthuc":"Huân chương Quân công hạng 1"},{"key":"55","hinhthuc":"Huân chương Quân công hạng 2"},{"key":"56","hinhthuc":"Huân chương Quân công hạng 3"},{"key":"57","hinhthuc":"Huân chương Quyết thắng hạng 1"},{"key":"58","hinhthuc":"Huân chương Quyết thắng hạng 2"},{"key":"59","hinhthuc":"Huân chương Quyết thắng hạng 3"},{"key":"60","hinhthuc":"Huân chương Sao vàng"},{"key":"61","hinhthuc":"Huân chương Thành đồng hạng 1"},{"key":"62","hinhthuc":"Huân chương Thành đồng hạng 2"},{"key":"63","hinhthuc":"Huân chương Thành đồng hạng 3"},{"key":"13","hinhthuc":"Huân chương Độc lập hạng 1"},{"key":"14","hinhthuc":"Huân chương Độc lập hạng 2"},{"key":"15","hinhthuc":"Huân chương Độc lập hạng 3"},{"key":"64","hinhthuc":"Huy chương Anh hùng Lao động"},{"key":"65","hinhthuc":"Huy chương Anh hùng LLVT giải phóng"},{"key":"66","hinhthuc":"Huy chương Anh hùng Lực lượng vũ trang"},{"key":"91","hinhthuc":"Huy chương chiến sĩ vẻ vang hạng ba"},{"key":"89","hinhthuc":"Huy chương chiến sĩ vẻ vang hạng nhất"},{"key":"90","hinhthuc":"Huy chương chiến sĩ vẻ vang hạng nhì"},{"key":"67","hinhthuc":"Huy chương Chiến sỹ giải phóng"},{"key":"68","hinhthuc":"Huy chương Chiến thắng hạng 1"},{"key":"69","hinhthuc":"Huy chương Chiến thắng hạng 2"},{"key":"70","hinhthuc":"Huy chương Giải phóng hạng 1"},{"key":"71","hinhthuc":"Huy chương Giải phóng hạng 2"},{"key":"72","hinhthuc":"Huy chương Kháng chiến chống Mỹ hạng 1"},{"key":"73","hinhthuc":"Huy chương Kháng chiến chống Mỹ hạng 2"},{"key":"74","hinhthuc":"Huy chương Kháng chiến chống Pháp hạng 1"},{"key":"75","hinhthuc":"Huy chương Kháng chiến chống Pháp hạng 2"},{"key":"76","hinhthuc":"Huy chương Quân giải phóng Việt nam"},{"key":"77","hinhthuc":"Huy chương Quân kỳ quyết thắng"},{"key":"78","hinhthuc":"Huy chương Quyết thắng"},{"key":"79","hinhthuc":"Huy chương Vì An ninh Tổ quốc"},{"key":"82","hinhthuc":"Huy chương Vì Sự nghiệp giải phóng phụ nữ"},{"key":"81","hinhthuc":"Huy chương Vì Sự nghiệp Giáo dục"},{"key":"83","hinhthuc":"Huy chương vì Sự nghiệp Ngoại giao"},{"key":"84","hinhthuc":"Huy chương Vì Sự nghiệp TDTT"},{"key":"85","hinhthuc":"Huy chương Vì Sự nghiệp Thanh tra"},{"key":"80","hinhthuc":"Huy chương Vì Sức khỏe nhân dân"},{"key":"86","hinhthuc":"Huy chương Vì Thế hệ trẻ"},{"key":"87","hinhthuc":"Kỷ niệm chương Tổ quốc ghi công"},{"key":"93","hinhthuc":"Kỷ niệm chương vị sự nghiệp giáo dục"}]';
        $khenthuong_obj = json_decode($json);

        foreach ($khenthuong_obj as $key => $obj){
            $khenthuong_obj[$key] = (array) $obj;
        }

        dump(DB::table('table_giangvien_dm_hinhthuckhenthuong')->insert((array) $khenthuong_obj));


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
