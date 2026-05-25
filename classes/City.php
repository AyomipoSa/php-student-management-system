<?php

require_once __DIR__ . "/Database.php";

class City {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getAll($sort = "ASC") {
        $sort = strtoupper($sort) === "DESC" ? "DESC" : "ASC";
        $cities = [];

        $sql = "SELECT cityID, cityName FROM cities ORDER BY cityName $sort";
        $result = $this->conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $cities[$row['cityID']] = $row['cityName'];
            }
        }

        return $cities;
    }

    public function add($cityName) {
        $sql = "INSERT INTO cities (cityName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $cityName);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function update($cityID, $cityName) {
        $sql = "UPDATE cities SET cityName = ? WHERE cityID = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("si", $cityName, $cityID);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function delete($cityID) {
        $sql = "DELETE FROM cities WHERE cityID = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $cityID);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }
}