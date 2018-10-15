<?php
/**
 *公共函数库
 */
include_once("config.php");

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

function unescape($str)
{
    $ret = '';
    $len = strlen($str);
    for ($i = 0; $i < $len; $i ++)
    {
        if ($str[$i] == '%' && $str[$i + 1] == 'u')
        {
            $val = hexdec(substr($str, $i + 2, 4));
            if ($val < 0x7f)
                $ret .= chr($val);
            else
                if ($val < 0x800)
                    $ret .= chr(0xc0 | ($val >> 6)) .
                        chr(0x80 | ($val & 0x3f));
                else
                    $ret .= chr(0xe0 | ($val >> 12)) .
                        chr(0x80 | (($val >> 6) & 0x3f)) .
                        chr(0x80 | ($val & 0x3f));
            $i += 5;
        } else
            if ($str[$i] == '%')
            {
                $ret .= urldecode(substr($str, $i, 3));
                $i += 2;
            } else
                $ret .= $str[$i];
    }
    return $ret;
}

function getMd5($where='',$send='',$pid,$listid='',$skeys='',$pagebase='',$pageid='',$pages=''){
    $seqno = time();
    $apiid = APIID;
    $ysid = YSID;
    $token =  urlencode(TOKEN);
    $typeid = TYPEID;
    $ip = urlencode(IP);
    $clientid = CLIENTID;
    $sourceid = SOURCEID;
    $eipid = EIPID;
    $portid = $pid;
    $isdes = 1;
    $return = urlencode('');
    $code = CODE;
    $codemessage = urlencode('');
    $sendmessage = urlencode(json_encode([
        "SEND"      => $send,
        "LISTID"    => $listid,
        "PAGEBASE"  => $pagebase,
        "PAGEID"    => $pageid,
        "PAGES"     => $pages,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => $where,
        "SORDERBY"  => '',
        "IP"        => IP,
        "SKEYS"     => $skeys
    ], 320));
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


function getSign($where='',$send='',$pid,$listid='',$skeys='',$pagebase='',$pageid='',$pages='',$md5){
    $seqno = time();
    $apiid = APIID;
    $ysid = YSID;
    $token =  urlencode(TOKEN);
    $typeid = TYPEID;
    $ip = urlencode(IP);
    $clientid = CLIENTID;
    $sourceid = SOURCEID;
    $eipid = EIPID;
    $portid = $pid;
    $isdes = 1;
    $return = urlencode('');
    $code = CODE;
    $codemessage = '';
    $md5 = strtoupper(MD5($md5));
    $sendmessage = urlencode(json_encode([
        "SEND"      => $send,
        "LISTID"    => $listid,
        "PAGEBASE"  => $pagebase,
        "PAGEID"    => $pageid,
        "PAGES"     => $pages,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => $where,
        "SORDERBY"  => '',
        "IP"        => IP,
        "SKEYS"     => $skeys
    ], 320));
    $params  = '';
    $params .= "SEQNO:{$seqno};";
    $params .= "APIID:{$apiid};";
    $params .= "YSID:{$ysid};";
//    $params .= "TOKEN:{$token};";
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
//54958b8cccaef65e28a6e5ec6614452
function format($str){
    preg_match('/({.*})/',$str,$arr);
    $array = json_decode($arr[0],TRUE);
    return $array;
}



function getResult($where='',$send='',$pid,$listid='',$skeys='',$pagebase='',$pageid='',$pages=''){
    $seqno = time();
    $apiid = APIID;
    $ysid = YSID;
    $token =  urlencode(TOKEN);
    $typeid = TYPEID;
    $ip = urlencode(IP);
    $clientid = CLIENTID;
    $sourceid = SOURCEID;
    $eipid = EIPID;
    $portid = $pid;
    $isdes = 1;
    $return = urlencode('');
    $code = CODE;
    $codemessage = urlencode('');
    $sendmessage = urlencode(json_encode([
        "SEND"      => $send,
        "LISTID"    => $listid,
        "PAGEBASE"  => $pagebase,
        "PAGEID"    => $pageid,
        "PAGES"     => $pages,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => $where,
        "SORDERBY"  => '',
        "IP"        => IP,
        "SKEYS"     => $skeys
    ], JSON_UNESCAPED_UNICODE));
    $param  = '';
    $param .= "SEQNO:{$seqno};";
    $param .= "APIID:{$apiid};";
    $param .= "YSID:{$ysid};";
    $param .= "TOKEN:{$token};";
    $param .= "TYPEID:{$typeid};";
    $param .= "IP:{$ip};";
    $param .= "CLIENTID:{$clientid};";
    $param .= "EIPID:{$eipid};";
    $param .= "SOURCEID:{$sourceid};";
    $param .= "PORTID:{$portid};";
    $param .= "ISDES:{$isdes};";
    $param .= "SEND:{$sendmessage};";
    $param .= "RETURN:{$return};";
    $param .= "CODE:{$code};";
    $param .= "CODEMESSAGE:{$codemessage};";
    $md5 = strtoupper(MD5($param));
    $sendmessage = urlencode(json_encode([
        "SEND"      => $send,
        "LISTID"    => $listid,
        "PAGEBASE"  => $pagebase,
        "PAGEID"    => $pageid,
        "PAGES"     => $pages,
        "ISDES"     =>  0,
        "ISSPECIAL" => '',
        "SWHERE"    => $where,
        "SORDERBY"  => '',
        "IP"        => IP,
        "SKEYS"     => $skeys
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

    $data = ['Title'=>$params];
    $result = curlRequest(APIURL, $data, true);
    $str = unescape($result);
    $info = format($str);
    return $info;
}

function sendMail($to, $title, $content) {
    require 'class.phpmailer.php';
    $mail = new PHPMailer();
    $mail->IsSMTP(); // 启用SMTP
    $mail->Host = MAIL_HOST; //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = MAIL_SMTPAUTH; //启用smtp认证
    $mail->Username = MAIL_USERNAME; //发件人邮箱名
    $mail->Password = MAIL_PASSWORD ; //163邮箱发件人授权密码
    $mail->From = MAIL_FROM; //发件人地址（也就是你的邮箱地址）
    $mail->FromName = MAIL_FROMNAME; //发件人姓名
    $mail->AddAddress($to,"尊敬的客户");
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->IsHTML(MAIL_ISHTML); // 是否HTML格式邮件
    $mail->CharSet = MAIL_CHARSET; //设置邮件编码
    $mail->Subject = $title; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
    return($mail->Send());
}

?>