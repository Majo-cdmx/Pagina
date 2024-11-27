<?php
include ('../config/db.php'); // Incluir el archivo de conexión a la base de datos

$query = "SELECT * FROM users"; // Consulta SQL para obtener todos los usuarios
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Mostrar los datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"] . " - Nombre: " . $row["username"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 resultados";
}

$conn->close(); // Cerrar la conexión a la base de datos
?>