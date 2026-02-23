<?php

header("Content-Type: application/json");

// Allow only POST method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Only POST method allowed"
    ]);
    exit;
}

// Check if file exists
if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "Image file is required"
    ]);
    exit;
}

$file = $_FILES['image'];

// Validation rules
$maxSize = 2 * 1024 * 1024; // 2MB
$allowedExtensions = ['jpg', 'jpeg', 'png'];
// $allowedMimeTypes = ['image/jpeg', 'image/png'];

// 1️⃣ Extension validation
$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($extension, $allowedExtensions)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid file extension"
    ]);
    exit;
}

// 2️⃣ File size validation
if ($file['size'] > $maxSize) {
    echo json_encode([
        "status" => "error",
        "message" => "Image size must be less than 2MB"
    ]);
    exit;
}


// 4️⃣ Actual image validation
if (!getimagesize($file['tmp_name'])) {
    echo json_encode([
        "status" => "error",
        "message" => "File is not a valid image"
    ]);
    exit;
}

// Create uploads folder if not exists
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Generate secure unique filename
$filename = uniqid('img_', true) . "." . $extension;
$targetPath = $uploadDir . $filename;

// Move file
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo json_encode([
        "status" => "success",
        "message" => "Image uploaded successfully",
        "file_path" => $targetPath
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Failed to upload image"
    ]);
}
