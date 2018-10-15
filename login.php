<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2018/7/18
 * Time: 17:10
 */

include_once("config.php");
include_once("common.php");

$user = $_POST['user'];
$pwd  = $_POST['pwd'];
$openid = $_SESSION["openid"];
$pid=1103901;
$send = '{"openid":"'.$openid.'"}';
$where = '=|loginid|'.$user.'|;=|!password|'.$pwd.'|';
$info = getResult($where,$send,$pid,'','','','','');
$cede = $info['RETURN']['CODE'];
if($cede==100){
    $_SESSION["username"]  = $info['RETURN']['MESSAGE'][0]['Title'];
    $_SESSION["uid"]       = $info['RETURN']['MESSAGE'][0]['ID'];
    echo 1;
}else{
    echo 0;
}



//echo '<pre>';
//print_r($return);