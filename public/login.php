<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Habilitar errores para depurar
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario ya está autenticado
if (isset($_SESSION['username'])) {
    header("Location: welcome.php"); // Redirigir a `welcome.php` si ya está logueado
    exit;
}

// Manejar el formulario cuando se envíe por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Obtener la conexión a la base de datos
    $pdo = getDbConnection();

    // Verificar si los campos no están vacíos
    if (!empty($username) && !empty($password)) {
        try {
            // Buscar al usuario en la base de datos
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Si el usuario existe, establecer la sesión y redirigir a `welcome.php`
                $_SESSION['username'] = $username;
                header("Location: welcome.php");
                exit();
            } else {
                // Si el usuario no existe, mostrar mensaje de error
                $error_message = "Nombre de usuario o contraseña incorrectos.";
            }
        } catch (PDOException $e) {
            $error_message = "Error al intentar iniciar sesión: " . $e->getMessage();
        }
    } else {
        $error_message = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/styles/login.css">
</head>

<body>
    <header>
        <h1>LGDS</h1>
    </header>

    <main>
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <?php
            // Mostrar mensaje de error si existe
            if (isset($error_message)) {
                echo "<p style='color:red;'>" . htmlspecialchars($error_message) . "</p>";
            }
            ?>
            <form action="login.php" method="POST">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
                <br><br>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <br>
            <a href="register.php" class="register-link">Registrarse</a>
            <br><br>
            <!-- Agregar enlace para regresar al inicio -->
            <a href="index.php" class="back-link">Regresar al Inicio</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 LGDS. Todos los derechos reservados.</p>
    </footer>
</body>

</html>