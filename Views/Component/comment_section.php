<!-- Comment Section -->
<div class="mt-5 border-t border-base-200 pt-4">
    <?php
    foreach ($comments as $comment) {
        if ($comment['post_id'] === $post['id']) {
            include 'comment_card.php';
        }
    }
    ?>

    <!-- Add New Comment -->
    <?php if (currentUser()): ?>
        <form method="POST" action="/Logic/add_comment.php" class="mt-4 flex items-center gap-3">
            <div class="avatar">
                <div class="size-8 rounded-full">
                    <img src="<?= currentUser()['profile_image'] ?? defaultProfileImage(currentUser()['id']) ?>" alt="Your avatar">
                </div>
            </div>
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <input
                type="text"
                name="comment"
                placeholder="Write a comment..."
                class="input input-bordered input-sm flex-1 rounded-full"
                required>
            <button type="submit" class="btn btn-sm btn-primary rounded-full">Reply</button>
        </form>
    <?php endif; ?>
</div>