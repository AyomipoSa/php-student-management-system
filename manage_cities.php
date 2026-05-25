<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>


<?php
session_start();

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . "/classes/City.php";

$cityObj = new City();
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add') {
        $cityName = trim($_POST['cityName'] ?? '');
        if ($cityName !== '') {
            $cityObj->add($cityName);
            $success = "City added.";
        }
    }

    if ($action === 'update') {
        $cityID = (int)($_POST['cityID'] ?? 0);
        $cityName = trim($_POST['cityName'] ?? '');
        if ($cityID > 0 && $cityName !== '') {
            $cityObj->update($cityID, $cityName);
            $success = "City updated.";
        }
    }

    if ($action === 'delete') {
        $cityID = (int)($_POST['cityID'] ?? 0);
        if ($cityID > 0) {
            $cityObj->delete($cityID);
            $success = "City deleted.";
        }
    }
}

$sort = (($_GET['sort'] ?? 'asc') === 'desc') ? 'DESC' : 'ASC';
$cities = $cityObj->getAll($sort);

$title = "Manage Cities";
require __DIR__ . "/templates/manage_cities.php";