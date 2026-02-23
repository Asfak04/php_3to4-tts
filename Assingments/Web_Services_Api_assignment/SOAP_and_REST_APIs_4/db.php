<?php
$conn = new mysqli("localhost", "root", "", "product_api");

if ($conn->connect_error) {
    die(json_encode(["error" => "Database connection failed"]));
}
?>