<?php
class AuthController {
    public function login() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['email'], $data['password'])) {
            echo json_encode(["status"=>false,"message"=>"Email & password required"]);
            return;
        }

        $user = User::login($data['email'], $data['password']);

        if ($user) {
            echo json_encode(["status"=>true,"user"=>$user]);
        } else {
            echo json_encode(["status"=>false,"message"=>"Invalid credentials"]);
        }
    }
}
