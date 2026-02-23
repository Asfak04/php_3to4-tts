<?php
require_once "models/Comment.php";

class CommentController {
    private $model;

    public function __construct($db) {
        $this->model = new Comment($db);
    }

    public function index() {
        $result = $this->model->getAll();
        $data = [];

        while($row = $result->fetch_assoc()){
            $data[] = $row;
        }

        echo json_encode($data);
    }

    public function store() {
        $input = json_decode(file_get_contents("php://input"), true);

        if($this->model->create($input)){
            echo json_encode(["status"=>true,"message"=>"Comment created"]);
        } else {
            echo json_encode(["status"=>false]);
        }
    }

    public function update($id) {
        $input = json_decode(file_get_contents("php://input"), true);

        if($this->model->update($id,$input)){
            echo json_encode(["status"=>true,"message"=>"Updated"]);
        }
    }

    public function delete($id) {
        if($this->model->delete($id)){
            echo json_encode(["status"=>true,"message"=>"Deleted"]);
        }
    }
}
?>