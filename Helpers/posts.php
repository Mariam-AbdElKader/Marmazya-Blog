<?php

if (!function_exists('getPostMaxLength')) {
    function getPostMaxLength(): int
    {
        return 1500;
    }
}

if (!function_exists('getPosts')) {
    function getPosts(): array
    {
        $myId = $_SESSION['user_id'] ?? 0;
        $conn = dbConnect();
        $result = $conn->query("SELECT posts.*, users.name AS author_name, users.profile_image AS author_image,
        (SELECT COUNT(*) FROM likes WHERE likable = 'post' and likable_id = posts.id) as likes,
        (SELECT EXISTS(SELECT * FROM likes WHERE likable = 'post' and likable_id = posts.id AND user_id = $myId)) as my_like
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

if (!function_exists('togglePostLike')) {
    function togglePostLike(int $postId, int $userId): void
    {
        $conn = dbConnect();
        // Check if the user has already liked the post
        $result = $conn->query("SELECT * FROM likes WHERE likable = 'post' AND likable_id = $postId AND user_id = $userId");
        if ($result->num_rows > 0) {
            // User has liked the post, so remove the like
            $conn->query("DELETE FROM likes WHERE likable = 'post' AND likable_id = $postId AND user_id = $userId");
        } else {
            // User has not liked the post, so add a like
            $conn->query("INSERT INTO likes (likable, likable_id, user_id) VALUES ('post', $postId, $userId)");
        }
    }
}
