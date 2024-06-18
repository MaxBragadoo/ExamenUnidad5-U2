<?php
class Usuario
{

    protected $id;
    protected $table;
    protected $db;

    function __construct($id, $table, PDO $conn)
    {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conn;
    }


    function validaUser($data)
    {
        $sql = "SELECT * FROM {$this->table} WHERE " . $data;
        $stm = $this->db->prepare($sql);
        try {
            $stm->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $stm->fetch();
    }

    
    function insert($data){
        $sql = "INSERT INTO {$this->table}(";
        foreach($data as $key=>$value){
            $sql.=" {$key}, "; 
        }
        
        $fin = strrpos("$sql", ",");
        $sql=substr($sql,0,$fin);

        $sql.=") VALUES (";
        foreach($data as $key=>$value){
            $sql.=":{$key}, ";
        }

        $fin = strrpos("$sql", ",");
        $sql=substr($sql,0,$fin);
        $sql.=")";

        $stm = $this->db->prepare($sql);

        $succes = false;

        try{
            $succes = $stm->execute($data);
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
        
        return $succes;
    }
}

