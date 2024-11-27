<?php
// Conectar a la base de datos usando la variable de entorno JAWSDB_URL
$cleardb_url = parse_url(getenv("JAWSDB_URL"));
$host = $cleardb_url["host"];
$user = $cleardb_url["user"];
$pass = $cleardb_url["pass"];
$dbname = substr($cleardb_url["path"], 1);

// Crear una conexión PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>