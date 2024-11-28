<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si los campos no están vacíos
    if (!empty($username) && !empty($password)) {
        try {
            // Insertar usuario sin encriptar la contraseña
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $password]);

            echo "Registro exitoso";
        } catch (PDOException $e) {
            echo "Error al registrar: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>

<body>
    <h1>Registro de Usuario</h1>
    <form action="register.php" method="post">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
    <a href="login.php">Iniciar Sesión</a>
</body>

</html>