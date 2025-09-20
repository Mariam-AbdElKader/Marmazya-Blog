<?php
$title = 'Register';
require 'header.php';
guestOnly();
$errors = !empty($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = !empty($_SESSION['old']) ? $_SESSION['old'] : [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<div class="hero min-h-[calc(100vh-16rem)]">
    <div class="hero-content flex-col w-full max-w-md mx-auto px-4">
        <div class="card w-full max-w-sm bg-base-100 shadow-xl">
            <div class="card-body p-4 sm:p-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-center mb-4 sm:mb-6">Create Account</h1>

                <form method="POST" action="../Logic/register.php" class="space-y-4">
                    <!-- Name -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="text"
                                   name="name"
                                   placeholder="John Doe"
                                   value="<?= htmlspecialchars($old['name'] ?? '') ?>"
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
                                   value="<?= htmlspecialchars($old['email'] ?? '') ?>"
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
                                   required>
                            <span>Password</span>
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
                                   required>
                            <span>Confirm Password</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            Register
                        </button>
                    </div>
                </form>

                <div class="divider my-4">OR</div>
                <p class="text-center text-sm">
                    Already have an account?
                    <a href="login.php" class="link link-primary">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>