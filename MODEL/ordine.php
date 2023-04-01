<?php
class Ordine
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getOrder($id){
        
    }

    public function getArchiveOrders(){
        $sql=sprintf("SELECT * FROM ordine WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*public function getOrderProduct($id){
        $sql=sprintf("SELECT * 
        FROM ordine
        INNER JOIN product on product.id=order.id
        WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }*/ 

    //NON SO SE E' GIUSTA
}
?>