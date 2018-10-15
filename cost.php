<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2018/7/18
 * Time: 17:10
 */

include_once("config.php");
include_once("common.php");

$table = 'cost';

$val = run1();
$url = "http://192.168.2.199:8002/CNet/Api.ashx";
$data = ['Title'=>$val];
$result = curlRequest($url, $data, true);
$str = unescape($result);

$arr = toArray($str);

$return = [];
foreach ($arr['RETURN']['RETURN']['MESSAGE'] as $key => $val) {

    $return[] = $val;

}


echo '<pre>';
print_r($return);