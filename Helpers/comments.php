<?php
if (!function_exists('getComments')) {
    function getComments(): array
    {
        $myId = $_SESSION['user_id'] ?? 0;
        $conn = dbConnect();
        $result = $conn->query("SELECT comments.*, users.name AS author_name, users.profile_image AS author_image,
        (SELECT COUNT(*) FROM likes WHERE likable = 'comment' and likable_id = comments.id) as likes,
        (SELECT EXISTS(SELECT * FROM likes WHERE likable = 'comment' and likable_id = comments.id AND user_id = $myId)) as my_like
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

if (!function_exists('toggleCommentLike')) {
    function toggleCommentLike(int $commentId, int $userId): void
    {
        $conn = dbConnect();
        // Check if the user has already liked the comment
        $result = $conn->query("SELECT * FROM likes WHERE likable = 'comment' AND likable_id = $commentId AND user_id = $userId");
        if ($result->num_rows > 0) {
            // User has liked the comment, so remove the like
            $conn->query("DELETE FROM likes WHERE likable = 'comment' AND likable_id = $commentId AND user_id = $userId");
        } else {
            // User has not liked the comment, so add a like
            $conn->query("INSERT INTO likes (likable, likable_id, user_id) VALUES ('comment', $commentId, $userId)");
        }
    }
}
