<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getsbAllinvoicesclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$getsbAllinvoices = $getsbAllinvoicesclass->getResponse(api_url."{business_uid}/sale/invoices");
$getsbAllinvoices = json_decode($getsbAllinvoices);
if (isset($getsbAllinvoices->items) && !empty($getsbAllinvoices->items))
{
	echo "<pre>";
	print_r($getsbAllinvoices);
	echo "</pre>";
}
