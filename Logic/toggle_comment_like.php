<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$commentId = (int) $_POST['comment_id'];
$comment = getCommentById($commentId);

if( !$comment ) { // Comment does not exist
    redirect('home');
}

$user_id = (int) currentUser()['id'];

toggleCommentLike(
    $commentId,
    $user_id
);


redirect('home', $comment['post_id']);