<?php
require("../../COMMON/connect.php");
require("../../MODEL/utente.php");

if (!isset($_GET['id']) || empty($id = $_GET['id']))
{
    echo json_encode(array("Message" => "No id passed"));
    die();
}

$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);
//qui result è un array
$result = $utente->getUser($id);
//adesso result è un oggetto
$result = (json_decode(json_encode($result)));

if ((int)$result->id >0)
{

    echo json_encode($result, JSON_PRETTY_PRINT);
    die();
}
else
{
    echo json_encode(array("Message" => "No record"));
    die();
}
?>
