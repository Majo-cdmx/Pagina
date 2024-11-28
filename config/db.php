<?php

function getDbConnection()
{
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);

    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');

    $conn = new mysqli($hostname, $username, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}

// Variables de entorno para Google OAuth
putenv('GOOGLE_CLIENT_ID=811564123107-1q4tj4t9n0o84cm3hg8urc1c9sj9cif8.apps.googleusercontent.com');
putenv('GOOGLE_CLIENT_SECRET=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');
?>