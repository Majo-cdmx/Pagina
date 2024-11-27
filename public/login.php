<?php
session_start(); // Inicia sesión para utilizar variables de sesión
require_once '../config/db.php'; // Asegúrate de que la ruta a db.php es correcta

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if (empty($username) || empty($password)) {
        // Gestionar error si alguno de los campos está vacío
        echo "Todos los campos son requeridos.";
    } else {
        // Preparar y ejecutar consulta
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Si la autenticación es correcta, configurar la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirigir a welcome.php
            header("Location: welcome.php");
            exit;
        } else {
            // Gestionar error si la autenticación falla
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>

</html>