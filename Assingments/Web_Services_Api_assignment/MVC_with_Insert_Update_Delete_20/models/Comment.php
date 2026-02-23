<?php
class Comment {
    private $conn;
    private $table = "comments";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM $this->table ORDER BY id DESC");
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, comment) VALUES (?, ?)");
        $stmt->bind_param("ss", $data['name'], $data['comment']);
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET name=?, comment=? WHERE id=?");
        $stmt->bind_param("ssi", $data['name'], $data['comment'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        return $this->conn->query("DELETE FROM $this->table WHERE id=$id");
    }
}
?>