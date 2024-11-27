<?php
// Obtener la URL de conexión de la variable de entorno
$dburl = getenv("JAWSDB_URL");

// Descomponer la URL en sus componentes
$url = parse_url($dburl);

$server = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$db = substr($url["path"], 1);

// Crear la conexión a la base de datos
$conn = new mysqli($server, $username, $password, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa!";
?>
