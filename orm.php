<?php 
class Orm {
    protected $id;
    protected $table;
    protected $db;
    protected $conn;


    public function __construct($conn, $table) {
      if ($conn === null) {
          throw new Exception("Database connection is not established.");
      }
      $this->conn = $conn;
      $this->table = $table;
  }

    function getAll()
  {
    $sql = "SELECT * FROM {$this->table}";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetchAll();
  }

  function count()
  {

    return count($this->getAll());
  }

  function lastID()
  {
    $sql = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT 1";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetch();
  }


  public function deleteById($id) {
    if ($this->conn === null) {
        throw new Exception("Database connection is not established.");
    }

    $sql = "DELETE FROM {$this->table} WHERE ID_Cliente = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

public function updateById($id, $data) {
  $set = [];
  foreach ($data as $column => $value) {
      $set[] = "$column = :$column";
  }
  $setString = implode(', ', $set);
  $sql = "UPDATE {$this->table} SET $setString WHERE ID_Cliente = :id";
  $stmt = $this->conn->prepare($sql);
  $data['id'] = $id;
  return $stmt->execute($data);
}

public function getById($id) {
  $sql = "SELECT * FROM {$this->table} WHERE ID_Cliente = :id";
  $stmt = $this->conn->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  return $stmt->fetch(PDO::FETCH_ASSOC);
}


  function insert($data)
  {
    $sql = "INSERT INTO {$this->table} (";
    foreach ($data as $key => $value) {
      $sql .= " {$key}, ";
    }
    $fin = strrpos("$sql", ",");
    $sql = substr($sql, 0, $fin);
    $sql .= ") VALUES (";
    foreach ($data as $key => $value) {
      $sql .= ":{$key}, ";
    }
    $fin = strrpos("$sql", ",");
    $sql = substr($sql, 0, $fin);
    $sql .= ")";
  
    
    $stm = $this->db->prepare($sql);

    $succes = false;
    try {
      $succes = $stm->execute($data);
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
    return $succes;
  }

}
?>