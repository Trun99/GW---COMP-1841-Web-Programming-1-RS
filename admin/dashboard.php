<?php
session_start();

require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php'; 


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('HTTP/1.1 403 Forbidden');
    echo 'Access denied. Admins only.';
    exit;
}


$totalUsers = $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$totalPosts = $pdo->query('SELECT COUNT(*) FROM questions')->fetchColumn();
$totalModules = $pdo->query('SELECT COUNT(*) FROM modules')->fetchColumn();


$recentPosts = $pdo->query('
    SELECT q.*, u.username, m.name AS module_name
    FROM questions q
    LEFT JOIN users u ON q.user_id = u.id
    LEFT JOIN modules m ON q.module_id = m.id
    ORDER BY q.date_posted DESC
    LIMIT 5
')->fetchAll();

ob_start();
include '../templates/admin_dashboard.html.php';
$content = ob_get_clean();
include '../templates/layout.html.php';
?> 