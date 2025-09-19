<?php
require_once __DIR__ . '/../Helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('home');
}

$message = sanitize($_POST['message']);
$user_id = $_SESSION['user']['id'] ?? null;

addPost([
    'message' => $message,
    'user_id' => $user_id,
    'created_at' => time()
]);

redirect('home');