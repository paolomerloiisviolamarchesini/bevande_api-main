<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id)) {
    http_response_code(400);
    echo json_encode(["message" => "Insert a valid ID"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$prodotto= new Prodotto($conn);
if ($prodotto->removeProduct($data->id)==1) 
{
    http_response_code(201);
    echo json_encode(["message" => "Delete completed"]);
    die();
} else {
    http_response_code(400);
    echo json_encode(["message" => "Delete failed"]);
    die();
}
?>