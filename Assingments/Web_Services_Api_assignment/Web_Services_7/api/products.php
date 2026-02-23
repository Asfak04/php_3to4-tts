<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

require_once "../config/db.php";

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== "GET") {
    http_response_code(405);
    echo json_encode([
        "status" => false,
        "message" => "Method not allowed"
    ]);
    exit;
}

// Fetch single product
if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    if ($id <= 0) {
        http_response_code(400);
        echo json_encode([
            "status" => false,
            "message" => "Invalid product ID"
        ]);
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        http_response_code(404);
        echo json_encode([
            "status" => false,
            "message" => "Product not found"
        ]);
        exit;
    }

    echo json_encode([
        "status" => true,
        "data" => $result->fetch_assoc()
    ]);
    exit;
}

// Fetch all products
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode([
    "status" => true,
    "count" => count($products),
    "data" => $products
]);
