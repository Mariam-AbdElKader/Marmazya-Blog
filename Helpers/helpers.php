<?php
session_start();
require_once 'users.php';
require_once 'posts.php';

if (!function_exists('sanitize')) {
    function sanitize(string $string)
    {
        return htmlspecialchars(strip_tags(trim($string)));
    }
}

if (!function_exists('validate')) {
    function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $key => $rulesArr) {
            foreach ($rulesArr as $rule) {
                #required
                if ($rule === 'required' && empty($data[$key])) {
                    $errors[$key] = ucfirst($key) . ' can not be empty';
                    break;
                }
                #email
                if ($rule === 'email' && !filter_var($data[$key], FILTER_VALIDATE_EMAIL)) {
                    $errors[$key] = 'Invalid Email format';
                    break;
                }
                #number
                if ($rule === 'number' && !is_numeric($data[$key])) {
                    $errors[$key] = ucfirst($key) . ' Is not a valid number';
                    break;
                }
                #password
                if ($rule === 'password') {
                    if (!preg_match('/[A-Za-z]/', $data[$key])) {
                        $errors[$key] = ucfirst($key) . " must contain at least one letter.";
                        break;
                    }
                    if (!preg_match('/[0-9]/', $data[$key])) {
                        $errors[$key] = ucfirst($key) . " must contain at least one number.";
                        break;
                    }
                    if (!preg_match('/[\W_]/', $data[$key])) {
                        $errors[$key] = ucfirst($key) . " must contain at least one special character.";
                        break;
                    }
                }
                #confirmed
                if ($rule === 'confirmed' && $data[$key] !== $data[$key . '_confirmation']) {
                    $errors[$key] = ucfirst($key) . ' and ' . ucfirst($key) . ' Confirmation Must be the same';
                }
                #min
                if (str_starts_with($rule, 'min:')) {
                    $min = (int) substr($rule, 4);
                    if ($min > strlen($data[$key])) {
                        $errors[$key] = ucfirst($key) . " must be at least $min characters.";
                        break;
                    };
                }
                #max
                if (str_starts_with($rule, 'max:')) {
                    $max = (int) substr($rule, 4);
                    if ($max < strlen($data[$key])) {
                        $errors[$key] = ucfirst($key) . " must be at max $max characters.";
                        break;
                    };
                }
            }
        }
        return $errors;
    }
}

if (!function_exists('dd')) {
    function dd(...$args)
    {
        foreach ($args as $arg) {
            echo '<pre>';
            var_dump($arg);
            echo '</pre>';
        }
        die;
    }
}

if (!function_exists('redirect')) {
    function redirect(string $page)
    {
        // نحدد البروتوكول (http أو https)
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";

        // نجيب الدومين من السيرفر
        $host = $_SERVER['HTTP_HOST'];

        // نحدد الفولدر الأساسي
        $basePath = "/Views/";

        // نضيف .php لو مش موجودة
        if (!str_ends_with($page, '.php')) {
            $page .= '.php';
        }

        // نكون الرابط
        $url = $scheme . "://" . $host .  $basePath . $page;

        header("Location: " . $url);
        exit;
    }
}

if (!function_exists('array_last')) {
    function array_last(?array $array): mixed
    {
        return empty($array) ? null : end($array);
    }
}

if (!function_exists('diffForHumans')) {
    function diffForHumans($datetime)
    {
        $now = new DateTime();
        $interval = $now->diff($datetime);
        if ($interval->y > 0) return $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
        if ($interval->m > 0) return $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
        if ($interval->d > 0) return $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
        if ($interval->h > 0) return $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
        if ($interval->i > 0) return $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
        return 'just now';
    }
}
