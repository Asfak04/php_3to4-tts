<?php
header("Content-Type: application/json");

if (empty($_GET['address'])) {
    echo json_encode([
        "status" => false,
        "message" => "Address required"
    ]);
    exit;
}

$address = urlencode($_GET['address']);

// OpenStreetMap Nominatim API
$apiUrl = "https://nominatim.openstreetmap.org/search?format=json&q=$address";

// Required User-Agent
$options = [
    "http" => [
        "header" => "User-Agent: PHP-Geocoding-App\r\n"
    ]
];

$context = stream_context_create($options);
$response = @file_get_contents($apiUrl, false, $context);

if ($response === false) {
    echo json_encode([
        "status" => false,
        "message" => "API request failed"
    ]);
    exit;
}

$data = json_decode($response, true);

if (empty($data)) {
    echo json_encode([
        "status" => false,
        "message" => "Location not found"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "lat" => $data[0]['lat'],
    "lon" => $data[0]['lon']
]);
