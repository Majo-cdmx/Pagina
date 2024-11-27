<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = new PDO('mysql:host=localhost;dbname=simple_login', 'root', ''); // Asegúrate de ajustar estos valores
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['username'], $_POST['password']]);
    echo "Usuario registrado con éxito.";
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>
    <h2>Registro</h2>
    <form action="register.php" method="post">
        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>

</html>