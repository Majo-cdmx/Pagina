<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
</head>

<body>
    <h2>Registro de Usuario</h2>
    <form action="register_user.php" method="POST">
        <input type="text" name="username" placeholder="Nombre de usuario" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>

</html>