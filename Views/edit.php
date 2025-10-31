<?php
$title = 'Edit Profile';
require 'header.php';
authOnly();
$errors = !empty($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<div class="hero min-h-[calc(100vh-16rem)]">
    <div class="hero-content flex-col w-full max-w-md mx-auto px-4">
        <div class="card w-full max-w-sm bg-base-100 shadow-xl">
            <div class="card-body p-4 sm:p-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-center mb-4 sm:mb-6">Edit Profile</h1>

                <form method="POST" action="../Logic/edit.php" enctype="multipart/form-data" class="space-y-4">
                    <!-- Name -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="text"
                                name="name"
                                placeholder="John Doe"
                                value="<?= htmlspecialchars($currentUser['name']) ?>"
                                class="input input-bordered w-full<?php if (!empty($errors['name'])) echo ' input-error'; ?>"
                                required>
                            <span>Name</span>
                        </label>
                        <?php if (!empty($errors['name'])): ?>
                            <div class="label -mt-2">
                                <span class="label-text-alt text-error"><?= $errors['name'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Email -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="email"
                                name="email"
                                placeholder="mail@example.com"
                                value="<?= htmlspecialchars($currentUser['email']) ?>"
                                class="input input-bordered w-full<?php if (!empty($errors['email'])) echo ' input-error'; ?>"
                                required>
                            <span>Email</span>
                        </label>
                        <?php if (!empty($errors['email'])): ?>
                            <div class="label -mt-2">
                                <span class="label-text-alt text-error"><?= $errors['email'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Password -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="password"
                                name="password"
                                placeholder="••••••••"
                                class="input input-bordered w-full<?php if (!empty($errors['password'])) echo ' input-error'; ?>"
                                >
                            <span>Password (if empty, no change)</span>
                        </label>
                        <?php if (!empty($errors['password'])): ?>
                            <div class="label -mt-2">
                                <span class="label-text-alt text-error"><?= $errors['password'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Password Confirmation -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="password"
                                name="password_confirmation"
                                placeholder="••••••••"
                                class="input input-bordered w-full"
                                >
                            <span>Confirm Password</span>
                        </label>
                    </div>

                    <!-- File Upload -->
                    <div class="form-control">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <label for="profile_image" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 border rounded-md shadow-sm hover:bg-gray-50 transition-colors">
                                <!-- Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                                <span class="text-sm">Upload Profile Image</span>
                                <!-- visually-hidden native input -->
                                <input id="profile_image" name="profile_image" type="file" accept=".png, .jpg, .jpeg" class="sr-only">
                            </label>
                            <p id="file-name" class="text-sm text-gray-500 flex-1">No file chosen</p>
                        </div>
                        <?php if (!empty($errors['profile_image'])): ?>
                            <div class="label -mt-2">
                                <span class="label-text-alt text-error"><?= $errors['profile_image'] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            Update Profile
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