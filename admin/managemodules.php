<?php
session_start();

require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php'; 


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access denied. Admins only.';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $modulename = $_POST['modulename'] ?? '';

    if (!empty($modulename)) {
        addModule($pdo, $modulename); 
    }

    header('Location: managemodules.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'] ?? 0;
    deleteModule($pdo, $id); 
    header('Location: managemodules.php');
    exit;
}

//handle module deletion

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'] ?? 0;
    $modulename = $_POST['modulename'] ?? '';

    if (!empty($modulename) && $id > 0) {
        updateModule($pdo, $id, $modulename);
    }

    header('Location: managemodules.php');
    exit;
}

// get module to edit
$edit_module = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_module = getModuleById($pdo, $edit_id);
}

$modules = getAllModules($pdo); 


ob_start();
include '../templates/managemodules.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
?>
