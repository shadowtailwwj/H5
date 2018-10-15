<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2018/7/18
 * Time: 17:10
 */

include_once("config.php");
include_once("common.php");

$table = 'asset';

$val = run1();


$url = "http://home.yushidns.com:8088/CNet/Api.ashx";
$data = ['Title'=>$val];
$result = curlRequest($url, $data, true);
$str = unescape($result);

echo $str;die;

$arr = toArray($str);
//echo '<pre>';
//print_r($arr);die;
$return = [];
foreach ($arr['RETURN']['RETURN']['MESSAGE'] as $key => $val) {

    $return[] = $val;

}

echo '<pre>';
print_r($return);