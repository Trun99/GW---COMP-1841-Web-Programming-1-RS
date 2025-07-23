<?php
session_start();
header('Content-Type: application/json');

require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['error' => 'Access denied. Admins only.']);
    exit;
}


$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Post ID is required']);
    exit;
}

try {
   
    $post = getQuestionById($pdo, $post_id);
    
    if (!$post) {
        http_response_code(404);
        echo json_encode(['error' => 'Post not found']);
        exit;
    }
    
    
    echo json_encode([
        'id' => $post['id'],
        'title' => $post['title'],
        'content' => $post['content'],
        'module_id' => $post['module_id'],
        'image_path' => $post['image_path'],
        'user_id' => $post['user_id'],
        'date_posted' => $post['date_posted']
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}
?> 