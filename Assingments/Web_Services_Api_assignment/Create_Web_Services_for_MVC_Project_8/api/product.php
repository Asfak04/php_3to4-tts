<?php
header("Content-Type: application/json");

require "../config/config.php";
require "../app/core/Database.php";
require "../app/models/Product.php";
require "../app/controllers/ProductController.php";

$controller = new ProductController();

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    $controller->index();
}
elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    $controller->store();
}
else {
    echo json_encode(["status"=>false,"message"=>"Method not allowed"]);
}
