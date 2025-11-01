<!-- One Comment -->
<div class="flex space-x-3 mb-3">
    <div class="avatar">
        <div class="size-8 rounded-full">
            <img src="<?= $comment['author_image'] ?? defaultProfileImage($comment['user_id']) ?>" alt="Commenter avatar">
        </div>
    </div>

    <div class="bg-base-200 rounded-2xl p-3 flex-1">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium"><?= htmlspecialchars($comment['author_name']) ?></p>
                <p class="text-sm"><?= htmlspecialchars($comment['comment']) ?></p>
                
                <?php include 'like_comment_component.php' ?>
                
                <p class="text-xs text-base-content/60 mt-1">
                    <?= diffForHumans(new DateTimeImmutable($comment['created_at'])) ?>
                </p>
            </div>

            <!-- Delete Button (only for comment owner) -->
            <?php if (!empty($_SESSION['user_id']) && $_SESSION['user_id'] === (int) $comment['user_id']): ?>
                <form method="POST" action="/Logic/delete_comment.php" class="ml-2">
                    <input type="hidden" name="id" value="<?= $comment['id'] ?>">
                    <button
                        type="submit"
                        onclick="return confirm('Are you sure you want to delete this comment?')"
                        class="btn btn-ghost btn-xs text-error">
                        Delete
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>