<?php

if (!function_exists('dbConnect')) {
    function dbConnect()
    {
        static $conn = null; 

        if ($conn === null) {
            $host = 'localhost';
            $db   = 'blog';
            $user = 'root';
            $pass = '';

            $conn = new mysqli($host, $user, $pass, $db);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }

        return $conn;
    }
}


if (!function_exists('exists')) {
    function exists(string $table, string $column, string $value)
    {
        $conn = dbConnect();
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM $table WHERE $column = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['count'] > 0;
    }
}
