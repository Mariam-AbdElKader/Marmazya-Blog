<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$id = (int) $_POST['id'];
$post = getPostById($id);
if (is_null($post) || $post['user_id'] !== $_SESSION['user']['id']) {
    return redirect('home');
}

$message = sanitize($_POST['message']);

updatePost($id, $message);

redirect('home');
