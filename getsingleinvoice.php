<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$getsingleinvoiceclass 	= new myobsbfunctions($_SESSION['access_token'],api_key);
$getsingleinvoice 	= $getsingleinvoiceclass->getResponse(api_url."{business_uid}/sale/invoices/{invoice_uid}");
$getsingleinvoice 	= json_decode($getsingleinvoice);
echo "<pre>";
print_r($getsingleinvoice);
echo "</pre>";