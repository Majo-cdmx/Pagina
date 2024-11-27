<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirigir a login si no está logueado
    exit;
}

// Contenido del dashboard
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h1>Bienvenido al Dashboard, <?= htmlspecialchars($_SESSION['username']) ?></h1>
    <p>Este es el contenido protegido del Dashboard.</p>
    <a href="index.php">Cerrar Sesión</a>
</body>

</html>