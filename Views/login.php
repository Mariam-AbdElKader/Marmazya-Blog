<?php
$title = 'Login';
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
                <h1 class="text-2xl sm:text-3xl font-bold text-center mb-4 sm:mb-6">Welcome Back</h1>

                <form method="POST" action="../Logic/login.php" class="space-y-4">
                    <!-- Email -->
                    <div class="form-control">
                        <label class="floating-label">
                            <input type="email"
                                   name="email"
                                   placeholder="mail@example.com"
                                   value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                                   class="input input-bordered w-full<?php if (!empty($errors['password'])) echo ' input-error'; ?>"
                                   required>
                            <span>Email</span>
                        </label>
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
                    </div>
                    <?php if (!empty($errors['password'])): ?>
                        <div class="label -mt-2">
                            <span class="label-text-alt text-error"><?= $errors['password'] ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Submit Button -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">
                            Login
                        </button>
                    </div>
                </form>

                <div class="divider my-4">OR</div>
                <p class="text-center text-sm">
                    Don't have an account?
                    <a href="register.php" class="link link-primary">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>