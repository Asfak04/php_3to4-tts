<?php
require 'vendor/autoload.php';

use Twilio\Rest\Client;

$account_sid = "enter your account sid";
$auth_token = "enter your auth token";
$twilio_number = "enter your twilio number";

$client = new Client($account_sid, $auth_token);
?>