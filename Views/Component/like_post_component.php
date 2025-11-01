<div class="mt-3 flex items-center gap-2">
    <form method="POST" action="/Logic/toggle_like.php" class="flex items-center gap-1">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <button type="submit" class="like-btn btn btn-ghost btn-xs p-1" aria-label="Like post">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="currentColor"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
                class="size-5 transition-colors duration-200 text-base-content/60 hover:text-red-500 <?= $post['my_like'] ? 'text-red-500' : '' ?>">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                         2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09
                                         C13.09 3.81 14.76 3 16.5 3
                                         19.58 3 22 5.42 22 8.5
                                         c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
            </svg>
        </button>
    </form>
    <span class="text-sm text-base-content/70"><?= $post['likes'] ?> likes</span>
</div>