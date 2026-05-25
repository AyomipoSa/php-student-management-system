<?php
session_start();

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header("Location: login.php");
    exit();
}

require_once "Student.php";

$studentObj = new Student("", "", "", "", "");
$studentObj->deleteStudent($_GET['id'] ?? 0);

header("Location: students.php");
exit();
?>