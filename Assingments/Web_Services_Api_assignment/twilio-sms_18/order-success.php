<?php
require 'config.php';

$customerPhone = "+919999999999";
$orderId = 1234;

$text = "Order #$orderId confirmed. Thank you for shopping!";

$client->messages->create(
    $customerPhone,
    [
        'from' => $twilio_number,
        'body' => $text
    ]
);

echo "Order placed and SMS sent!";
?>