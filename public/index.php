<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        header {
            background-color: #333;
            color: white;
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        main {
            margin: 20px;
            padding: 20px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            color: white;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Bienvenido a la Aplicación de Figuras Geométricas y Suscripciones :D</h1>
    </header>

    <main>
        <h2>Elige una opción:</h2>
        <div>
            <a href="shapes.php">Dibujar Figuras Geométricas</a>
            <a href="subscribe.html">Suscribirse con Stripe</a>
        </div>
    </main>
</body>

</html>