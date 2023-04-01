<?php
class Ordine
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;

    }

    public function getOrder($id){
        $sql=sprintf("SELECT * FROM ordine o where o.id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArchiveOrders(){
        $sql=sprintf("SELECT * FROM ordine WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderProducts($id){
        $sql=sprintf("SELECT p.id, p.nome
        FROM prodotto p
        INNER JOIN prodotti_ordine po on po.id_prodotto = p.id
        INNER JOIN ordine o on o.id=po.id_ordine
        WHERE o.id=:id");

        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>