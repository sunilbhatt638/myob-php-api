<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
session_start();
include_once('config.php');
include_once('myobsbfunctions.php');
$putsbinvoicesclass = new myobsbfunctions($_SESSION['access_token'],api_key);

$addsbInvoiceJsonData = 	'{
								"uid" : "{invoice_uid}",
							    "contact" : {
							        "uid" : "{contact_uid}"
							        },
							    "invoiceNumber" : "IVSB00000229",
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
							    "description" : "Hammers Test",
							    "quantity" : 50,
							    "unitPrice" : 25.99,
							    "total" : 15.98
							    }
							    ],
							    "notes" : "An invoice note",
							    "purchaseOrderNumber" : "PO0000056",
							    "total" : 15.98,
							    "gst" : 1.09,
							    "amountPaid" : 0,
							    "amountDue" : 15.98,
							    "status" : "Open",
							    "displayStatus" : "Not Paid"
							}';
$putsbinvoices  = $putsbinvoicesclass->putData(api_url."{business_uid}/sale/invoices/{invoice_uid}", $addsbInvoiceJsonData);
$putsbinvoices = json_decode($putsbinvoices);
echo "<pre>";
print_r($putsbinvoices);
echo "</pre>";
echo "Update Done";
