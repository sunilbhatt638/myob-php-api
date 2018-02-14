<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getpaymentreferenceclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$getpaymentreference = $getpaymentreferenceclass->getResponse(api_url."{business_uid}/sale/payments/nextReference");
$getpaymentreference = json_decode($getpaymentreference);
echo "<pre>";
print_r($getpaymentreference);
echo "</pre>";