<?php
$title = 'Register';
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
                <h1 class="text-3xl font-bold text-center mb-6">Create Account</h1>

                <form method="POST" action="../Logic/register.php">
                    <!-- Name -->
                    <label class="floating-label mb-3">
                        <input type="text"
                               name="name"
                               placeholder="John Doe"
                               value="<?= htmlspecialchars($old['name'] ?? '') ?>"
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
                               value="<?= htmlspecialchars($old['email'] ?? '') ?>"
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
                               placeholder="••••••••"
                               class="input input-bordered"
                               required>
                        <span>Confirm Password</span>
                    </label>

                    <!-- Submit Button -->
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary btn-sm w-full">
                            Register
                        </button>
                    </div>
                </form>

                <div class="divider">OR</div>
                <p class="text-center text-sm">
                    Already have an account?
                    <a href="login.php" class="link link-primary">Sign in</a>
                </p>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>