<?php
// Configuración de los encabezados HTTP para permitir el acceso desde cualquier origen y especificar el tipo de contenido y métodos permitidos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Incluye el archivo Database.php que contiene la clase Database
include_once '../Modelo/Database.php';
// Incluye el archivo Items.php que contiene la clase Items
include_once '../Controlador/Items.php';

// Crea una instancia de la clase Database
$database = new Database();
// Obtiene una conexión a la base de datos llamando al método getConnection() de la clase Database
$db = $database->getConnection();

// Crea una instancia de la clase Items, pasándole la conexión a la base de datos
$items = new Items($db);

// Verifica si se recibió un ID a través del método GET
if (isset($_GET['id'])) {
    // Asigna el valor del ID recibido al objeto Items
    $id = $_GET['id'];

    try {
        // Intenta eliminar el item de la base de datos
        if ($items->delete($id)) {
            // Si la eliminación es exitosa, redirige de nuevo a la página principal con un mensaje de éxito
            header("Location: ../index.php?message=Item was deleted.");
        } else {
            // Si la eliminación falla, redirige de nuevo a la página principal con un mensaje de error
            header("Location: ../index.php?error=Unable to delete item.");
        }
    } catch (PDOException $e) {
        // Si ocurre una excepción, redirige de nuevo a la página principal con un mensaje de error
        header("Location: ../index.php?error=Error occurred: " . $e->getMessage());
    }
} else {
    // Si el campo 'id' está vacío en los datos recibidos, redirige de nuevo a la página principal con un mensaje indicando que los datos son incompletos
    header("Location: ../index.php?error=Unable to delete item. Data is incomplete.");
}
?>
