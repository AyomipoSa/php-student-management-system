<?php

require_once __DIR__ . "/Database.php";

class User {

    private $conn;

    public function __construct() {

        $database = new Database();

        $this->conn = $database->connect();
    }

    public function register($username, $password) {

        $stmt = $this->conn->prepare(
            "INSERT INTO users (UserName, UserPassword)
             VALUES (?, ?)"
        );

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ss",
            $username,
            $password
        );

        $success = $stmt->execute();

        $stmt->close();

        return $success;
    }

    public function findByUsername($username) {

        $sql = "SELECT *
                FROM users
                WHERE UserName = ?
                LIMIT 1";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $username);

        $stmt->execute();

        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        $stmt->close();

        return $user;
    }

    public function login($username, $password) {

        $user = $this->findByUsername($username);

        if (!$user) {
            return false;
        }

        return $user['UserPassword'] === $password;
    }
}

?>