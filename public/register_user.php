<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'example_db'); // Ajusta según tus credenciales

if ($db->connect_error) {
    die("Conexión fallida: " . $db->connect_error);
}

$username = $db->real_escape_string($_POST['username']);
$email = $db->real_escape_string($_POST['email']);
$password = $db->real_escape_string($_POST['password']);
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Primero, verificar si el nombre de usuario ya existe
$checkUser = $db->prepare("SELECT username FROM users WHERE username = ?");
$checkUser->bind_param("s", $username);
$checkUser->execute();
$checkUser->store_result();

if ($checkUser->num_rows > 0) {
    echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
} else {
    // Si no existe, proceder con la inserción
    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: welcome.php"); // Redirecciona a la página de bienvenida tras registro exitoso
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}

$checkUser->close();
$db->close();
?>