<?php
class Categoria
{
	private Connect $db;
    private PDO $conn;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->connect();
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
