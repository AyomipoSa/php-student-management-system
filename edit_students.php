<?php
session_start();

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header("Location: login.php");
    exit();
}

require_once "Student.php";
require_once "City.php";

$studentObj = new Student("", "", "", "", "", "");
$cityObj = new City();

$data = $studentObj->getStudentById($_GET['id'] ?? 0);
$cities = $cityObj->getAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentObj->updateStudent(
        $_POST['id'],
        $_POST['fname'],
        $_POST['lname'],
        $_POST['phone'],
        $_POST['email'],
        $_POST['gender'],
        $_POST['cityID']
    );

    header("Location: students.php");
    exit();
}
?>