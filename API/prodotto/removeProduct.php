<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id)) {
    http_response_code(400);
    echo json_encode(["message" => "Insert a valid ID"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$prodotto= new Prodotto($conn);

if ($prodotto->removeProduct($data->$id) == true) 
{
    echo json_encode(["message" => "Operation completed", "response" => true]);
} else {
    echo json_encode(["message" => "Operation failed", "response" => false]);
}
?>