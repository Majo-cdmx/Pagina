<?php
session_start(); // Iniciar sesión para usar variables de sesión

include 'db.php'; // Incluir el archivo de conexión a la base de datos

// Comprobar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Crear la consulta SQL para verificar las credenciales del usuario
    $query = "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // El usuario existe, configurar las variables de sesión
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirigir al usuario a la página de bienvenida
        header("Location: welcome.php");
        exit();
    } else {
        // Las credenciales no coinciden o el usuario no existe
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="login.php">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php if (!empty($error)) {
        echo "<p>$error</p>";
    } ?>
</body>

</html>