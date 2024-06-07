<?php

// Incluye el archivo Database.php que contiene la clase Database
include_once '../Modelo/Database.php';

// Incluye el archivo Items.php que contiene la clase Items
include_once '../Controlador/Items.php';

// Crea una instancia de la clase Database
$database = new Database();

// Obtiene una conexión a la base de datos
$db = $database->getConnection();

// Crea una instancia de la clase Items, pasándole la conexión a la base de datos
$items = new Items($db);

// Obtiene el parámetro 'id' de la URL, si existe; de lo contrario, lo establece como null
$id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : null;

// Llama al método read de la clase Items, pasando el id
$resultArray = $items->read($id);

// Verifica si el resultado contiene al menos una fila
if (count($resultArray) > 0) {
    // Si hay resultados, redirige a la vista resultado.php y pasa los resultados como datos
    header('Location: ../consulta_resultado.php?data=' . urlencode(json_encode($resultArray)));
} else {
    // Si no se encontraron elementos, redirige a la vista resultado.php con un mensaje de error
    header('Location: resultado.php?error=' . urlencode("No item found."));
}

?>
