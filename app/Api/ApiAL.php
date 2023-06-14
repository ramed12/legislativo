<?php

namespace App\Api;

Class  ApiAL{

// protected $username = env('USER_API_LOGIN');
// protected $password = env('USER_API_PASSWORD');
// protected $id       = env('USER_API_ID');
// protected $secret   = env('USER_API_SECRET');

public function BearerReturn(){


        $id = "19_35rjq4o2l084w8cc4kcockc8osgwc848os0ow0k0800kcc08gc";
        $secret = "4t9tgwujy0owg4cskw0o44w8ggwggk00co08o4gwosc0o0gosk";
        $username = "03750189000128";
        $password = "arUAEE7Jb5Xm6yFRgj79yXtH";

        $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.al.mt.gov.br/oauth/v2/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=password&client_id={$id}&client_secret={$secret}&username={$username}&password={$password}",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/x-www-form-urlencoded",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
    }
}
