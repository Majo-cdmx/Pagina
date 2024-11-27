<?php
// Iniciar sesión
session_start();

// Incluir el archivo de conexión a la base de datos
require_once '../config/db.php';

// Verificar si se envió el formulario de registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Verificar si los campos están vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, complete todos los campos.";
    } else {
        try {
            // Verificar si el nombre de usuario ya existe
            $query = "SELECT id FROM users WHERE username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "El nombre de usuario ya está registrado. Elija otro.";
            } else {
                // Insertar el nuevo usuario en la base de datos
                $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash de la contraseña para mayor seguridad
                $insertQuery = "INSERT INTO users (username, password) VALUES (:username, :password)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->bindParam(':username', $username);
                $insertStmt->bindParam(':password', $hashed_password);

                if ($insertStmt->execute()) {
                    echo "Registro exitoso. Ahora puede iniciar sesión.";
                } else {
                    echo "Hubo un error al registrar al usuario. Por favor, inténtelo de nuevo.";
                }
            }
        } catch (PDOException $e) {
            // Mostrar error en caso de que falle la consulta
            echo "Error al registrar al usuario: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
</head>

<body>
    <h1>Registro de Usuario</h1>
    <form method="POST" action="">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesión</a></p>
</body>

</html>