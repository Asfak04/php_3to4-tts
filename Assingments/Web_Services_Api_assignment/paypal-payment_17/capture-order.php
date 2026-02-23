<?php
require 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
$orderID = $data['orderID'];

/* Get Access Token */
$ch = curl_init("$baseUrl/v1/oauth2/token");

curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$secret");
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = json_decode(curl_exec($ch));
$accessToken = $response->access_token;

curl_close($ch);

/* Capture Payment */
$ch = curl_init("$baseUrl/v2/checkout/orders/$orderID/capture");

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $accessToken"
]);

curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
echo $result;
