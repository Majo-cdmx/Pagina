<?php
// Obtener la variable de entorno con las credenciales de la base de datos
$url = getenv('JAWSDB_URL');

if (!$url) {
    die("La variable de entorno JAWSDB_URL no está definida.");
}

// Parsear la URL para obtener los componentes de la conexión
$components = parse_url($url);

$host = $components['host'];
$username = $components['user'];
$password = $components['pass'];
$database = substr($components['path'], 1); // Quitar el slash inicial

// Opciones de PDO para mejorar el manejo de errores
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    // Crear una nueva instancia de PDO
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password, $options);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

return $pdo;
