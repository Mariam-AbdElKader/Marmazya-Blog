<?php
$title = 'Login';
require 'header.php';
guestOnly();
$errors = !empty($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = !empty($_SESSION['old']) ? $_SESSION['old'] : [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<div class="hero min-h-[calc(100vh-16rem)]">
    <div class="hero-content flex-col">
        <div class="card w-96 bg-base-100">
            <div class="card-body">
                <h1 class="text-3xl font-bold text-center mb-6">Welcome Back</h1>

                <form method="POST" action="../Logic/login.php">
                    <!-- Email -->
                    <label class="floating-label mb-3">
                        <input type="email"
                               name="email"
                               placeholder="mail@example.com"
                               value="<?= htmlspecialchars($old['email'] ?? '') ?>"
                               class="input input-bordered<?php if (!empty($errors['password'])) echo ' input-error'; ?>"
                               required>
                        <span>Email</span>
                    </label>

                    <!-- Password -->
                    <label class="floating-label mb-3">
                        <input type="password"
                               name="password"
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
                    <!-- Submit Button -->
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary btn-sm w-full">
                            Login
                        </button>
                    </div>
                </form>

                <div class="divider">OR</div>
                <p class="text-center text-sm">
                    Don't have an account?
                    <a href="register.php" class="link link-primary">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>