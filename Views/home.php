<?php
$title = 'Home';
require 'header.php';
$posts = array_reverse(getPosts());
?>

<div class="max-w-2xl mx-auto">

  <div class="card bg-base-100 shadow mt-8 mb-6">
    <div class="card-body">
      <form method="POST" action="/Logic/post.php">

        <div class="form-control w-full">
          <textarea
            name="message"
            placeholder="What's on your mind?"
            class="textarea textarea-bordered w-full resize-none"
            rows="4"
            maxlength="255"
            required></textarea>
        </div>

        <div class="mt-4 flex items-center justify-end">
          <button type="submit" class="btn btn-primary btn-sm">
            Post
          </button>
        </div>
      </form>
    </div>
  </div>

  <?php
  foreach ($posts as $post) {
    $post['user'] = is_null($post['user_id']) ? anonymousUser() : getUserById($post['user_id']);
    $post['created_at'] = new DateTimeImmutable()->setTimestamp($post['created_at']);
    include 'Component/post_card.php';
  }
  if (empty($posts)) {
    echo '<p class="text-center text-base-content/60">No posts yet. 😥 Be the first to post! 1️⃣</p>';
  }
  ?>
</div>
<?php require 'footer.php' ?>