<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras Geométricas Inscritas</title>
    <link rel="stylesheet" href="styles/shapes.css">
</head>

<body>
    <header>
        <div class="header-content">
            <h1>LGDS</h1>
            <div class="buttons-container">
                <a href="calculate.php" class="btn-calculate">Calcular Áreas y Perímetros</a>
                <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <main>
        <h2>Seleccione el número de vértices de la figura:</h2>
        <form method="GET" action="">
            <label for="sides">Número de vértices:</label>
            <select id="sides" name="sides">
                <?php
                for ($i = 3; $i <= 10; $i++) {
                    $selected = (isset($_GET['sides']) && $_GET['sides'] == $i) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Dibujar Figura">
        </form>

        <canvas id="myCanvas" width="500" height="500"></canvas>

        <script>
            // Aquí sigue tu código JavaScript existente para dibujar las figuras...
        </script>
    </main>

    <footer>
        <p>© 2024 LGDS. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
