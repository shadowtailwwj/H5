<?php
/**
 *公共函数库
 */


function curlRequest($url, $postData=array(), $isPost=false){
    if (empty($url)) {
        return false;
    }
    $postData = http_build_query($postData);
    if(!$isPost){
        $url = $url.'?'.$postData;
    }
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    if($isPost){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
    }
    $html = curl_exec($curl);
    curl_close($curl);
    return $html;
}



function getMd5(){

    $seqno = time();
    $apiid = 2;
    $ysid = 20170505011;
    $token =  urlencode('Token');
    $typeid = 1;
    $ip = urlencode('192.168.2.192');
    $clientid = 1;
    $sourceid = 6;
    $eipid = 1;
    $portid = 1103902;
    $isdes = 1;
    $return = urlencode('');
    $code = 0;
    $codemessage = urlencode('');
    $sendmessage = urlencode(json_encode([
        "SEND"      => '',
        "LISTID"    => '',
        "PAGEBASE"  => 10,
        "PAGEID"    =>  1,
        "PAGES"     =>  0,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => '=|loginid|gujiayao|;=|!password|123456|',
        "SORDERBY"  => '',
        "IP"        => '192.168.2.192',
        "SKEYS"     => ''
    ], JSON_UNESCAPED_UNICODE));
    $params  = '';
    $params .= "SEQNO:{$seqno};";
    $params .= "APIID:{$apiid};";
    $params .= "YSID:{$ysid};";
    $params .= "TOKEN:{$token};";
    $params .= "TYPEID:{$typeid};";
    $params .= "IP:{$ip};";
    $params .= "CLIENTID:{$clientid};";
    $params .= "EIPID:{$eipid};";
    $params .= "SOURCEID:{$sourceid};";
    $params .= "PORTID:{$portid};";
    $params .= "ISDES:{$isdes};";
    $params .= "SEND:{$sendmessage};";
    $params .= "RETURN:{$return};";
    $params .= "CODE:{$code};";
    $params .= "CODEMESSAGE:{$codemessage};";
    return $params;
}


function run1(){
    $seqno = time();
    $apiid = 2;
    $ysid = 20170505011;
    $token =  'Token';
    $typeid = 1;
    $ip = '192.168.2.192';
    $clientid = 1;
    $sourceid = 6;
    $eipid = 1;
    $portid = 1103902;
    $isdes = 1;
    $return = '';
    $code = 0;
    $codemessage = '';
    $md5 = strtoupper(MD5(getMd5()));
    $sendmessage = urlencode(json_encode([
        "SEND"      => '{"openid":"123123"}',
        "LISTID"    => '',
        "PAGEBASE"  => 10,
        "PAGEID"    =>  1,
        "PAGES"     =>  0,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => '=|loginid|gujiayao|;=|!password|123456|',
        "SORDERBY"  => '',
        "IP"        => '192.168.2.192',
        "SKEYS"     => ''
    ], JSON_UNESCAPED_UNICODE));
    $params  = '';
    $params .= "SEQNO:{$seqno};";
    $params .= "APIID:{$apiid};";
    $params .= "YSID:{$ysid};";
    $params .= "TOKEN:{$token};";
    $params .= "TYPEID:{$typeid};";
    $params .= "IP:{$ip};";
    $params .= "CLIENTID:{$clientid};";
    $params .= "EIPID:{$eipid};";
    $params .= "SOURCEID:{$sourceid};";
    $params .= "PORTID:{$portid};";
    $params .= "ISDES:{$isdes};";
    $params .= "SEND:{$sendmessage};";
    $params .= "RETURN:{$return};";
    $params .= "CODE:{$code};";
    $params .= "CODEMESSAGE:{$codemessage};";
    $params .= "MD5:{$md5};";
    return $params;
}

function toArray($data){
    $array = explode(';', $data);
    array_pop($array);
    $response = [];
    foreach ($array as $v) {
        $arr = [];
        $arr = explode(':', $v);
        $response[$arr[0]] = substr($v , strlen($arr[0])+1);
        if($arr[0] === 'RETURN')$response[$arr[0]] = json_decode($response[$arr[0]], TRUE);
    }
    return $response;
}

?>