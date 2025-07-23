<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $question_id = $_POST['question_id'] ?? null;
    $content = trim($_POST['content'] ?? '');
    $user_id = $_SESSION['user_id'];

    if ($question_id && !empty($content)) {
        if (addComment($pdo, $question_id, $user_id, $content)) {
            echo json_encode(['success' => true, 'message' => 'Comment added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add comment']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
}
?>
