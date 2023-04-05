<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->nome) || empty($data->descrizione) || 
empty($data->prezzo) || empty($data->id_categoria) || 
empty($data->quantita) || empty($data->active)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$prodotto= new Prodotto($conn);
$result=$prodotto->addProduct($data->nome ,$data->descrizione,$data->prezzo,$data->id_categoria,$data->quantita,$data->active);
echo var_dump($result);
 $result = (json_decode(json_encode($result)));

if ((int)$result->id != 0)
{
    http_response_code(201);
    echo json_encode(["message" => "Registration completed", "productID" => $productID->fetch_assoc()['id'], "response" => true]);
    die();
} else {
    http_response_code(400);
    echo json_encode(["message" => "Registration failed", "response" => false]);
    die();
}
?>