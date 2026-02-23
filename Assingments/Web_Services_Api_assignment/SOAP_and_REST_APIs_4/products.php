<?php
header("Content-Type: application/json");
require 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    /* CREATE PRODUCT */
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'];
        $price = $data['price'];

        $sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Product created"]);
        }
        break;

    /* READ PRODUCTS */
    case 'GET':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $conn->query("SELECT * FROM products WHERE id=$id");
            echo json_encode($result->fetch_assoc());
        } else {
            $result = $conn->query("SELECT * FROM products");
            echo json_encode($result->fetch_all(MYSQLI_ASSOC));
        }
        break;

    /* UPDATE PRODUCT */
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];

        $sql = "UPDATE products SET name='$name', price='$price' WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Product updated"]);
        }
        break;

    /* DELETE PRODUCT */
    case 'DELETE':
        $id = $_GET['id'];
        $sql = "DELETE FROM products WHERE id=$id";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Product deleted"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
