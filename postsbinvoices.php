<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$postsbinvoicesclass = new myobsbfunctions($_SESSION['access_token'],api_key);

$addsbInvoiceJsonData = 	'{
							    "contact" : {
							        "uid" : "{contact_uid}"
							        },
							    "invoiceNumber" : "IV00000229",
							    "issueDate" : "2014-08-19",
							    "dueDate" : "2014-08-26",
							    "gstInclusive" : true,
							    "lines" : [
							        {
							    "account" : {
							        "uid" : "{account_uid}"
							        },
							    "item" : {
							        "uid" : "{item_uid}"
							        },
							    "taxType" : {
							        "uid" : "{account_type_uid}"
							        },
							    "unitOfMeasure" : "Qty",
							    "description" : "Hammers",
							    "quantity" : 2,
							    "unitPrice" : 5.99,
							    "total" : 11.98
							    }
							    ],
							    "notes" : "An invoice note",
							    "purchaseOrderNumber" : "PO0000056",
							    "total" : 11.98,
							    "gst" : 1.09,
							    "amountPaid" : 0,
							    "amountDue" : 11.98,
							    "status" : "Open",
							    "displayStatus" : "Not Paid"
							}';
$postsbinvoices  = $postsbinvoicesclass->postData(api_url."{business_uid}/sale/invoices", $addsbInvoiceJsonData);
$postsbinvoices = json_decode($postsbinvoices);
echo "<pre>";
print_r($postsbinvoices);
echo "</pre>";
