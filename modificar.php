<?php
// Verifica si se recibió un ID a través de la URL
if (isset($_GET['id'])) {
    // Incluye el archivo Database.php que contiene la clase Database
    include_once 'Modelo/Database.php';
    // Incluye el archivo Items.php que contiene la clase Items
    include_once 'Controlador/Items.php';

    // Crea una instancia de la clase Database
    $database = new Database();
    // Obtiene una conexión a la base de datos llamando al método getConnection() de la clase Database
    $db = $database->getConnection();

    // Crea una instancia de la clase Items, pasándole la conexión a la base de datos
    $items = new Items($db);

    // Asigna el ID recibido al objeto Items
    $items->id = $_GET['id'];

    // Llama al método readOne() para obtener los datos del elemento
    $items->read();

    // Verifica si el elemento existe
    if ($items->id != null) {
        // El elemento existe, muestra el formulario con los datos actuales
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar Elemento</title>
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
                    background-color: #ffc107;
                    color: #333;
                    padding: 10px 0;
                    text-align: center;
                    border-radius: 5px 5px 0 0;
                }

                h2 {
                    margin-top: 0;
                }

                form {
                    display: flex;
                    flex-direction: column;
                }

                label {
                    margin-top: 10px;
                }

                input[type="text"], input[type="number"], textarea {
                    padding: 8px;
                    margin-top: 5px;
                    border: 1px solid #ddd;
                    border-radius: 3px;
                }

                button {
                    margin-top: 20px;
                    background-color: #ffc107;
                    color: #333;
                    border: none;
                    padding: 10px;
                    border-radius: 5px;
                    cursor: pointer;
                }

                button:hover {
                    background-color: #e0a800;
                }

                .back-button {
                    margin-top: 20px;
                    background-color: #007bff;
                    color: #fff;
                    border: none;
                    padding: 10px 20px;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                }

                .back-button:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>
        <body>
            <header>
                <h2>Actualizar Elemento</h2>
            </header>
            <div class="container">
                <form action="update_item.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $items->id; ?>">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" value="<?php echo $items->name; ?>" required>
                    <label for="description">Descripción:</label>
                    <textarea name="description" required><?php echo $items->description; ?></textarea>
                    <label for="price">Precio:</label>
                    <input type="number" step="0.01" name="price" value="<?php echo $items->price; ?>" required>
                    <label for="category_id">ID de Categoría:</label>
                    <input type="number" name="category_id" value="<?php echo $items->category_id; ?>" required>
                    <button type="submit">Actualizar</button>
                </form>
                <a href="../index.php" class="back-button">Volver al Index</a>
            </div>
        </body>
        </html>

        <?php
    } else {
        // El elemento no existe, muestra un mensaje de error
        echo '<p>Elemento no encontrado.</p>';
    }
} else {
    // No se recibió un ID, redirige al índice
    header("Location: ../index.php");
    exit();
}
?>
