<?php
require_once __DIR__ . '/../Helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$message = sanitize($_POST['message']);
$user_id = $_SESSION['user_id'] ?? null;

addPost(
    $message,
    $user_id
);


redirect('home');