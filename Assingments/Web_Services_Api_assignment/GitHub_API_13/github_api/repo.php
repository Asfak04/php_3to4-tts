<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

if (!isset($_GET['username']) || empty($_GET['username'])) {
    echo json_encode(["status" => "error", "message" => "Username required"]);
    exit;
}

$username = $_GET['username'];
$url = "https://api.github.com/users/$username/repos";

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "User-Agent: PHP-App"
    ]
]);

$response = curl_exec($ch);
curl_close($ch);

$repos = json_decode($response, true);

if (!is_array($repos)) {
    echo json_encode(["status" => "error", "message" => "No repositories found"]);
    exit;
}

$result = [];

foreach ($repos as $repo) {
    $result[] = [
        "name" => $repo['name'],
        "url" => $repo['html_url'],
        "stars" => $repo['stargazers_count'],
        "language" => $repo['language']
    ];
}

echo json_encode([
    "status" => "success",
    "repositories" => $result
]);
