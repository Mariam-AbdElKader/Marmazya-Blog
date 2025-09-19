<div class="card bg-base-100 mb-5 shadow-xl">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="<?= $post['user']['profile_image'] ?? defaultProfileImage($post['user']['id']) ?>"
                        alt="<?= htmlspecialchars($post['user']['name']) ?>'s avatar" class="rounded-full" />
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        <p class="text-sm font-semibold">
                            <?= htmlspecialchars($post['user']['name']) ?>
                        </p>
                        <span class="text-base-content/60">·</span>
                        <p class="text-sm text-base-content/60">
                            <?= diffForHumans($post['created_at']) ?>
                        </p>
                    </div>

                    <?php if (!empty($_SESSION['user']) && $_SESSION['user']['id'] === $post['user_id']): ?>
                        <!-- Edit/Delete Buttons -->
                        <div class="flex gap-1">
                            <a href="/Views/edit_post.php?id=<?= $post['id'] ?>" class="btn btn-ghost btn-xs">
                                Edit
                            </a>
                            <form method="POST" action="/Logic/delete.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this post?')"
                                    class="btn btn-ghost btn-xs text-error">
                                    Delete
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>

                <p class="mt-1">
                    <?= nl2br(htmlspecialchars($post['message'])) ?>
                </p>
            </div>
        </div>
    </div>
</div>