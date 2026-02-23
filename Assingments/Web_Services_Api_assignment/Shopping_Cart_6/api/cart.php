<?php
header("Content-Type: application/json");
session_start();          // start or resume session

// ensure cart array exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$method = $_SERVER['REQUEST_METHOD'];

/**
 * Helper: save item into cart
 * $item = [id, name, price, qty, image?]
 */
function addOrUpdateItem($item) {
    foreach ($_SESSION['cart'] as &$existing) {
        if ($existing['id'] == $item['id']) {
            // update quantity
            $existing['qty'] += $item['qty'];
            return;
        }
    }
    // not found, add new
    $_SESSION['cart'][] = $item;
}

switch ($method) {

    // ADD TO CART
    case "POST":
        // expecting form-data or JSON; try JSON first
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data) {
            // fallback to POST form-data
            $data = $_POST;
        }
        // required: id, name, price, qty
        if (!isset($data['id'], $data['name'], $data['price'], $data['qty'])) {
            http_response_code(400);
            echo json_encode(["message" => "id, name, price, qty required"]);
            exit;
        }

        $item = [
            "id"    => $data['id'],
            "name"  => $data['name'],
            "price" => (float)$data['price'],
            "qty"   => max(1, (int)$data['qty']),
            // optional image
            "image" => isset($data['image']) ? $data['image'] : null
        ];

        addOrUpdateItem($item);
        echo json_encode(["message" => "Item added to cart", "cart" => $_SESSION['cart']]);
        break;

    // VIEW CART
    case "GET":
        echo json_encode($_SESSION['cart']);
        break;

    // UPDATE QUANTITY
    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        if (!$data || !isset($data['id'])) {
            http_response_code(400);
            echo json_encode(["message"=>"Invalid request"]);
            exit;
        }
    
        $updated = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $data['id']) {
                if (isset($data['qty'])) {
                    $item['qty'] = max(1, (int)$data['qty']);
                } elseif (isset($data['change'])) {
                    $item['qty'] += (int)$data['change'];
                    if ($item['qty'] < 1) $item['qty'] = 1;
                }
                $updated = true;
                break;
            }
        }
    
        if ($updated) {
            echo json_encode(["message"=>"Cart updated","cart"=>$_SESSION['cart']]);
        } else {
            http_response_code(404);
            echo json_encode(["message"=>"Item not found"]);
        }
        break;
    
    
    // REMOVE ITEM
    case "DELETE":
        // id passed as query param ?id=123
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["message" => "id required"]);
            exit;
        }
        $id = $_GET['id'];
        $newCart = [];
        $removed = false;
        foreach ($_SESSION['cart'] as $item) {
            if ($item['id'] == $id) {
                $removed = true;
                continue;   // skip this item
            }
            $newCart[] = $item;
        }
        $_SESSION['cart'] = $newCart;
        if ($removed) {
            echo json_encode(["message" => "Item removed", "cart" => $_SESSION['cart']]);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Item not found"]);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
        break;
}
