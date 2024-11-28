<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: welcome.php"); // Si ya está logueado, redirigir al dashboard
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form action="login_user.php" method="POST">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <!-- Google Sign-In Button -->
    <br>
    <a href="google_login.php">Iniciar sesión con Google</a>

</body>

</html>