<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Elemento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insertar Nuevo Elemento</h2>
        <form action="Vista/create.php" method="POST">
            <label for="name">Nombre:</label><br>
            <input type="text" id="name" name="name" required><br>

            <label for="description">Descripción:</label><br>
            <textarea id="description" name="description" rows="4" cols="50" required></textarea><br>

            <label for="price">Precio:</label><br>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br>

            <label for="category_id">ID de Categoría:</label><br>
            <input type="number" id="category_id" name="category_id" required><br>

            <input type="submit" value="Insertar">
        </form>

         <!-- Botón para volver al índice -->
         <form action="index.php">
            <input type="submit" value="Volver al Índice" style="margin-top: 20px;">
        </form>
    </div>
</body>
</html>
