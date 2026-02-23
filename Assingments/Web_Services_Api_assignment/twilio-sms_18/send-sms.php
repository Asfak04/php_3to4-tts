<?php
require 'config.php';

$to = "+916351249749"; // customer phone number

$message = $client->messages->create(
    $to,
    [
        'from' => $twilio_number,
        'body' => "Your order has been confirmed 🎉"
    ]
);

echo "SMS Sent! Message SID: " . $message->sid;
?>