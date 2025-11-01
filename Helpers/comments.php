<?php
if (!function_exists('getComments')) {
    function getComments(): array
    {
        $conn = dbConnect();
        $result = $conn->query("SELECT comments.*, users.name AS author_name, users.profile_image AS author_image
        FROM comments
        JOIN users ON comments.user_id = users.id
        ORDER BY comments.id DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

if (!function_exists('getCommentById')) {
    function getCommentById(int $id): ?array
    {
        $conn = dbConnect();
        $result = $conn->query("SELECT * FROM comments WHERE id = $id");
        return $result->fetch_assoc();
    }
}

if (!function_exists('addComment')) {
    function addComment(int $postId, int $userId, string $comment): void
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $postId, $userId, $comment);
        $stmt->execute();
    }
}

if (!function_exists('deleteComment')) {
    function deleteComment(int $id): void
    {
        $conn = dbConnect();
        $conn->query("DELETE FROM comments WHERE id = $id");
    }
}