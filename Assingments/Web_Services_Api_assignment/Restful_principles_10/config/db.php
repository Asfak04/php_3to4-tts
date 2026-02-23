<?php
$conn = new mysqli("localhost", "root", "", "restfull_api");

if ($conn->connect_error) {
    die(json_encode(["status" => false, "message" => "DB connection failed"]));
}
