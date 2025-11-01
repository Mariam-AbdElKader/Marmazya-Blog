<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$postId = (int) $_POST['post_id'];
$post = getPostById($postId);

if( !$post ) { // Post does not exist
    redirect('home');
}


$comment = sanitize($_POST['comment']);
$user_id = (int) currentUser()['id'];

addComment(
    $postId,
    $user_id,
    $comment
);


redirect('home', $postId);