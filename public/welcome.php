<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirigir a login si no está logueado
    exit;
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Dashboard</title>
</head>

<body>
    <h1>Bienvenido al Dashboard, <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p>Este es el contenido protegido del Dashboard.</p>
    <a href="subscribe.html">Subscribete</a>
    <a href="logout.php">Cerrar Sesión</a>
</body>

</html>