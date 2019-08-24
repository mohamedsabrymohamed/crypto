<?php
require_once 'inc/twilio-php-master/Twilio/autoload.php'; 
use Twilio\Rest\Client;

function send_sms($number , $code){
$sid = "ACf2680cb244ef5453a4151b43a65dd1aa";
$token = "b4b3f6cf4e3d5ac3ac7d0d5208427568";
$client = new Client($sid, $token);

	$client->messages->create($number,
						array(
							"from" => "Verify",
							"body" => "BPT Crypto verification code: ".$code
						)
    );
}
	
?>