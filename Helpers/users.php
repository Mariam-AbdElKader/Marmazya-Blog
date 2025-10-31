<?php

if (!function_exists('addUser')) {
    function addUser(array $user): int
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $user['name'], $user['email'], $user['password']);
        $stmt->execute();
        return $stmt->insert_id;
    }
}

if (!function_exists('getUserById')) {
    function getUserById(int $id): ?array
    {
        $conn = dbConnect();
        $result = $conn->query("SELECT * FROM users WHERE id = $id");
        return $result->fetch_assoc();
    }
}

if (!function_exists('getUserByEmail')) {
    function getUserByEmail(string $email): ?array
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

if (!function_exists('updateUser')) {
    function updateUser(int $id, array $userData)
    {
        $conn = dbConnect();
        $fields = [];
        $types = '';
        $values = [];

        $userData = array_filter($userData);

        foreach ($userData as $key => $value) {
            $fields[] = "$key = ?";
            $types .= 's';
            $values[] = $value;
        }

        $values[] = $id;
        $types .= 'i';

        $sql = "UPDATE users SET " . implode(' , ', $fields) . " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param($types, ...$values);
        $stmt->execute();
    }
}

if (!function_exists('defaultProfileImage')) {
    function defaultProfileImage($id): string
    {
        return "https://avatars.laravel.cloud/Marmazya_$id?vibe=sunset";
    }
}

if (!function_exists('anonymousUser')) {
    function anonymousUser(): array
    {
        return [
            'id' => null,
            'name' => 'Anonymous',
            'profile_image' => 'https://avatars.laravel.cloud/Marmazya_anonymous?vibe=sunset',
        ];
    }
}

if (!function_exists('authOnly()')) {
    function authOnly()
    {
        if (empty(currentUser())) {
            redirect('login');
        }
    }
};

if (!function_exists('guestOnly()')) {
    function guestOnly()
    {
        if (!empty(currentUser())) {
            redirect('home');
        }
    }
};

if (!function_exists('currentUser')) {
    function currentUser(): ?array
    {
        static $currentUser = false;

        if ($currentUser !== false) {
            return $currentUser; // already loaded or null
        }

        if (empty($_SESSION['user_id'])) {
            $currentUser = null;
            return null;
        }

        $user = getUserById($_SESSION['user_id']);

        if (!$user) {
            // user deleted → cleanup session
            unset($_SESSION['user_id']);
            $currentUser = null;
            return null;
        }

        $currentUser = $user;
        return $user;
    }
}
