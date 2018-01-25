<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
define('api_key',		'[API KEY HERE]'); // enter your MYOB Developer Key
define('api_secret',	'[API SECRET HERE]'); // enter your MYOB Developer Secret
define('redirect_url',	'http://localhost/myob/connection.php'); // enter the Redirect URL
// NOTE: this MUST match the url you used when registering for a key
//       you can login to my.myob.com.au anytime and change the redirect url for testing/production
define('api_url',		'https://api.myob.com/au/essentials/businesses/'); // NOTE: api is https not http
// API URL accepts: https://api.myob.com/accountright/, http://localhost:8080/accountright (note: port can change), http://xxx.xxx.xxx.xxx/accountright/
//                  where xxx = ip address of network accessable Accountright install with API running
define('api_scope',		'la.global'); // You shouldn't need to change this

define('base_url',		'http://localhost/myob/connection.php');
?>