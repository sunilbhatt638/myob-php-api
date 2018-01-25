<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getsbAllcontactsclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$getsbAllcontacts = $getsbAllcontactsclass->getResponse(api_url."{business_uid}/contacts");
$getsbAllcontacts = json_decode($getsbAllcontacts);
if (isset($getsbAllcontacts->items) && !empty($getsbAllcontacts->items))
{
	echo "<pre>";
	print_r($getsbAllcontacts);
	echo "</pre>";
}
