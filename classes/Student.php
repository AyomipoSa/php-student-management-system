<?php

require_once __DIR__ . "/Database.php";

class Student {
    private $conn;
    private $name;
    private $surname;
    private $phone;
    private $email;
    private $gender;
    private $cityID;

    public function __construct($name = "", $surname = "", $phone = "", $email = "", $gender = "", $cityID = "") {
        $this->conn = (new Database())->connect();

        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
        $this->gender = $gender;
        $this->cityID = $cityID;
    }

    public function save() {
        $sql = "INSERT INTO student
                (studentName, studentSurname, studentPhone, studentEmail, studentGender, studentCity)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param(
            "sssssi",
            $this->name,
            $this->surname,
            $this->phone,
            $this->email,
            $this->gender,
            $this->cityID
        );

        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function getAllStudents() {
        $students = [];

        $sql = "SELECT s.studentID, s.studentName, s.studentSurname, s.studentPhone,
                       s.studentEmail, s.studentGender, c.cityName
                FROM student s
                LEFT JOIN cities c ON s.studentCity = c.cityID
                ORDER BY s.studentID DESC";

        $result = $this->conn->query($sql);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row;
            }
        }

        return $students;
    }

    public function countStudents($search = '') {
        $sql = "SELECT COUNT(*) AS total
                FROM student s
                LEFT JOIN cities c ON s.studentCity = c.cityID
                WHERE s.studentName LIKE ?
                   OR s.studentSurname LIKE ?
                   OR s.studentPhone LIKE ?
                   OR s.studentEmail LIKE ?
                   OR c.cityName LIKE ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $term = '%' . $search . '%';
        $stmt->bind_param("sssss", $term, $term, $term, $term, $term);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        return (int)($row['total'] ?? 0);
    }

    public function getStudentsPaginated($limit, $offset, $search = '') {
        $students = [];

        $sql = "SELECT s.studentID, s.studentName, s.studentSurname, s.studentPhone,
                       s.studentEmail, s.studentGender, c.cityName
                FROM student s
                LEFT JOIN cities c ON s.studentCity = c.cityID
                WHERE s.studentName LIKE ?
                   OR s.studentSurname LIKE ?
                   OR s.studentPhone LIKE ?
                   OR s.studentEmail LIKE ?
                   OR c.cityName LIKE ?
                ORDER BY s.studentID DESC
                LIMIT ? OFFSET ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $term = '%' . $search . '%';
        $limit = (int)$limit;
        $offset = (int)$offset;

        $stmt->bind_param("sssssii", $term, $term, $term, $term, $term, $limit, $offset);
        $stmt->execute();

        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }

        $stmt->close();
        return $students;
    }

    public function getStudentById($id) {
        $sql = "SELECT s.studentID, s.studentName, s.studentSurname,
                       s.studentPhone, s.studentEmail, s.studentGender,
                       s.studentCity, c.cityName
                FROM student s
                LEFT JOIN cities c ON s.studentCity = c.cityID
                WHERE s.studentID = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $student = $result ? $result->fetch_assoc() : null;

        $stmt->close();
        return $student;
    }

    public function updateStudent($id, $name, $surname, $phone, $email, $gender, $cityID) {
        $sql = "UPDATE student
                SET studentName = ?, studentSurname = ?, studentPhone = ?, studentEmail = ?, studentGender = ?, studentCity = ?
                WHERE studentID = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("sssssii", $name, $surname, $phone, $email, $gender, $cityID, $id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    public function deleteStudent($id) {
        $sql = "DELETE FROM student WHERE studentID = ?";

        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }
}
?>