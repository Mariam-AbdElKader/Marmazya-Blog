<?php
require_once __DIR__ . '/../Helpers/helpers.php';
guestOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('login');
}

$data = $_POST;
$user = getUserByEmail($data['email']);
if ($user && password_verify($data['password'], $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    redirect('home');
}

$errors = [
    'password' => 'Email or Password might be incorrect'
];

$_SESSION['errors'] = $errors;
$_SESSION['old'] = $data;

redirect('login');
