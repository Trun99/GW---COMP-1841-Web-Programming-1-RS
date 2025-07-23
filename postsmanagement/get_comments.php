<?php
session_start();
require_once '../includes/DatabaseConnection.php';
require_once '../includes/DatabaseFunction.php';

if (isset($_GET['question_id'])) {
    $question_id = (int)$_GET['question_id'];
    $comments = getCommentsByQuestionId($pdo, $question_id);
    
    if (empty($comments)) {
        echo '<p class="comment-empty">No comments yet. Be the first to comment!</p>';
    } else {
        foreach ($comments as $comment) {
            echo '<div class="comment-item">';
            echo '<div class="comment-header">';
            echo '<span class="comment-author">' . htmlspecialchars($comment['username']) . '</span>';
            echo '<span class="comment-date">' . date('M j, Y H:i', strtotime($comment['date_posted'])) . '</span>';
            echo '</div>';
            echo '<div class="comment-content">' . nl2br(htmlspecialchars($comment['content'])) . '</div>';
            echo '</div>';
        }
    }
}
?>

