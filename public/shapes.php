<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras Geométricas Inscritas</title>
    <style>
        canvas {
            border: 1px solid black;
        }

        .button {
            padding: 10px 15px;
            margin-top: 10px;
            background-color: #4CAF50;
            /* Green */
            color: white;
            border: none;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

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
    <button class="button" onclick="window.location.href='calculate.php';">Calcular Áreas y Perímetros</button>

    <canvas id="myCanvas" width="500" height="500"></canvas>

    <script>
        // Aquí sigue tu código JavaScript existente para dibujar las figuras...
    </script>

</body>

</html>