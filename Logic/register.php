<?php
require_once __DIR__ . '/../Helpers/helpers.php';
guestOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('register');
}

$data = array_map('sanitize', $_POST);


$rules = [
    'name' => ['required'],
    'email' => ['required', 'email'],
    'password' => ['required', 'min:8', 'max:32', 'password', 'confirmed'],
];
$errors = validate($data, $rules);


if (empty($errors)) {
    unset($data['password_confirmation']);
    $user = addUser($data);
    $_SESSION['user'] = $user;

    redirect('home');
}

$_SESSION['errors'] = $errors;
unset($data['password'], $data['password_confirmation']);
$_SESSION['old'] = $data;

redirect('register');
