<?php
class ProductController {
    public function index() {
        $products = Product::all();
        echo json_encode(["status"=>true,"data"=>$products]);
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['name'], $data['price'])) {
            echo json_encode(["status"=>false,"message"=>"Name & price required"]);
            return;
        }

        Product::create($data['name'], $data['price']);
        echo json_encode(["status"=>true,"message"=>"Product added"]);
    }
}
