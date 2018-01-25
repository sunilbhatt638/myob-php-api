<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getsbAllbusinessesclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$getsbAllbusinesses = $getsbAllbusinessesclass->getResponse(api_url);
$getsbAllbusinesses = json_decode($getsbAllbusinesses);
if (isset($getsbAllbusinesses->items) && !empty($getsbAllbusinesses->items))
{
	echo "<pre>";
	print_r($getsbAllbusinesses);
	echo "</pre>";
}
