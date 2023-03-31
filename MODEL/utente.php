<?php
class Utente
{
    protected $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function createUser($nome,$cognome,$email,$password,$telefono,$data_nascita){
        $sql = "INSERT INTO utente (nome, cognome, email, password, telefono, data_nascita, active);
        SELECT ?, ?, ?, ?, ?, ?, 1 WHERE NOT EXISTS (SELECT * FROM user WHERE email='" . $this->conn->real_escape_string($email) . "');";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssss', $nome, $cognome, $email, hash("sha256", $password),$telefono, $data_nascita);
        if ($stmt->execute() && $stmt->affected_rows > 0)
            return $stmt;
        else
            return "";
    }
    public function login($email, $password)
    {
        $sql = sprintf("SELECT u.id
                        FROM utente u
                        WHERE (u.email = '%s') AND u.password = '%s'", $this->conn->real_escape_string($email), $this->conn->real_escape_string(hash("sha256", $password)));

        return $this->conn->query($sql);
    }
    public function getUser($id){
        $sql=sprintf("SELECT u.nome, u.cognome, u.email, u.telefono, u.data_nascita
        FROM utente u
        WHERE u.id=:id");
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id){
        
        $utente = $this->getUser($id);

        if ($utente == null)
            return false;

        $sql=sprintf("UPDATE utente SET active=0 WHERE id=:id");
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function modifyPassword($email, $oldPassword ,$newPassword)
    {
        $sql =sprintf("UPDATE utente
        SET password = :newPassword
        WHERE email = :email AND password = :oldPassword;");

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmt->bindValue(':oldPassword', $oldPassword, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();
    }
}


?>