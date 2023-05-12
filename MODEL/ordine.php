<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Ordine
{
	private Connect $db;
    private PDO $conn;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->connect();
    }

    public function getOrder($id){
        $sql=sprintf("SELECT * 
        FROM ordine o 
        where o.id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getArchiveOrders(){
        $sql=sprintf("SELECT o.id, o.data_ora, o.totale, u.nome as 'nome_user', u.cognome, u.email, u.telefono, o.ritiro
        FROM ordine o
        INNER JOIN utente u ON u.id = o.id_cliente_esterno
        WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
