<?php
/**
 * Created by PhpStorm.
 * User: jiang
 * Date: 2018/7/18
 * Time: 17:10
 */

include_once("config.php");
include_once("common.php");

$table = 'bill';

$data['bill_num']                          = $_POST['bill_num'];
$data['bill_type']                         = $_POST['bill_type'];
$data['enterprise_name']                   = $_POST['enterprise_name'];
$data['taxpayer_identification_number']    = $_POST['taxpayer_identification_number'];
$data['address']                           = $_POST['address'];
$data['mobile']                            = $_POST['mobile'];
$data['opening_bank']                      = $_POST['opening_bank'];
$data['opening_account']                   = $_POST['opening_account'];
$data['cargo']                             = $_POST['cargo'];
$data['specification']                     = $_POST['specification'];
$data['unit']                              = $_POST['unit'];
$data['number']                            = $_POST['number'];
$data['price']                             = $_POST['price'];
$data['amount']                            = $_POST['amount'];
$data['tax_rate']                          = $_POST['tax_rate'];
$data['tax_amount']                        = $_POST['tax_amount'];
$data['remarks']                           = $_POST['remarks'];

$info = json_encode($data);
echo $info;die;

$val = run1();
$url = "http://192.168.2.199:8002/CNet/Api.ashx";
$title = ['Title'=>$val];
$result = curlRequest($url, $title, true);
$str = unescape($result);

$arr = toArray($str);

$return = [];
foreach ($arr['RETURN']['RETURN']['MESSAGE'] as $key => $val) {

    $return[] = $val;

}

echo '<pre>';
print_r($return);