<?php
// Declaración de la clase Database
class Database{

    // Propiedades para almacenar la información de conexión a la base de datos
    private $host = 'localhost';
    private $user = 'root';
    private $password = "";
    private $database = "db_crud_java_swing"; 

    // Método para obtener una conexión a la base de datos
    public function getConnection(){ 
        // Crea una nueva instancia de la clase mysqli para establecer la conexión
        $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        
        // Verifica si la conexión fue exitosa
        if($conn->connect_error){
            // Si la conexión falla, muestra un mensaje de error y termina la ejecución del script
            echo "Connection fallida!"; 
            die("Error failed to connect to MySQL: " . $conn->connect_error);
        } else {
            // Si la conexión es exitosa, retorna el objeto de conexión
            return $conn;
        }
    }
}
?>
