<?php
// *********************************************************************
//
//      Class MYOB API OAUTH
//         
//           Sample Written by Keran McKenzie
//           Date: Feb 2013
//
//      Provided as sample oauth class for PHP & cURL OAUTH
//
//
// ********************************************************************

class myob_api_oauth {


	// public function to get an access token
	public function getAccessToken($api_key, $api_secret, $redirect_url, $access_code, $scope) {

		
		// build up the params
		$params = array(
					'client_id'				=>	$api_key,
					'client_secret'			=>	$api_secret,
					'scope'					=>	$scope,
					'code'					=>	$access_code,
					'redirect_uri'			=>	$redirect_url,
					'grant_type'			=>	'authorization_code', // authorization_code -> gives you an access token
		); // end params array */

		$params = http_build_query($params); // will urlencode data
		return( $this->getToken($params) );

	}

	// public function to refresh an access token
	public function refreshAccessToken($api_key, $api_secret, $refresh_token) {
		// use the getAccessToken function
		$params = array(
						'client_id'				=>	$api_key,
						'client_secret'			=>	$api_secret,
						'refresh_token'			=>	$refresh_token,
						'grant_type'			=>	'refresh_token', // refresh_token -> refreshes your access token
			); // end params array */

		$params = http_build_query($params);

		return( $this->getToken($params) );
	}

	// private function for token calls
	private function getToken($params) {
		
		//echo $params;

		$response = $this->getURL('https://secure.myob.com/oauth2/v1/authorize', $params);
		
		$response_json = json_decode( $response );

		// ***********************
		//
		//  TODO: ERROR CHECKING
		//
		// **********************

		// if no errors update the tokens
		return($response_json);
	}

	// private function for CURL
	private function getURL($url, $params, $headers=null) {

		$session = curl_init($url); 
		// do we have headers? set them
		if( isset($headers) ) {
			curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
		}
		// Tell curl to use HTTP POST
	    curl_setopt ($session, CURLOPT_POST, true); 
	    // Tell curl that this is the body of the POST
	    curl_setopt ($session, CURLOPT_POSTFIELDS, $params); 
	    // setup the authentication
	    //curl_setopt($session, CURLOPT_USERPWD, $_SESSION['username'] . ":" . $_SESSION['password']);
	    // Tell curl not to return headers, but do return the response
	    curl_setopt($session, CURLOPT_HEADER, false); 
	    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);



	    $response = curl_exec($session); 
	  	curl_close($session);
	  	//var_dump($response);
	  	return($response);
	}

} // end class