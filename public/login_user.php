<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'example_db'); // Ajusta según tus credenciales

if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

$username = $db->real_escape_string($_POST['username']);
$password = $db->real_escape_string($_POST['password']);

$query = "SELECT id, password FROM users WHERE username = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id']; // Almacena el ID del usuario en la sesión
    header("Location: welcome.php"); // Redirecciona a la página de bienvenida
} else {
    echo "Nombre de usuario o contraseña incorrectos";
}

$stmt->close();
$db->close();
?>