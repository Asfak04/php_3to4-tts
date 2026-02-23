<?php
require 'razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

$keyId = "enter your key id";
$keySecret = "enter your key secret";

$api = new Api($keyId, $keySecret);

?>