<?php
require_once __DIR__ . '/../Helpers/helpers.php';
guestOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('login');
}

$data = $_POST;
$users = getUsers();

foreach ($users as $user) {
    if ($data['email'] === $user['email'] && $data['password'] === $user['password']) {
        $_SESSION['user'] = $user;
        redirect('home');
    }
}

$errors = [
    'password' => 'Email or Password might be incorrect'
];

$_SESSION['errors'] = $errors;
$_SESSION['old'] = $data;

redirect('login');
