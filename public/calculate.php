<?php
$area = $perimeter = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $shape = $_POST["shape"];
    switch ($shape) {
        case 'circle':
            $radius = $_POST["radius"];
            $area = pi() * $radius * $radius;
            $perimeter = 2 * pi() * $radius;
            break;
        case 'rectangle':
            $width = $_POST["width"];
            $height = $_POST["height"];
            $area = $width * $height;
            $perimeter = 2 * ($width + $height);
            break;
        case 'square':
            $side = $_POST["side"];
            $area = $side * $side;
            $perimeter = 4 * $side;
            break;
        case 'triangle':
            $base = $_POST["base"];
            $height = $_POST["height"];
            $area = 0.5 * $base * $height;
            $perimeter = $base + 2 * sqrt(pow($base / 2, 2) + pow($height, 2)); // Assuming an isosceles triangle
            break;
        case 'ellipse':
            $a = $_POST["a"]; // Semi-major axis
            $b = $_POST["b"]; // Semi-minor axis
            $area = pi() * $a * $b;
            $perimeter = 2 * pi() * sqrt(0.5 * ($a * $a + $b * $b)); // Ramanujan's approximation
            break;
        case 'pentagon':
            $side = $_POST["side"];
            $area = (sqrt(5 * (5 + 2 * sqrt(5))) * $side * $side) / 4;
            $perimeter = 5 * $side;
            break;
        case 'hexagon':
            $side = $_POST["side"];
            $area = ((3 * sqrt(3)) / 2) * $side * $side;
            $perimeter = 6 * $side;
            break;
        case 'trapezoid':
            $base1 = $_POST["base1"];
            $base2 = $_POST["base2"];
            $height = $_POST["height"];
            $area = 0.5 * ($base1 + $base2) * $height;
            $side1 = $_POST["side1"];
            $side2 = $_POST["side2"];
            $perimeter = $base1 + $base2 + $side1 + $side2;
            break;
        case 'parallelogram':
            $base = $_POST["base"];
            $height = $_POST["height"];
            $side = $_POST["side"];
            $area = $base * $height;
            $perimeter = 2 * ($base + $side);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Áreas y Perímetros</title>
    <link rel="stylesheet" href="styles/estilosC.css">
</head>

<body>
    <header>
        <div class="header-content">
            <h1>LGDS</h1>
            <div class="buttons-container">
                <a href="shapes.php" class="btn-back">Regresar a Figuras</a>
                <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
            </div>
        </div>
    </header>

    <main>
        <h1>Calculadora de Áreas y Perímetros</h1>
        <form method="post">
            <label for="shape">Seleccione la forma (dimensiones en cm):</label>
            <select id="shape" name="shape" onchange="updateFields()">
                <option value="circle">Círculo</option>
                <option value="rectangle">Rectángulo</option>
                <option value="square">Cuadrado</option>
                <option value="triangle">Triángulo</option>
                <option value="ellipse">Elipse</option>
                <option value="pentagon">Pentágono</option>
                <option value="hexagon">Hexágono</option>
                <option value="trapezoid">Trapecio</option>
                <option value="parallelogram">Paralelogramo</option>
            </select>
            <br><br>
            <div id="fields"></div>
            <br>
            <button type="submit">Calcular</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <h2>Resultados:</h2>
            <p>Área: <?= number_format($area, 2) ?> cm²</p>
            <p>Perímetro: <?= number_format($perimeter, 2) ?> cm</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>© 2024 LGDS. Todos los derechos reservados.</p>
    </footer>

    <script>
        function updateFields() {
            var shape = document.getElementById("shape").value;
            var fields = document.getElementById("fields");
            fields.innerHTML = '';

            switch (shape) {
                case 'circle':
                    fields.innerHTML += '<label for="radius">Radio (cm):</label><input type="number" id="radius" name="radius" required><br>';
                    break;
                case 'rectangle':
                    fields.innerHTML += '<label for="width">Ancho (cm):</label><input type="number" id="width" name="width" required><br>';
                    fields.innerHTML += '<label for="height">Alto (cm):</label><input type="number" id="height" name="height" required><br>';
                    break;
                case 'square':
                    fields.innerHTML += '<label for="side">Lado (cm):</label><input type="number" id="side" name="side" required><br>';
                    break;
                case 'triangle':
                    fields.innerHTML += '<label for="base">Base (cm):</label><input type="number" id="base" name="base" required><br>';
                    fields.innerHTML += '<label for="height">Altura (cm):</label><input type="number" id="height" name="height" required><br>';
                    break;
                case 'ellipse':
                    fields.innerHTML += '<label for="a">Semi-eje mayor (cm):</label><input type="number" id="a" name="a" required><br>';
                    fields.innerHTML += '<label for="b">Semi-eje menor (cm):</label><input type="number" id="b" name="b" required><br>';
                    break;
                case 'pentagon':
                    fields.innerHTML += '<label for="side">Lado (cm):</label><input type="number" id="side" name="side" required><br>';
                    break;
                case 'hexagon':
                    fields.innerHTML += '<label for="side">Lado (cm):</label><input type="number" id="side" name="side" required><br>';
                    break;
                case 'trapezoid':
                    fields.innerHTML += '<label for="base1">Base mayor (cm):</label><input type="number" id="base1" name="base1" required><br>';
                    fields.innerHTML += '<label for="base2">Base menor (cm):</label><input type="number" id="base2" name="base2" required><br>';
                    fields.innerHTML += '<label for="side1">Lado 1 (cm):</label><input type="number" id="side1" name="side1" required><br>';
                    fields.innerHTML += '<label for="side2">Lado 2 (cm):</label><input type="number" id="side2" name="side2" required><br>';
                    fields.innerHTML += '<label for="height">Altura (cm):</label><input type="number" id="height" name="height" required><br>';
                    break;
                case 'parallelogram':
                    fields.innerHTML += '<label for="base">Base (cm):</label><input type="number" id="base" name="base" required><br>';
                    fields.innerHTML += '<label for="height">Altura (cm):</label><input type="number" id="height" name="height" required><br>';
                    fields.innerHTML += '<label for="side">Lado (cm):</label><input type="number" id="side" name="side" required><br>';
                    break;
            }
        }

        document.addEventListener("DOMContentLoaded", updateFields);
    </script>
</body>

</html>