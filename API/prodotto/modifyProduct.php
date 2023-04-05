<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->id)||empty($data->nome) || empty($data->descrizione) || 
empty($data->prezzo) || empty($data->id_categoria) || 
empty($data->quantita) || empty($data->active)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$prodotto= new Prodotto($conn);
if ($prodotto->modifyProduct($data->id,$data->nome ,$data->descrizione,$data->prezzo,$data->id_categoria,$data->quantita,$data->active)==1) 
{
    http_response_code(201);
    echo json_encode(["message" => "Modify completed"]);
    die();
} else {
    http_response_code(400);
    echo json_encode(["message" => "Modify failed"]);
    die();
}
?>