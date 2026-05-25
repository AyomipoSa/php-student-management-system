<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

if (empty($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . "/classes/Student.php";
require_once __DIR__ . "/classes/City.php";
require_once __DIR__ . "/classes/Language.php";

$cityObj = new City();
$languageObj = new Language();

$cities = $cityObj->getAll();
$languages = $languageObj->all();

$error = [];
$name = "";
$surname = "";
$phone = "";
$email = "";
$gender = "";
$city = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["fname"] ?? "");
    $surname = trim($_POST["lname"] ?? "");
    $city = (int)($_POST["cityID"] ?? 0);
    $phone = trim($_POST["phone"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $gender = trim($_POST["gender"] ?? "");

    if ($name === "") {
        $error["name"] = "Name is required";
    }

    if ($surname === "") {
        $error["surname"] = "Surname is required";
    }

    if ($city <= 0) {
        $error["city"] = "City is required";
    }

    if (empty($error)) {
        $student = new Student($name, $surname, $phone, $email, $gender, $city);

        if ($student->save()) {
            header("Location: students.php");
            exit();
        } else {
            die("Error saving student");
        }
    }
}

require __DIR__ . "/templates/student_form.php";