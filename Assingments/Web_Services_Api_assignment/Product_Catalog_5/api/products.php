<?php
header("Content-Type: application/json");
include "db.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // ➕ CREATE PRODUCT (WITH IMAGE)
    case "POST":

        if (!isset($_POST['name'], $_POST['price'])) {
            http_response_code(400);
            echo json_encode(["message" => "Name and price required"]);
            exit;
        }

        $imageName = null;

        if (!empty($_FILES['image']['name'])) {
            $allowed = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                echo json_encode(["message" => "Invalid image type"]);
                exit;
            }

            $imageName = uniqid() . "." . $ext;
            move_uploaded_file(
                $_FILES['image']['tmp_name'],
                "../uploads/" . $imageName
            );
        }

        $stmt = $conn->prepare(
            "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "ssds",
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $imageName
        );
        $stmt->execute();

        echo json_encode(["message" => "Product created"]);
        break;

    // 📖 READ PRODUCTS
    case "GET":
        $result = $conn->query("SELECT * FROM products");
        echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        break;
}
