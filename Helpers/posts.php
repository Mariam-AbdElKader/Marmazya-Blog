<?php

if(!function_exists('getPostMaxLength')){
    function getPostMaxLength(): int
    {
        return 1500;
    }
}

if (!function_exists('getPosts')) {
    function getPosts(): array
    {
        $conn = dbConnect();
        $result = $conn->query("SELECT posts.*, users.name AS author_name, users.profile_image AS author_image 
        FROM posts 
        LEFT JOIN users ON posts.user_id = users.id 
        ORDER BY posts.id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}


if (!function_exists('addPost')) {
    function addPost(string $message, ?int $user_id): void
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("INSERT INTO posts (message, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $message, $user_id);
        $stmt->execute();
    }
}

if (!function_exists('getPostById')) {
    function getPostById(int $id): ?array
    {
        $conn = dbConnect();
        $result = $conn->query("SELECT * FROM posts WHERE id = $id");
        return $result->fetch_assoc();
    }
}


if (!function_exists('updatePost')) {
    function updatePost(int $id, string $message): void
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("UPDATE posts SET message = ? WHERE id = ?");
        $stmt->bind_param("si", $message, $id);
        $stmt->execute();
    }
}

if (!function_exists('deletePost')) {
    function deletePost(int $id): void
    {
        $conn = dbConnect();
        $conn->query("DELETE FROM posts WHERE id = $id");
    }
}
