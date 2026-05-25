<?php
session_start();

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . "/classes/Student.php";

$studentObj = new Student();
$student = $studentObj->getStudentById((int)($_GET['id'] ?? 0));

require __DIR__ . "/templates/student.php";