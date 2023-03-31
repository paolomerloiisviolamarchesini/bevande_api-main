<?php
class Categoria
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getCategory($id){
        $sql=sprintf("SELECT * FROM categoria WHERE id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>