<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");


class Prodotto
{
    private Connect $db;
    private PDO $conn;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->connect();
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
        $sql=sprintf("SELECT p.nome, p.descrizione, p.prezzo, categoria.nome AS 'categoria_nome', quantita, p.Fats, p.Kcal, p.Proteins, p.Sugars, p.active 
        FROM prodotto p
        INNER JOIN categoria ON p.id_categoria = categoria.id
        WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
        public function getProductOrder($id){
        $sql=sprintf("SELECT p.nome, p.id
        FROM prodotto p
        INNER JOIN prodotto_ordine po ON po.id_prodotto = p.id
        INNER JOIN ordine o ON o.id = po.id_ordine
        WHERE o.id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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
