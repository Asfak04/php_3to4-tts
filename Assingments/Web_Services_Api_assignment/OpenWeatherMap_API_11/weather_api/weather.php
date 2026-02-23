<?php
header("Content-Type: application/json");

$apiKey = "cb2b3b7c08056ebb7ef7de0339a81a03"; // 🔑 put your real key here

$city = $_GET['city'] ?? '';

if ($city == '') {
    echo json_encode([
        "status" => false,
        "message" => "City name is required"
    ]);
    exit;
}

$url = "https://api.openweathermap.org/data/2.5/weather?q="
        . urlencode($city)
        . "&units=metric&appid=" . $apiKey;

$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode([
        "status" => false,
        "message" => "Unable to fetch weather data"
    ]);
    exit;
}

$data = json_decode($response, true);

if ($data['cod'] != 200) {
    echo json_encode([
        "status" => false,
        "message" => $data['message']
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "data" => [
        "city" => $data['name'],
        "temperature" => $data['main']['temp'],
        "humidity" => $data['main']['humidity'],
        "weather" => $data['weather'][0]['description'],
        "wind_speed" => $data['wind']['speed']
    ]
]);
