<?php
require_once __DIR__ . '/../Helpers/helpers.php';
authOnly();
session_regenerate_id(true);
session_destroy();
redirect('home');
