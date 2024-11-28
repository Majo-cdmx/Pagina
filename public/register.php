<?php
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Obtener la conexión a la base de datos
    $pdo = getDbConnection(); // Asegúrate de que la variable esté definida correctamente

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="styles/estilosR.css">
</head>

<body>
    <header>
        <h1>LGDS</h1>
    </header>

    <main>
        <div class="register-container">
            <h2>Registro de Usuario</h2>
            <form action="register.php" method="post">
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username" required>
                <br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Registrar</button>
            </form>
            <br>
            <a href="login.php" class="login-link">Iniciar Sesión</a>
            <br><br>
            <!-- Enlace para regresar al inicio -->
            <a href="index.php" class="back-link">Regresar al Inicio</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 LGDS. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
