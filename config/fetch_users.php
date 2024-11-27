<?php
// Incluir el archivo de conexión a la base de datos
require_once '../config/db.php';

try {
    // Preparar la consulta para obtener todos los usuarios
    $query = "SELECT id, username FROM users";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Obtener los resultados de la consulta
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verificar si se encontraron usuarios
    if (count($users) > 0) {
        // Mostrar los usuarios en una tabla HTML
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre de Usuario</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['id']) . "</td>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron usuarios.";
    }

} catch (PDOException $e) {
    // Mostrar error en caso de que falle la consulta
    echo "Error al obtener los usuarios: " . $e->getMessage();
}
?>