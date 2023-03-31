<?php
class Valori_Nutrizionali
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getArchiveNutritionalValues()
    {
        $sql=sprintf("SELECT * FROM valori_nutrizionali WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNutritionalValue($id)
    {
        $sql=sprintf("SELECT * FROM valori_nutrizionali WHERE id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setNutritionalValue($id)
    {

    }
}
?>
