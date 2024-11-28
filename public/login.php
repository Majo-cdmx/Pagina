<?php
session_start();

// Conectar a la base de datos usando la variable de entorno JAWSDB_URL
$cleardb_url = parse_url(getenv("JAWSDB_URL"));
$host = $cleardb_url["host"];
$user = $cleardb_url["user"];
$pass = $cleardb_url["pass"];
$dbname = substr($cleardb_url["path"], 1);

// Crear una conexión PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        // Consulta para verificar el usuario y la contraseña
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Si el usuario es encontrado, iniciar sesión
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
            exit();
        } else {
            // Si las credenciales no coinciden, mostrar error
            $error = "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        $error = "Por favor, complete ambos campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>

<body>
    <h1>Iniciar Sesión</h1>

    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Iniciar Sesión</button>
        <a href="register.php">¿No tienes cuenta? registrate</a>
    </form>
</body>

</html>