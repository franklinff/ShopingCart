<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '439039940405-074bbibdr5ddvbgk9cr96tj2i88hd3bc.apps.googleusercontent.com';
$clientSecret = 'Xixn9mG9uzSXXjKPq-z4j6e9';
$redirectURL = 'http://localhost/login_with_google_using_php/';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to CodexWorld.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
