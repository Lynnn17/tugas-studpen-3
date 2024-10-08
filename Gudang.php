<?php
class Gudang {
    private $conn;


    public function __construct($db) {
        $this->conn = $db;
    }

    public function createGudang($name, $location, $capacity, $opening_hour, $closing_hour) {
        $sql = "INSERT INTO gudang (name, location, capacity, opening_hour, closing_hour) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssiss", $name, $location, $capacity, $opening_hour, $closing_hour);
        return $stmt->execute();
    }

    public function readGudang() {
        $sql = "SELECT * FROM gudang";
        return $this->conn->query($sql);
    }

    public function getGudangById($id) {
        $sql = "SELECT * FROM gudang WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateGudang($id, $name, $location, $capacity, $status, $opening_hour, $closing_hour) {
        $sql = "UPDATE gudang SET name=?, location=?, capacity=?, status=?, opening_hour=?, closing_hour=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisssi", $name, $location, $capacity, $status, $opening_hour, $closing_hour, $id);
        return $stmt->execute();
    }

    public function deleteGudang($id) {
        $sql = "DELETE FROM gudang WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

     public function searchGudang($search, $limit, $offset) {
        $query = "SELECT * FROM gudang WHERE name LIKE ? OR location LIKE ? LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bind_param('ssii', $searchTerm, $searchTerm, $limit, $offset);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function countGudang($search) {
        $query = "SELECT COUNT(*) as total FROM gudang WHERE name LIKE ? OR location LIKE ?";
        $stmt = $this->conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bind_param('ss', $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }


}
?>
