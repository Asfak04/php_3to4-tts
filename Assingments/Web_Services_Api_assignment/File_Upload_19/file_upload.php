<?php
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_FILES['file'])) {
        echo json_encode(["status" => false, "message" => "No file uploaded"]);
        exit;
    }

    $file = $_FILES['file'];
    $allowed = ['jpg','png','pdf'];

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $allowed)) {
        echo json_encode(["status" => false, "message" => "Invalid type"]);
        exit;
    }

    $newName = uniqid() . "." . $ext;
    move_uploaded_file($file['tmp_name'], "uploads/$newName");

    echo json_encode([
        "status" => true,
        "file" => $newName
    ]);
}
?>