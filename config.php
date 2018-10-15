<?php
header("Content-Type:text/html;charset=UTF-8");

define('IP', getIp());
define('TOKEN', 'Token');//密钥信息，对YSID以及时间轴进行加密
define('APIID', 2);//条件ID号，唯一固定号
define('YSID', 20170505011);//系统编号，唯一编号
define('CLIENTID', 1);//访问会员用户Id
define('SOURCEID', 6);//交易来源渠道
define('TYPEID', 1);//请求类型：0为初始化请求1为数据请求
define('EIPID', 1);//EIP系统用户Id
define('CODE', 0);//响应代码，100-199为正常
define('APIURL', 'http://home.yushidns.com:8088/CNet/Api.ashx');//API地址

date_default_timezone_set("Etc/GMT+8");
$mysql_server_name='127.0.0.1';
$mysql_username='root';
$mysql_password='root';
$mysql_database='jizhang';
@$conn=mysql_connect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ;
mysql_query("set names 'utf8'");
mysql_select_db($mysql_database);

function getIp(){
    $ip=false;

    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
        for ($i = 0; $i < count($ips); $i++) {
            if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

?>