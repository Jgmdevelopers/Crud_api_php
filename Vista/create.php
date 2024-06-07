<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Verifica si se han recibido todos los campos necesarios
    if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['category_id'])) {

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
        // Obtiene una conexión a la base de datos
        $db = $database->getConnection();

        // Crea una instancia de la clase Items, pasándole la conexión a la base de datos
        $items = new Items($db);

        // Obtiene los datos enviados desde el formulario y los asigna a variables
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category_id = $_POST['category_id'];
        // Crear un objeto DateTime a partir de la cadena de fecha y hora
        $created = new DateTime(date('Y-m-d H:i:s'));

        // Intenta insertar el nuevo elemento en la base de datos
        if ($items->create($name, $description, $price, $category_id, $created)) {
            // Si la inserción es exitosa, redirige al usuario a alguna página de éxito
            header("Location: index.php");
            exit(); // Asegura que no se ejecute más código después de la redirección
        } else { 
            // Si la inserción falla, muestra un mensaje de error
            echo json_encode(array("message" => "inserción fallida!"));

        }

    } else {
        // Si algún campo necesario está vacío, muestra un mensaje de error
        echo "Todos los campos son requeridos.";
    }


}
