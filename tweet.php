<?php
 
//After you have successfully registered an application on twitter, enter the details below.
 
//enter your consumer key
$consumerKey    = 'cySHLxRLFpghxP2fC9AXbQ';
 
//enter your consumer secret
$consumerSecret = 'VfUDslBlNB0cWughd4CzyUC8w79u9KJd9tDU8dq14';
 
//your oAuth Token
$oAuthToken     = '';
 
//your oAuthSecret
$oAuthSecret    = '';
 
require_once('twitteroauth.php');
 
// create a new instance
$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
 
//send a tweet
$tweet->post('statuses/update', array('status' => 'This is my status Update!'));
 
?>