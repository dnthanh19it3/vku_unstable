<?php

use Illuminate\Http\Request;

    function pushNotify($flag){
        switch($flag){
            case 0:
                session()->put('code', '0');
                break;
            case 1:
                session()->put('code', '1');
                break;
        }
    }
    function pushNotifyTimeline($flag, $masv, $danhmuc, $tieude, $noidung, $thoigian){
        switch($flag){
            case 0:
                session()->put('code', '0');
                break;
            case 1:
                $update_timeline = DB::table('table_sinhvien_timeline')->insert([
                    'masv' => $masv,
                    'danhmuc' => $danhmuc,
                    'tieude' => $tieude,
                    'noidung' => $noidung,
                    'thoigian' => $thoigian,
                ]);
                if($update_timeline){
                    session()->put('code', '1');
                }
                break;
        }
    }

    function renderNotify(){
        $flag = session()->pull('code', null);
        if(isset($flag)){
            switch($flag){
                case 0:
                    return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Thất bại!</strong> Thao tác không thành công, vui lòng kiểm tra lại.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    break;
                case 1:
                    return '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Thành công!</strong> Thao tác của bạn vừa được thực hiện.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
                    break;
            }
        }
    }
    function notify($to, $notif)
    {
        $feilds = array('to' => $to, 'notification' => $notif);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($feilds));
        $headers = array();
        $headers[] = 'Authorization: Key=AAAAZQtZ74s:APA91bH7ZDLCyy2JQUOYyNidUd2IlR_wkEkWIOEShQS_y0aPWat8bMyLSW0SpatcxzlYp7WDknlbR5Y2oEDjjTl9yZNq1D_meE6VsG0ZkJmU6sTLaWb31VGpcl7qMBfv62fHGhIrg7Zk';
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
    // $notif['image'] = "https://firebasestorage.googleapis.com/v0/b/myvku-e6298.appspot.com/o/download%20(2).png?alt=media&token=a7f52f01-d966-47c7-86c1-a69fc79f63b0";
