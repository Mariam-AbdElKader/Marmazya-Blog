<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();
if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    redirect('home');
}

$id =(int) $_POST['id'];
$post = getPostById($id);

if($post && (int) $post['user_id'] === $_SESSION['user_id']){
    deletePost($id);
    redirect('home');
}

redirect('home');