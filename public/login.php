<?php
session_start();
$pdo = require ('../config/db.php'); // Asegúrate de ajustar la ruta al archivo db.php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Credenciales válidas
            $_SESSION['user_id'] = $user['id'];
            header('Location: welcome.php');
            exit;
        } else {
            // Credenciales inválidas
            $error = "Usuario o contraseña incorrecta.";
        }
    } catch (PDOException $e) {
        $error = "Error de conexión: " . $e->getMessage();
    }
}

// Mostrar mensaje de error o formulario de login
if (isset($error)) {
    echo $error;
} else {
    echo '<form action="login.php" method="post">
              Usuario: <input type="text" name="username"><br>
              Contraseña: <input type="password" name="password"><br>
              <input type="submit" value="Iniciar sesión">
          </form>';
}