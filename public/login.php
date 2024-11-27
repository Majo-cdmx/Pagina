<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=simple_login', 'root', ''); // Ajusta los valores según tu configuración
$login_success = false;
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        $login_success = true;
    } else {
        $login_error = 'Nombre de usuario o contraseña incorrectos.';
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
    <h2>Iniciar Sesión</h2>
    <?php if ($login_error): ?>
        <p style="color: red;"><?= $login_error ?></p>
    <?php endif; ?>
    <?php if ($login_success): ?>
        <p>Inicio de sesión exitoso. Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <p><a href="dashboard.php">Ir al Dashboard</a></p>
    <?php else: ?>
        <form action="login.php" method="post">
            <label for="username">Nombre de usuario:</label>
            <input type="text" name="username" id="username" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required><br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php endif; ?>
</body>

</html>