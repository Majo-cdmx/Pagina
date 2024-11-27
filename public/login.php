<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = new PDO('mysql:host=localhost;dbname=simple_login', 'root', ''); // Asegúrate de ajustar estos valores
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['username'], $_POST['password']]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php"); // Redirige al usuario a dashboard.php
        exit;
    } else {
        $login_error = "Nombre de usuario o contraseña incorrectos.";
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
    <?php if (!empty($login_error)): ?>
        <p style="color: red;"><?= $login_error ?></p>
    <?php endif; ?>
    <form action="login.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Iniciar Sesión</button>
    </form>
</body>

</html>