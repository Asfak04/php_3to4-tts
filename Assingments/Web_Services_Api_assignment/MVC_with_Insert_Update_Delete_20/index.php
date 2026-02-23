<?php
header("Content-Type: application/json");

require_once "config/db.php";
require_once "controllers/CommentController.php";

$db = (new Database())->connect();
$controller = new CommentController($db);

$method = $_SERVER['REQUEST_METHOD'];
$path = $_GET['action'] ?? '';

switch($method) {

    case 'GET':
        if($path == 'comments'){
            $controller->index();
        }
        break;

    case 'POST':
        if($path == 'comments'){
            $controller->store();
        }
        break;

    case 'PUT':
        if($path == 'comments'){
            $controller->update($_GET['id']);
        }
        break;

    case 'DELETE':
        if($path == 'comments'){
            $controller->delete($_GET['id']);
        }
        break;

    default:
        echo json_encode(["message"=>"Invalid request"]);
}
