<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$postinvoicepaymentsclass = new myobsbfunctions($_SESSION['access_token'],api_key);

// Get Last Payment Reference
$getpaymentreference = $postinvoicepaymentsclass->getResponse(api_url."{business_uid}/sale/payments/nextReference");
$getpaymentreference = json_decode($getpaymentreference);


$postinvoicepaymentsJsonData = 	'{
								    "paymentDate" : "2018-02-13",
								    "reference" : "'.$getpaymentreference->reference.'",
								    "notes" : "Payment for widgets Test",
								    "account" : {
								        			"uid" : "{account_uid}"
								        		},
								    "customer":	{
								        			"uid" : "{contact_uid}"
								        		},
								    "invoices":	[
								        			{
								    					"invoice" : {
								        								"uid" : "{invoice_uid}"
								        							},
								    					"paymentAmount" : "15.00"
								    				}
												]
								}';
$postinvoicepayments  	= $postinvoicepaymentsclass->postData(api_url."{business_uid}/sale/payments", $postinvoicepaymentsJsonData);
$postinvoicepayments 	= json_decode($postinvoicepayments);
echo "<pre>";
print_r($postinvoicepayments);
echo "</pre>";
