<?php
header("Content-Type: application/json");

require "../config/config.php";
require "../app/core/Database.php";
require "../app/models/User.php";
require "../app/controllers/AuthController.php";

$auth = new AuthController();
$auth->login();
