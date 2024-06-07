<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Elementos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            max-width: 400px;
        }
        li {
            margin-bottom: 10px;
        }
        a {
            display: block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>CRUD de Elementos</h2>

    <ul>
        <li><a href="alta.php">Crear Nuevo Elemento</a></li>
        <li><a href="Vista/read.php">Ver todos los Elementos</a></li>
        <li><a href="consulta.php">Buscar Elementos</a></li>
        <li><a href="Vista/update.php">Actualizar Elemento</a></li>
    </ul>
</body>
</html>
