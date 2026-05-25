<?php

session_start();

if (empty($_SESSION['logged'])) {
    header("Location: login.php");
    exit();
}

require_once __DIR__ . "/classes/Language.php";

$languageObj = new Language();

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';

    if ($action === 'add') {

        $languageName = trim($_POST['languageName'] ?? '');

        if ($languageName !== '') {

            $languageObj->create($languageName);

            $success = "Language added.";
        }
    }

    if ($action === 'update') {

        $languageID = (int)($_POST['languageID'] ?? 0);

        $languageName = trim($_POST['languageName'] ?? '');

        if ($languageID > 0 && $languageName !== '') {

            $languageObj->update($languageID, $languageName);

            $success = "Language updated.";
        }
    }

    if ($action === 'delete') {

        $languageID = (int)($_POST['languageID'] ?? 0);

        if ($languageID > 0) {

            $languageObj->delete($languageID);

            $success = "Language deleted.";
        }
    }
}

$sort = (($_GET['sort'] ?? 'asc') === 'desc') ? 'DESC' : 'ASC';

$languages = $languageObj->all($sort);

$title = "Manage Languages";

require __DIR__ . "/templates/manage_languages.php";

?>