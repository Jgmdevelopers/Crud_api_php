<?php

class Items {
  // Conexión a la base de datos
  public $conn;
  // Nombre de la tabla de items, por defecto 'items'
  public $itemsTable = 'items';
  // Propiedades del objeto
  public $id;
  public $name;
  public $description;
  public $price;
  public $category_id;
  public $created;
  public $modified;

  // Constructor que recibe la conexión a la base de datos
  public function __construct($conn) {
    $this->conn = $conn;
  }

  // Método para crear un nuevo item
  public function create(string $name, string $description, float $price, int $category_id, DateTime $created): bool {
    
    // Prepara la sentencia SQL para insertar un nuevo registro en la tabla items
    $stmt = $this->conn->prepare("
      INSERT INTO {$this->itemsTable} (`name`, `description`, `price`, `category_id`, `created`)
      VALUES (?, ?, ?, ?, ?)
    ");

    // Asigna los parámetros a la sentencia preparada
    $createdDate = $created->format('Y-m-d H:i:s');
    $stmt->bind_param('sssds', $name, $description, $price, $category_id, $createdDate);

    // Ejecuta la sentencia y devuelve true si tuvo éxito, o lanza una excepción si hubo un error
    if ($stmt->execute()) {
      return true;
    } else {
      // Maneja errores lanzando una excepción con el error de la sentencia
      throw new PDOException($stmt->error);
    }
  }

  // Método para leer items de la base de datos
  public function read(int $id = null): array {
    // Prepara la sentencia SQL para seleccionar todos los registros o uno específico de la tabla items
    $stmt = $this->conn->prepare($id ? "SELECT * FROM {$this->itemsTable} WHERE id = ?" : "SELECT * FROM {$this->itemsTable}");

    // Si se proporciona un ID, asigna el parámetro a la sentencia preparada
    if ($id) {
      $stmt->bind_param('i', $id);
    }

    // Ejecuta la sentencia y obtiene el resultado
    $stmt->execute();
    $result = $stmt->get_result();

    // Inicializa un array para almacenar los elementos
    $items = array();
    // Itera sobre cada fila del resultado y la agrega al array de elementos
    while ($row = $result->fetch_assoc()) {
      $items[] = $row;
    }
    
    // Convierte el array de elementos a formato JSON
    $json = json_encode($items);

    // Devuelve el array de elementos
    return $items;
  }

  // Método para actualizar un item existente
  public function update(int $id, string $name, string $description, float $price, int $category_id, DateTime $created): bool {
    // Prepara la sentencia SQL para actualizar un registro en la tabla items
    $stmt = $this->conn->prepare("
      UPDATE {$this->itemsTable}
      SET name = ?, description = ?, price = ?, category_id = ?, created = ?
      WHERE id = ?
    ");

    // Asigna los parámetros a la sentencia preparada
    $stmt->bind_param('sssisi', $name, $description, $price, $category_id, $created->format('Y-m-d H:i:s'), $id);

    // Ejecuta la sentencia y devuelve true si tuvo éxito, o lanza una excepción si hubo un error
    if ($stmt->execute()) {
      return true;
    } else {
      // Maneja errores lanzando una excepción con el error de la sentencia
      throw new PDOException($stmt->error);
    }
  }

  // Método para eliminar un item de la base de datos
  public function delete(int $id): bool {
    // Prepara la sentencia SQL para eliminar un registro de la tabla items
    $stmt = $this->conn->prepare("
      DELETE FROM {$this->itemsTable}
      WHERE id = ?
    ");

    // Asigna el parámetro ID a la sentencia preparada
    $stmt->bind_param('i', $id);

    // Ejecuta la sentencia y devuelve true si tuvo éxito, o lanza una excepción si hubo un error
    if ($stmt->execute()) {
      return true;
    } else {
      // Maneja errores lanzando una excepción con el error de la sentencia
      throw new PDOException($stmt->error);
    }
  }
}

?>
