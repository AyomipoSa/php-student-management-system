<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>


<?php

require_once "Student.php";

$student = new Student("", "", "", "", "");

$students = $student->getAllStudents();

foreach ($students as $row) {

    echo $row['studentName'] . "<br>";
}
