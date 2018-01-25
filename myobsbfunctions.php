<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
class myobsbfunctions
{
	public function __construct($accessToken,$apiKey)
	{
		$this->header  = array(
	    	'Authorization: Bearer '.$accessToken,
	        'x-myobapi-key: '.$apiKey,
	        'x-myobapi-version: v0',
	        'Accept: application/json',
	        'Content-Type: application/json',
	    );
	}

	public function getResponse($url)
	{
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	  	// get the response & close the session
	  	$response = curl_exec($session);
	  	curl_close($session);
	  	return($response);
	}

	// public function postData($url, $postdata, $accessToken, $apiKey)
	public function postData($url, $postdata)
	{
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
		// curl_setopt($session, CURLOPT_HTTPHEADER, $testheader);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_POST, true);
		curl_setopt($session, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	  	// get the response & close the session
	  	$response = curl_exec($session);
	  	curl_close($session);
	  	return($response);
	}

	public function putData($url, $putdata)
	{
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($session, CURLOPT_POSTFIELDS, $putdata);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	  	$response = curl_exec($session);
	  	curl_close($session);
	  	return($response);
	}

	public function deleteData($url)
	{
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_HTTPHEADER, $this->header);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	  	$response = curl_exec($session);
	  	curl_close($session);
	  	return($response);
	}
}