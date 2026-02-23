<?php
header("Content-Type: application/json");

$city = $_GET['city'] ?? '';

if ($city == '') {
    echo json_encode([
        "status" => false,
        "message" => "City name required"
    ]);
    exit;
}

$apiKey = "enter your api key";
$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=$apiKey";

// Call external API
$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode([
        "status" => false,
        "message" => "Unable to fetch weather data"
    ]);
    exit;
}

$data = json_decode($response, true);

// Handle API error
if ($data['cod'] != 200) {
    echo json_encode([
        "status" => false,
        "message" => $data['message']
    ]);
    exit;
}

// Success response
echo json_encode([
    "status" => true,
    "data" => [
        "city" => $data['name'],
        "temperature" => $data['main']['temp'],
        "humidity" => $data['main']['humidity'],
        "weather" => $data['weather'][0]['description']
    ]
]);
