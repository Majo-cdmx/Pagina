<?php
session_start(); // Asegúrate de llamar a session_start() al principio

require ('../config/db.php'); // Asegúrate de incluir tu conexión a la base de datos

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Consulta para verificar las credenciales del usuario
    $query = "SELECT id, username FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['username']; // Establece una sesión para el usuario

        // Redirecciona a welcome.php si las credenciales son correctas
        header("Location: welcome.php");
        exit;
    } else {
        $error = "Las credenciales proporcionadas son incorrectas.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Iniciar Sesión</title>
</head>

<body>
    <h2>Iniciar Sesión</h2>
    <form action="login.php" method="POST">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <?php if (!empty($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
</body>

</html>