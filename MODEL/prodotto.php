<?php
class Prodotto
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function addProduct($nome,$descrizione,$prezzo,$id_categoria,$quantita,$active)
    {
        $sql = sprintf("INSERT INTO prodotto (nome, descrizione, prezzo, id_categoria, quantita, active)
        VALUES (:nome,:descrizione,:prezzo,:id_categoria,:quantita,:active)");
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindValue(':descrizione', $descrizione, PDO::PARAM_STR);
    $stmt->bindValue(':prezzo', $prezzo, PDO::PARAM_STR);
    $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
    $stmt->bindValue(':quantita', $quantita, PDO::PARAM_INT);
    $stmt->bindValue(':active', $active, PDO::PARAM_BOOL);
    if ($stmt->execute())
    {
    return $stmt->rowCount();
    }
 else return "problemi";
    }

    public function getArchiveProducts(){
        $sql=sprintf("SELECT * FROM prodotto WHERE 1=1
        INNER JOIN categoria ON prodotto.id_categoria = categoria.id");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProduct($id){
        $sql=sprintf("SELECT * FROM prodotto WHERE id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function modifyProduct($id, $nome, $descrizione, $prezzo, $id_categoria,$quantita, $active)
    {
        $sql = sprintf("UPDATE prodotto
                SET nome =:nome, descrizione=:descrizione, prezzo=:prezzo, id_categoria=:id_categoria, active=:active, quantita=:quantita
                WHERE id = :id");

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':descrizione', $descrizione, PDO::PARAM_STR);
        $stmt->bindValue(':prezzo', $prezzo, PDO::PARAM_STR);
        $stmt->bindValue(':quantita', $quantita, PDO::PARAM_INT);
        $stmt->bindValue(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindValue(':active', $active, PDO::PARAM_BOOL);

        if ($stmt->execute())
        {
        return $stmt->rowCount();
        }
     else return "problemi";
        }

    public function removeProduct($id){
        $sql=sprintf("UPDATE prodotto SET active=0 WHERE id=:id");
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute())
        {
        return 1;
        }
     else return "problemi";
    }
}
?>
