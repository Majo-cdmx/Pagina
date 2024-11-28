<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Dashboard</title>
    <link rel="stylesheet" href="styles/welcome.css">
</head>

<body>
    <header>
        <div class="header-content">
            <h1>LGDS</h1>
            <div class="buttons-container">
                <a href="shapes.php" class="btn-animacion">Figuras Animación</a>
                <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <main>
        <h1>Bienvenido al Dashboard, <?= htmlspecialchars($_SESSION['username']) ?></h1>
        <p>Este es el contenido protegido del Dashboard.</p>
        <div class="subscribe-container">
            <a href="subscribe.html" class="btn-subscribe">Suscríbete</a>
        </div>
    </main>

    <footer>
        <p>© 2024 LGDS. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
