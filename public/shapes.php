<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Figuras Geométricas Inscritas</title>
    <link rel="stylesheet" href="styles/estiloSH.css">
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
        <form id="shape-form">
            <div class="input-group">
                <label for="sides">Número de vértices:</label>
                <select id="sides" name="sides">
                    <?php
                    for ($i = 3; $i <= 10; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
                <button type="button" id="draw-button" class="btn-draw">Dibujar Figura</button>
            </div>
        </form>
        <canvas id="myCanvas" width="500" height="500"></canvas>
    </main>

    <footer>
        <p>© 2024 LGDS. Todos los derechos reservados.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const canvas = document.getElementById('myCanvas');
            const ctx = canvas.getContext('2d');
            const centerX = canvas.width / 2;
            const centerY = canvas.height / 2;
            const radius = 150;

            document.getElementById('draw-button').addEventListener('click', function () {
                const sides = parseInt(document.getElementById('sides').value);
                animateCircle(sides);
            });

            // Función para animar el círculo
            function animateCircle(sides) {
                let currentAngle = 0;
                ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas antes de iniciar

                function drawCircleSegment() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpieza entre frames
                    ctx.beginPath();
                    ctx.arc(centerX, centerY, radius, 0, currentAngle); // Dibuja el contorno hasta el ángulo actual
                    ctx.stroke();
                    currentAngle += 0.05; // Incrementa el ángulo para avanzar el trazo del círculo

                    if (currentAngle <= 2 * Math.PI) {
                        requestAnimationFrame(drawCircleSegment); // Continua hasta completar el círculo
                    } else {
                        setTimeout(() => animatePolygonLineByLine(sides), 1000); // Pausa antes de dibujar el polígono
                    }
                }
                drawCircleSegment(); // Inicia la animación del círculo
            }

            // Función para animar el polígono línea por línea
            function animatePolygonLineByLine(sides) {
                let currentSide = 0;
                const angleStep = (2 * Math.PI) / sides;

                // Calcula las posiciones de los vértices del polígono
                const vertices = [];
                for (let i = 0; i < sides; i++) {
                    const angle = i * angleStep;
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerY + radius * Math.sin(angle);
                    vertices.push({ x, y });
                }
                vertices.push(vertices[0]); // Cierra el polígono volviendo al primer vértice

                function drawNextLine() {
                    if (currentSide < sides) {
                        ctx.beginPath();
                        ctx.moveTo(vertices[currentSide].x, vertices[currentSide].y);
                        ctx.lineTo(vertices[currentSide + 1].x, vertices[currentSide + 1].y);
                        ctx.stroke();
                        currentSide++;
                        setTimeout(drawNextLine, 200); // Traza la siguiente línea tras un retraso
                    } else {
                        setTimeout(() => animateInscribedPolygonLineByLine(sides), 1000);
                    }
                }

                drawNextLine(); // Inicia la animación de trazado del polígono línea por línea
            }

            // Función para animar el polígono inscrito línea por línea
            function animateInscribedPolygonLineByLine(sides) {
                ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas antes de dibujar la figura completa

                // Dibuja el círculo completo una sola vez
                ctx.beginPath();
                ctx.arc(centerX, centerY, radius, 0, 2 * Math.PI);
                ctx.stroke();

                let currentSide = 0;
                const angleStep = (2 * Math.PI) / sides;

                // Calcula las posiciones de los vértices del polígono inscrito
                const vertices = [];
                for (let i = 0; i < sides; i++) {
                    const angle = i * angleStep;
                    const x = centerX + radius * Math.cos(angle);
                    const y = centerY + radius * Math.sin(angle);
                    vertices.push({ x, y });
                }
                vertices.push(vertices[0]); // Cierra el polígono volviendo al primer vértice

                function drawNextInscribedLine() {
                    if (currentSide < sides) {
                        ctx.beginPath();
                        for (let i = 0; i <= currentSide; i++) {
                            ctx.moveTo(vertices[i].x, vertices[i].y);
                            ctx.lineTo(vertices[i + 1].x, vertices[i + 1].y);
                        }
                        ctx.stroke();
                        currentSide++;
                        setTimeout(drawNextInscribedLine, 200); // Traza la siguiente línea tras un retraso
                    }
                }

                drawNextInscribedLine(); // Inicia la animación del polígono inscrito línea por línea
            }
        });
    </script>

</body>

</html>
