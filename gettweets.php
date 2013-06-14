<?php

	/* ========================================================================================================================
	
	Cartogram Comments Functions v.1.0
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 */
	session_start();
	require_once("twitteroauth/twitteroauth/twitteroauth.php"); //Path to twitteroauth library
	 
	$twitteruser = "LFBrewery";
	$notweets = 30;
	$consumerkey = "h1y1denVhEmXYVmhbGgQ";
	$consumersecret = "toaXif4hnnTowpgSjFlErEsmXN8WAkmXsvdJTJgJT0";
	$accesstoken = "785148522-EQsiyHZVNZ0XfjLWSP9pYkm0wTyXHoJqAV7Zr6rh";
	$accesstokensecret = "h8hvXWVtJv7zsmLG7ahVECdEYLcgEacOhgaw45tP8o";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	  
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	 
	echo json_encode($tweets);

	

