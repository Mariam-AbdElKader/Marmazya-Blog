<?php
$title = "Edit Post #{$_GET['id']}";
require 'header.php';
authOnly();
$id = (int) $_GET['id'];
$post = getPostById($id);
?>

<div class="max-w-2xl mx-auto">

  <div class="card bg-base-100 shadow mt-8 mb-6">
    <div class="card-body">
      <form method="POST" action="/Logic/edit_post.php">
        <input type="hidden" name="id" value="<?= $post['id'] ?>">
        <div class="form-control w-full">
          <textarea
            name="message"
            placeholder="What's on your mind?"
            class="textarea textarea-bordered w-full resize-none"
            rows="4"
            maxlength="255"
            required><?= $post['message'] ?></textarea>
        </div>

        <div class="mt-4 flex items-center justify-end">
          <button type="submit" class="btn btn-primary btn-sm">
            Save
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require 'footer.php' ?>