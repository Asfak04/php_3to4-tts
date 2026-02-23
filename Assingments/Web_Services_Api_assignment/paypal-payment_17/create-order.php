<?php
require 'config.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "$baseUrl/v1/oauth2/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");

$headers = [
    "Accept: application/json",
    "Accept-Language: en_US"
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = json_decode(curl_exec($ch));
$accessToken = $response->access_token;

curl_close($ch);

/* Create Order */
$ch = curl_init("$baseUrl/v2/checkout/orders");

$orderData = json_encode([
    "intent" => "CAPTURE",
    "purchase_units" => [[
        "amount" => [
            "currency_code" => "USD",
            "value" => "10.00"
        ]
    ]]
]);

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, $orderData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
echo $result;
