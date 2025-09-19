<?php require_once __DIR__ . '/../Helpers/helpers.php'; ?>
<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <!-- Favicon (fallback) -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <!-- Standard PNG Favicons -->
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="512x512" href="/android-chrome-512x512.png">
    <!-- Apple Touch Icon (iOS / iPadOS) -->
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <!-- Web App Manifest (PWA support) -->
    <link rel="manifest" href="/site.webmanifest">
    <!-- Optional: Safari pinned tab (monochrome SVG) -->
    <!-- <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5"> -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - Marmazya' : 'Marmazya' ?></title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <nav class="navbar bg-base-100">
        <div class="navbar-start">
            <a href="/" class="btn btn-ghost text-xl flex items-center gap-2">
                <img src="/m.png" alt="Logo" class="w-8 h-8 object-contain">
                Marmazya Blog
            </a>
        </div>
        <div class="navbar-end gap-2">
            <?php if (empty($_SESSION['user'])) : ?>
                <a href="/Views/login.php" class="btn btn-ghost btn-sm">Sign In</a>
                <a href="/Views/register.php" class="btn btn-primary btn-sm">Sign Up</a>
            <?php else : ?>
                <span class="flex items-center gap-2 px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg shadow-sm">
                    <!-- صورة اليوزر -->
                    <img src="<?= $_SESSION['user']['profile_image'] ?? defaultProfileImage($_SESSION['user']['id']) ?>"
                        alt="Profile"
                        class="w-8 h-8 rounded-full object-cover border" />

                    <!-- الاسم -->
                    👋 Welcome,
                    <span class="font-semibold text-primary">
                        <?= htmlspecialchars($_SESSION['user']['name']) ?>
                    </span>
                </span>
                <a href="/Views/edit.php" class="btn btn-ghost btn-sm">Edit Profile</a>
                <a href="/Logic/logout.php" class="btn btn-primary btn-sm">Log Out</a>
            <?php endif; ?>

        </div>

    </nav>

    <main class="flex-1 container mx-auto px-4 py-8">