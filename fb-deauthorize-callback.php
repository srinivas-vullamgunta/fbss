<?php
require_once 'User.php'; 

function parse_signed_request($signed_request) {
  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 

  $secret = "xxxxxxxxxxxxxxxxxxx"; // Use your app secret here

  // decode the data
  $sig = base64_url_decode($encoded_sig);
  $data = json_decode(base64_url_decode($payload), true);

  // confirm the signature
  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
  if ($sig !== $expected_sig) {
    error_log('Bad Signed JSON signature!');
    return null;
  }
  
    // Initialize User class
    $user = new User();
	// User removed app from his facebook, so system deauthorizes this user by is_active=false 
	$userData = $user->inactivefbDeauthorizedUsers($data['user_id']); 
	
  
  //return $data;
}

function base64_url_decode($input) {
  return base64_decode(strtr($input, '-_', '+/'));
}

parse_signed_request($_REQUEST['signed_request']); 

?>
