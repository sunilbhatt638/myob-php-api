<?php
/*
Author: Sunil Bhatt
App:    Myob Api
*/
$starttime = microtime();
$startarray = explode(" ", $starttime);
$starttime = $startarray[1] + $startarray[0];

include_once('config.php');

session_start();

// check for code first
if( isset($_GET['code']) )
{
	// ideally you want to check more, eg: did the user really come from secure.myob.com?
	define('api_access_code', $_GET['code']);
	// lets get the access token now
	// include our oauth class
	include_once('includes/class.myob_oauth.php');
	$oauth = new myob_api_oauth();
	// getAccessToken would return false if there was an error
	$oauth_tokens = $oauth->getAccessToken(api_key, api_secret, redirect_url, api_access_code, api_scope);
	//var_dump($oauth_tokens);
	if(isset($oauth_tokens) && !isset($oauth_tokens->error) )
	{
		// okay we've got the tokens in a json object
		// lets SAVE them (ahem - save them somewhere safe)
		$_SESSION['access_token'] = $oauth_tokens->access_token;
		$_SESSION['access_token_expires'] = time() + $oauth_tokens->expires_in; // this sets the time for expiry (Currently 20 mins)
		$_SESSION['refresh_token'] = $oauth_tokens->refresh_token;

		// and becuase this is a session lets refresh the page to clear the URL etc
		header('Location: '.base_url);
	}
	else
	{
		echo "your key is not valid.";
	}
}
else
{
	// okay $_GET['code'] isn't present lets check for the tokens
	if( isset($_SESSION['access_token']) )
	{
		// lets check the token hasn't expired
		$expiry_time = time(); // + 600; // note I ad 600 seconds so we get a refresh token before our token expires
		if( $expiry_time > $_SESSION['access_token_expires'] )
		{
			// expired so lets get a new token
			// include our oauth class
			include_once('includes/class.myob_oauth.php');
			$oauth = new myob_api_oauth();
			$oauth_tokens = $oauth->refreshAccessToken(api_key, api_secret, $_SESSION['refresh_token']);

			// if( $oauth_tokens )
			if(isset($oauth_tokens) && !isset($oauth_tokens->error) )
			{
				// okay we've got the tokens in a json object
				// lets SAVE them (ahem - save them somewhere safe)
				$_SESSION['access_token'] = $oauth_tokens->access_token;
				$_SESSION['access_token_expires'] = time() + $oauth_tokens->expires_in; // this sets the time for expiry (Currently 20 mins)
				$_SESSION['refresh_token'] = $oauth_tokens->refresh_token;

				// and becuase this is a session lets refresh the page to clear the URL etc
				header('Location: '.base_url);;
			}
			else
			{
				echo "Your key is not valid.";
			}
		}
	}
	else
	{
		// echo "no access token, this is a new user, show the home page";
		?>
		<a href="https://secure.myob.com/oauth2/account/authorize?client_id=<?php echo api_key; ?>&redirect_uri=<?php echo urlencode( redirect_url ); ?>&response_type=code&scope=<?php echo api_scope; ?>">Click here to link with MYOB AccountRight Live now</a>
		<?php
	}
}
// session_destroy();
if (isset($_SESSION["access_token"]))
{
	// var_dump($_SESSION);
	echo '<a href="getallsbusinesses.php">Get All businesses</a>';
}
?>