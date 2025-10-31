<?php require_once __DIR__ . '/../Helpers/helpers.php' ?>
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
            <!-- Mobile menu button -->
            <div class="lg:hidden">
            <button class="btn btn-ghost btn-sm" onclick="document.getElementById('mobileMenu').classList.toggle('hidden')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            </div>
            <!-- Desktop menu -->
            <div class="hidden lg:flex gap-2 items-center">
            <?php if (!currentUser()) : ?>
                <a href="/Views/login.php" class="btn btn-ghost btn-sm">Sign In</a>
                <a href="/Views/register.php" class="btn btn-primary btn-sm">Sign Up</a>
            <?php else : ?>
                <span class="flex items-center gap-2 px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg shadow-sm">
                <img src="<?= currentUser()['profile_image'] ?? defaultProfileImage(currentUser()['id']) ?>"
                    alt="Profile"
                    class="w-8 h-8 rounded-full object-cover border" />
                👋 Welcome,
                <span class="font-semibold text-primary">
                    <?= htmlspecialchars(currentUser()['name']) ?>
                </span>
                </span>
                <a href="/Views/edit.php" class="btn btn-ghost btn-sm">Edit Profile</a>
                <a href="/Logic/logout.php" class="btn btn-primary btn-sm">Log Out</a>
            <?php endif; ?>
            </div>
            <!-- Mobile dropdown menu -->
            <div id="mobileMenu" class="absolute right-4 top-16 z-50 bg-base-100 rounded-lg shadow-lg p-4 flex flex-col gap-2 w-56 lg:hidden hidden">
            <?php if (!currentUser()) : ?>
                <a href="/Views/login.php" class="btn btn-ghost btn-sm w-full">Sign In</a>
                <a href="/Views/register.php" class="btn btn-primary btn-sm w-full">Sign Up</a>
            <?php else : ?>
                <span class="flex items-center gap-2 px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg shadow-sm">
                    <img src="<?= currentUser()['profile_image'] ?? defaultProfileImage(currentUser()['id']) ?>"
                        alt="Profile"
                        class="w-8 h-8 rounded-full object-cover border" />
                    <span class="font-semibold text-primary">
                        <?= htmlspecialchars(currentUser()['name']) ?>
                    </span>
                </span>
                <a href="/Views/edit.php" class="btn btn-ghost btn-sm w-full">Edit Profile</a>
                <a href="/Logic/logout.php" class="btn btn-primary btn-sm w-full">Log Out</a>
            <?php endif; ?>
            </div>
        </div>
        <script>
            // Optional: Close mobile menu when clicking outside
            document.addEventListener('click', function(e) {
                const menu = document.getElementById('mobileMenu');
                const button = document.querySelector('.lg\\:hidden button');
                if (!menu.classList.contains('hidden') && !menu.contains(e.target) && !button.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        </script>

    </nav>

    <main class="flex-1 container mx-auto px-4 py-8">