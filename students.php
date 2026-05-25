<?php
session_start();

if (empty($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . "/classes/Student.php";

$studentObj = new Student();

$search = trim($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 5;
$offset = ($page - 1) * $perPage;

$totalStudents = $studentObj->countStudents($search);
$totalPages = max(1, (int)ceil($totalStudents / $perPage));

$students = $studentObj->getStudentsPaginated($perPage, $offset, $search);

require __DIR__ . "/templates/students.php";