<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$deletesbdataclass = new myobsbfunctions($_SESSION['access_token'],api_key);
$deletesbdata  = $deletesbdataclass->deleteData(api_url."{business_uid}/sale/invoices/{invoice_uid}");
$deletesbdata = json_decode($deletesbdata);
echo "<pre>";
print_r($deletesbdata);
echo "</pre>";
echo "Delete Done";
