<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de la Consulta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        h2 {
            margin-top: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .back-button {
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
        .delete-button {
            background-color: #dc3545; /* Color rojo para indicar eliminar */
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            margin-right: 5px;
        }

        .delete-button:hover {
            background-color: #c82333; /* Color rojo más oscuro al pasar el mouse */
        }

        .edit-button {
            background-color: #ffc107; /* Color amarillo para indicar editar */
            color: #333; /* Texto más oscuro para mayor contraste */
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }

        .edit-button:hover {
            background-color: #e0a800; /* Color amarillo más oscuro al pasar el mouse */
        }
    </style>
</head>
<body>
    <header>
        <h2>Resultado de la Consulta</h2>
    </header>
    <div class="container">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Actions</th>
            </tr>
            <?php
            // Verifica si se recibieron datos de la consulta
            if (isset($_GET['data'])) {
                // Decodifica los datos JSON y los convierte en un array asociativo
                $resultArray = json_decode($_GET['data'], true);
                // Itera sobre cada elemento en el array de resultados
                foreach ($resultArray as $item) {
                    echo "<tr>";
                    echo "<td>" . $item['id'] . "</td>";
                    echo "<td>" . $item['name'] . "</td>";
                    echo "<td>" . $item['description'] . "</td>";
                    echo "<td>$" . $item['price'] . "</td>";
                    echo "<td>" . $item['category_id'] . "</td>";
                    echo "<td>" . $item['created'] . "</td>";
                    echo "<td>" . $item['modified'] . "</td>";
                    echo "<td>";
                    echo '<a href="Vista/delete.php?id=' . $item['id'] . '" class="delete-button">Eliminar</a>';
                    echo '<a href="modificar.php?id=' . $item['id'] . '" class="edit-button">Editar</a>';
                    echo "</td>";
                    echo "</tr>";
                }
            } elseif (isset($_GET['error'])) {
                // Si se recibió un mensaje de error, imprímelo
                echo '<tr><td colspan="8" class="error">Error: ' . $_GET['error'] . '</td></tr>';
            }
            ?>
        </table>
        <a href="index.php" class="back-button">Volver al Index</a>
    </div>
</body>
</html>
