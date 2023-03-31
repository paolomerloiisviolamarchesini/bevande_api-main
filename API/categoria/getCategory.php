<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/categoria.php';
header("Content-type: application/json; charset=UTF-8");


if (!isset($_GET['id']) || empty($id = $_GET['id']))
{
    echo json_encode(array("Message" => "No id passed"));
    die();
}

$db = new Database();
$conn = $db->connect();
$categoria = new Categoria($conn);
//qui result è un array
$result = $categoria->getCategory($id);
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
    echo var_dump($result);
    die();
}
?>

