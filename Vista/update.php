<?php
// Configuración de los encabezados HTTP para permitir el acceso desde cualquier origen y especificar el tipo de contenido y métodos permitidos
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
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

// Obtiene el cuerpo de la solicitud HTTP y lo decodifica desde JSON a un objeto PHP
$data = json_decode(file_get_contents("php://input"));

// Verifica que los campos necesarios no estén vacíos en los datos recibidos
if (!empty($data->id) && !empty($data->name) && 
    !empty($data->description) && !empty($data->price) && 
    !empty($data->category_id)) { 

    // Asigna los datos recibidos a las propiedades del objeto Items
    $items->id = $data->id; 
    $items->name = $data->name;
    $items->description = $data->description;
    $items->price = $data->price;
    $items->category_id = $data->category_id; 
    $items->created = new DateTime(); 

    // Intenta actualizar el elemento en la base de datos
    if ($items->update($items->id, $items->name, $items->description, $items->price, $items->category_id, $items->created)) { 
        // Si la actualización es exitosa, envía una respuesta con el código 200 (OK) y un mensaje de éxito
        http_response_code(200); 
        echo json_encode(array("message" => "Item was updated."));
    } else { 
        // Si la actualización falla, envía una respuesta con el código 503 (Servicio no disponible) y un mensaje de error
        http_response_code(503); 
        echo json_encode(array("message" => "Unable to update items."));
    }

} else {
    // Si los datos están incompletos, envía una respuesta con el código 400 (Solicitud incorrecta) y un mensaje indicando que los datos son incompletos
    http_response_code(400); 
    echo json_encode(array("message" => "Unable to update items. Data is incomplete."));
}
?>
