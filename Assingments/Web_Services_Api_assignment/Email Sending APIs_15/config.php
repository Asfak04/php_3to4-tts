<?php

$conn = new mysqli("localhost", "root", "", "email_project");

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

?>
