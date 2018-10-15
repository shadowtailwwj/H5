<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2018/7/31
 * Time: 14:14
 */
header('Content-Type: text/html; charset=UTF-8');
$APPID="wx38c99a513d30e52e";
$APPSECRET = "eff6a287724b3cac40aa39592eaa01f2";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$token = "token";
$json=file_get_contents($TOKEN_URL);
$result=json_decode($json,true);
$ACC_TOKEN=$result['access_token'];
$data  = $_POST['data'];
$sign  = $_POST['sign'];
$date  = $_POST['date'];


$info = md5($data.'&'.$date.'&'.$token);

$MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACC_TOKEN;

$ch = curl_init($MENU_URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
$info = curl_exec($ch);
$menu = json_decode($info);
print_r($info);		//创建成功返回：{"errcode":0,"errmsg":"ok"}

if($info==$sign){

    echo "";

}

//if($menu->errcode == "0"){
//
//    echo "菜单创建成功";
//
//}else{
//
//    echo "菜单创建失败";
//
//}

?>