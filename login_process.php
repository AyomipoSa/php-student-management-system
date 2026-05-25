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

if ($username === '' || $password === '') {
    $_SESSION['login_error'] = "Username and password are required.";
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("
    SELECT UserName, UserPassword
    FROM users
    WHERE UserName = ?
    LIMIT 1
");

if (!$stmt) {
    die("Database query error: " . $conn->error);
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['UserPassword'])) {
    session_regenerate_id(true);
    $_SESSION['logged'] = true;
    $_SESSION['user'] = $user['UserName'];
    header("Location: students.php");
    exit();
}

$_SESSION['login_error'] = "Wrong username or password.";
header("Location: login.php");
exit();