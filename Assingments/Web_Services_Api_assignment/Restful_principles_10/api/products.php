<?php
header("Content-Type: application/json");
include "../config/db.php";

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

switch ($method) {

    // 📖 READ
    case "GET":

        if ($id !== null) {

            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(["status" => false, "message" => "Invalid Product ID"]);
                exit;
            }

            $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();

            if (!$result) {
                http_response_code(404);
                echo json_encode(["status" => false, "message" => "Product not found"]);
                exit;
            }

            echo json_encode(["status" => true, "data" => $result]);

        } else {
            $result = $conn->query("SELECT * FROM products");
            echo json_encode([
                "status" => true,
                "data" => $result->fetch_all(MYSQLI_ASSOC)
            ]);
        }
        break;

    // ➕ CREATE
    case "POST":

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['price'])) {
            http_response_code(400);
            echo json_encode(["status" => false, "message" => "Name and price required"]);
            exit;
        }

        $stmt = $conn->prepare(
            "INSERT INTO products (name, price, description) VALUES (?, ?, ?)"
        );
        $desc = $data['description'] ?? null;
        $stmt->bind_param("sds", $data['name'], $data['price'], $desc);
        $stmt->execute();

        echo json_encode(["status" => true, "message" => "Product created"]);
        break;

    // ✏️ UPDATE
    case "PUT":

        if (!$id || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["message" => "Product ID required"]);
            exit;
        }

        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['price'])) {
            http_response_code(400);
            echo json_encode(["message" => "Name and price required"]);
            exit;
        }

        $stmt = $conn->prepare(
            "UPDATE products SET name=?, price=?, description=? WHERE id=?"
        );
        $desc = $data['description'] ?? null;
        $stmt->bind_param("sdsi", $data['name'], $data['price'], $desc, $id);
        $stmt->execute();

        echo json_encode(["status" => true, "message" => "Product updated"]);
        break;

    // ❌ DELETE
    case "DELETE":

        if (!$id || !is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["message" => "Product ID required"]);
            exit;
        }

        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        echo json_encode(["status" => true, "message" => "Product deleted"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method Not Allowed"]);
}
