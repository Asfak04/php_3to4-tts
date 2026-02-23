<?php
class User {
    public static function login($email, $password) {
        $db = Database::connect();
        $pwd = md5($password);

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$pwd'";
        $result = $db->query($sql);

        return $result->fetch_assoc();
    }
}
