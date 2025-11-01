<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$id = (int) $_POST['id'];
$comment = getCommentById($id);

if ($comment && (int) $comment['user_id'] === $_SESSION['user_id']) {
    deleteComment($id);
    redirect('home', $comment['post_id']);
}
redirect('home');
