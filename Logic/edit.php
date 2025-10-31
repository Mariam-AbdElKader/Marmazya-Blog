<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('edit');
}

$data = array_map('sanitize', $_POST);

$rules = [
    'name' => ['required'],
    'email' => ['required', 'email'],
    'password' => ['min:8', 'max:32', 'password', 'confirmed'],
];

$errors = validate($data, $rules);

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png'];
    $fileType = $_FILES['profile_image']['type'];
    $fileSize = $_FILES['profile_image']['size'];

    // Validate file type
    if (!in_array($fileType, $allowedTypes)) {
        $errors['profile_image'] = 'Only JPG or PNG files are allowed.';
    }

    // Validate file size
    if ($fileSize > 10 * 1024 * 1024) {
        $errors['profile_image'] = 'File size must be less than 10MB.';
    }
}


if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    redirect('edit');
}

if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../Storage/images/users/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $fileExtension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $fileName = uniqid('user_') . '.' . $fileExtension;
    $uploadFilePath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFilePath)) {
        $data['profile_image'] = '/Storage/images/users/' . $fileName;
        // Optionally, delete the old image if it exists
        if (!empty(currentUser()['profile_image']) && file_exists(__DIR__ . '/..' . currentUser()['profile_image'])) {
            unlink(__DIR__ . '/..' . currentUser()['profile_image']);
        }
    }
} else {
    // If no new image is uploaded, retain the old image path
    $data['profile_image'] = currentUser()['profile_image'] ?? null;
}
unset($data['password_confirmation']);
$data['password'] = !empty($data['password']) ? password_hash($data['password'], PASSWORD_BCRYPT) : null;
updateUser(currentUser()['id'], $data);
redirect('home');
