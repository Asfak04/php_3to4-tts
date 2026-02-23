<?php

// Set response type
header("Content-Type: application/json");

// Get all request headers
$headers = getallheaders();

// Check for custom header
if (isset($headers['X-Client-Name'])) {

    echo json_encode([
        "status" => "success",
        "message" => "Custom header received",
        "header_value" => $headers['X-Client-Name']
    ]);

} else {

    http_response_code(400);

    echo json_encode([
        "status" => "error",
        "message" => "X-Client-Name header missing"
    ]);
}
