<?php
class Prodotto
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function addProduct($nome,$descrizione,$prezzo,$categoria,$quantita,$active)
    {
        $sql = "INSERT INTO product (nome, descrizione, prezzo, categoria, quantita, active)
        VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssdiii', $nome, $descrizione, $prezzo, $categoria,$quantita,$active);

    if ($stmt->execute())
    return $stmt;
    else return "";
    }

    public function getArchiveProducts(){
        $sql=sprintf("SELECT * FROM prodotto WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getProduct($id){
        $sql=sprintf("SELECT * FROM prodotto WHERE id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function modifyProduct($id, $nome, $descrizione, $prezzo, $id_categoria)
    {
        $sql = sprintf("UPDATE prodotto
                SET nome =:nome, descrizione=:descrizione, prezzo=:prezzo, id_categoria=:id_categoria
                WHERE id = :id");

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':descrizione', $descrizione, PDO::PARAM_STR);
        $stmt->bindValue(':prezzo', $prezzo, PDO::PARAM_STR);
        $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);

        if ($stmt->execute())
        {
            return $stmt;
        }
        else
        {
            return "";
        }
    }

    public function removeProduct($id){
        $sql=sprintf("UPDATE prodotto SET active=0 WHERE id=:id");
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute())
        return $stmt;
        else return "";
    }
}
?>
