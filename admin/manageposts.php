<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../corephpfiles/community.php');
    exit;
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = (int)$_POST['delete_id'];
    deleteQuestion($pdo, $delete_id);
    header('Location: manageposts.php');
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $edit_id = (int)$_POST['edit_id'];
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $module_id = (int)($_POST['module_id'] ?? 0);
    $user_id = (int)($_POST['user_id'] ?? 0);
    $imagePath = null;
    $question = getQuestionById($pdo, $edit_id);
    if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        require_once '../includes/DatabaseFunction.php';
        $imagePath = uploadImage($_FILES['image']);
    } else {
        $imagePath = $question['image_path'];
    }
    updateQuestion($pdo, $edit_id, $title, $content, $user_id, $module_id, $imagePath);
    header('Location: manageposts.php');
    exit;
}

// For edit form
$edit_question = null;
$modules = getAllModulesBasic($pdo);
$users = getAllUsersBasic($pdo);
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_question = getQuestionById($pdo, $edit_id);
}

$questions = getAllQuestionsBasic($pdo);

ob_start();
include '../templates/manageposts.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
?> 