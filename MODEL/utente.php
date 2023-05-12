<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../COMMON/$class.php";
});

set_exception_handler("errorHandler::handleException");
set_error_handler("errorHandler::handleError");

class Utente
{
	private Connect $db;
    private PDO $conn;

    public function __construct()
    {
        $this->db = new Connect;
        $this->conn = $this->db->connect();
    }
    
    public function createUser($nome,$cognome,$email,$password,$telefono,$data_nascita,$active)
    {
        $sql = sprintf("INSERT INTO utente (nome, cognome, email, `password`, telefono, data_nascita, active)
       VALUES (:nome,:cognome,:email,:password,:telefono,:data_nascita,:active)");

    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindValue(':cognome', $cognome, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':telefono', $telefono, PDO::PARAM_STR);
    $stmt->bindValue(':data_nascita', $data_nascita, PDO::PARAM_STR);
    $stmt->bindValue(':active', $active, PDO::PARAM_BOOL);

if ($stmt->execute())
{
return $stmt->rowCount();
}
else return "problemi";
    }

    public function login($email, $password)
    {
     $sql = sprintf("SELECT u.id
                        FROM utente u
                        WHERE u.email=:email AND u.password=:password AND u.active=1");
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);

if ($stmt->execute())
{
 return $stmt->fetch(PDO::FETCH_ASSOC);
}
else return "login failed";
    }
    public function getUser($id){
        $sql=sprintf("SELECT *
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
        if ($stmt->execute())
    {
    return 1;
    }
    else return "problemi";
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
        
        if ($stmt->execute())
        {
        return $stmt->rowCount();
        }
        else return "problemi";
        }
    

    public function getArchiveUsers(){
        $sql=sprintf("SELECT * FROM utente WHERE 1=1");
        $stmt=$this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


?>
