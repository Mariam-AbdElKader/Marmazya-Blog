<?php
$title = 'Edit Profile';
require 'header.php';
authOnly();
$errors = !empty($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<div class="hero min-h-[calc(100vh-16rem)]">
    <div class="hero-content flex-col">
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="text-3xl font-bold text-center mb-6">Edit Profile</h1>

                <form method="POST" action="../Logic/edit.php" enctype="multipart/form-data">
                    <!-- Name -->
                    <label class="floating-label mb-3">
                        <input type="text"
                            name="name"
                            placeholder="John Doe"
                            value="<?= $_SESSION['user']['name'] ?>"
                            class="input input-bordered<?php if (!empty($errors['name'])) echo ' input-error'; ?>"
                            required>
                        <span>Name</span>
                    </label>
                    <?php if (!empty($errors['name'])): ?>
                        <div class="label -mt-4 mb-2 mb-4">
                            <span class="label-text-alt text-error"><?= $errors['name'] ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Email -->
                    <label class="floating-label mb-3">
                        <input type="email"
                            name="email"
                            placeholder="mail@example.com"
                            value="<?= $_SESSION['user']['email'] ?>"
                            class="input input-bordered<?php if (!empty($errors['email'])) echo ' input-error'; ?>"
                            required>
                        <span>Email</span>
                    </label>
                    <?php if (!empty($errors['email'])): ?>
                        <div class="label -mt-4 mb-2 mb-4">
                            <span class="label-text-alt text-error"><?= $errors['email'] ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Password -->
                    <label class="floating-label mb-3">
                        <input type="password"
                            name="password"
                            value="<?= $_SESSION['user']['password'] ?>"
                            placeholder="••••••••"
                            class="input input-bordered<?php if (!empty($errors['password'])) echo ' input-error'; ?>"
                            required>
                        <span>Password</span>
                    </label>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="label -mt-4 mb-2 mb-4">
                            <span class="label-text-alt text-error"><?= $errors['password'] ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Password Confirmation -->
                    <label class="floating-label mb-3">
                        <input type="password"
                            name="password_confirmation"
                            value="<?= $_SESSION['user']['password'] ?>"
                            placeholder="••••••••"
                            class="input input-bordered"
                            required>
                        <span>Confirm Password</span>
                    </label>

                    <!-- Simple custom file input -->
                    <div class="flex items-center gap-3">
                        <label for="profile_image" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 border rounded-md shadow-sm hover:bg-gray-50">
                            <!-- Icon (optional) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-sm">Upload Profile Image</span>
                            <!-- visually-hidden native input -->
                            <input id="profile_image" name="profile_image" type="file" accept=".png, .jpg, .jpeg" class="sr-only">
                        </label>

                        <p id="file-name" class="text-sm text-gray-500">No file chosen</p>
                    </div>
                    <?php if (!empty($errors['profile_image'])): ?>
                        <div class="label -mt-4 mb-2 mb-4">
                            <span class="label-text-alt text-error"><?= $errors['profile_image'] ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Submit Button -->
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary btn-sm w-full">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const input = document.getElementById('profile_image');
    const nameEl = document.getElementById('file-name');

    input.addEventListener('change', (e) => {
        if (!input.files || input.files.length === 0) {
            nameEl.textContent = 'No file chosen';
            return;
        }
        // show first filename (change if you allow multiple)
        nameEl.textContent = input.files.length > 1 ?
            `${input.files.length} files selected` :
            input.files[0].name;
    });
</script>
<?php require 'footer.php' ?>