<?php
if(!session_id()){
    session_start();
}

// Include the autoloader provided in the SDK
require_once 'Facebook/autoload.php';

// Include required libraries
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

/*
 * Configuration and setup Facebook SDK
 */
$appId         = '131790190807618'; //Facebook App ID
$appSecret     = '07f4734f7cb53d97ea29cf4fb7e59248'; //Facebook App Secret
$redirectURL   = 'http://www.cherrylucky.com/'; //Callback URL
$fbPermissions = array('email');  //Optional permissions

$fb = new Facebook(array(
    'app_id' => $appId,
    'app_secret' => $appSecret,
    'default_graph_version' => 'v2.10',
));

// Get redirect login helper
$helper = $fb->getRedirectLoginHelper();

// Try to get access token
try {
    if(isset($_SESSION['facebook_access_token'])){
			$accessToken = $_SESSION['facebook_access_token'];
    }else{
			$accessToken =  $helper->getAccessToken('http://www.cherrylucky.com/');
    }
} catch(FacebookResponseException $e) {
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}


 














?>