<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

require_once __DIR__ . "/classes/Database.php";

$database = new Database();
$conn = $database->connect();

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');
$confirm  = trim($_POST['confirm'] ?? '');

if ($username === '' || $password === '' || $confirm === '') {
    $_SESSION['register_error'] = "All fields are required.";
    header("Location: register.php");
    exit();
}

if ($password !== $confirm) {
    $_SESSION['register_error'] = "Passwords do not match.";
    header("Location: register.php");
    exit();
}

$check = $conn->prepare("SELECT 1 FROM users WHERE UserName = ? LIMIT 1");
if (!$check) {
    die("Database query error: " . $conn->error);
}

$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    $_SESSION['register_error'] = "Username already exists.";
    header("Location: register.php");
    exit();
}

$check->close();

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (UserName, UserPassword) VALUES (?, ?)");
if (!$stmt) {
    die("Database query error: " . $conn->error);
}

$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    $_SESSION['register_success'] = "Account created successfully. Please login.";
    header("Location: login.php");
    exit();
}

$_SESSION['register_error'] = "Could not create account.";
header("Location: register.php");
exit();