<?php
session_start();

require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php'; 


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access denied. Admins only.';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id']) && isset($_POST['new_role'])) {
    $user_id = $_POST['user_id'] ?? 0;
    $new_role = $_POST['new_role'] ?? '';
    
   
    if ($user_id == $_SESSION['user_id']) {
        header('Location: manageusers.php');
        exit;
    }
    
    if (in_array($new_role, ['user', 'admin'])) {
        updateUserRole($pdo, $user_id, $new_role);
    }
    
    header('Location: manageusers.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'] ?? 0;
    
    
    if ($id != $_SESSION['user_id']) {
        deleteUser($pdo, $id); 
    }
    
    header('Location: manageusers.php');
    exit;
}

$users = getAllUsers($pdo); 


ob_start();
include '../templates/manageusers.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
