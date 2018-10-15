<?php
header('Content-Type: text/html; charset=UTF-8');
$APPID="wx38c99a513d30e52e";
$APPSECRET = "eff6a287724b3cac40aa39592eaa01f2";

$TOKEN_URL="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;

$json=file_get_contents($TOKEN_URL);
$result=json_decode($json,true);
//print_r($result);die;
$ACC_TOKEN=$result['access_token'];
//$ACC_TOKEN=$result->access_token;
//echo $ACC_TOKEN;die;

$data='{
		 "button":[
		 {
			   "name":"公共查询",
			   "sub_button":[
				{
				   "type":"click",
				   "name":"天气查询",
				   "key":"tianQi"
				},
				{
				   "type":"click",
				   "name":"公交查询",
				   "key":"gongJiao"
				},
				{
				   "type":"click",
				   "name":"翻译查询",
				   "key":"fanYi"
				},
				{
				   "type":"click",
				   "name":"快递查询",
				   "key":"kuaiDi"
				}]
		  },
		  {
			   "name":"关于我们",
			   "sub_button":[
				{
				   "type":"click",
				   "name":"联系方式",
				   "key":"mobile"
				},
				{
				   "type":"click",
				   "name":"关于我们",
				   "key":"about"
				}]
		   },
		   {
			   "type":"view",
			   "name":"微官网",
			   "url":"http://47.52.115.175/wx/jz/index.html"
		   }]
       }';

$MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$ACC_TOKEN;

$ch = curl_init($MENU_URL);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
$info = curl_exec($ch);
$menu = json_decode($info);
print_r($info);		//创建成功返回：{"errcode":0,"errmsg":"ok"}

if($menu->errcode == "0"){

    echo "菜单创建成功";
}else{

    echo "菜单创建失败";
}
?>