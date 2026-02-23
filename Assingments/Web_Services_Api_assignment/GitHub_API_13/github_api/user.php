<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (!isset($_GET['username']) || empty($_GET['username'])) {
    echo json_encode(["status" => "error", "message" => "Username required"]);
    exit;
}

$username = $_GET['username'];
$url = "https://api.github.com/users/$username";

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "User-Agent: PHP-App"   // REQUIRED by GitHub
    ]
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    echo json_encode(["status" => "error", "message" => "User not found"]);
    exit;
}

$data = json_decode($response, true);

echo json_encode([
    "status" => "success",
    "username" => $data['login'],
    "avatar" => $data['avatar_url'],
    "profile" => $data['html_url']
]);
