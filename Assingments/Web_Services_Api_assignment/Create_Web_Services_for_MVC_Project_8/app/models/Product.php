<?php
class Product {
    public static function all() {
        $db = Database::connect();
        $res = $db->query("SELECT * FROM products");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public static function create($name, $price) {
        $db = Database::connect();
        return $db->query("INSERT INTO products (name, price) VALUES ('$name','$price')");
    }
}
