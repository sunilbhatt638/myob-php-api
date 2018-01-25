<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getsbAllaccountsclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$getsbAllaccounts = $getsbAllaccountsclass->getResponse(api_url."{business_uid}/generalledger/accounts");
$getsbAllaccounts = json_decode($getsbAllaccounts);
if (isset($getsbAllaccounts->items) && !empty($getsbAllaccounts->items))
{
	echo "<pre>";
	print_r($getsbAllaccounts);
	echo "</pre>";
}
