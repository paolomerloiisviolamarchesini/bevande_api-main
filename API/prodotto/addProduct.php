<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';

$data = json_decode(file_get_contents("php://input"));
//echo var_dump($data);

if (empty($data->nome) || empty($data->descrizione) ||
empty($data->prezzo) || empty($data->categoria) ||
empty($data->quantita) || empty($data->active)) {
    
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$prodotto= new Prodotto($conn);

if ($prodotto->addProduct($data->nome ,$data->descrizione,$data->prezzo,$data->categoria,$data->quantita,$data->active))
{
    echo json_encode(["message" => "Registration completed"]);
    die();
    
} else {
echo json_encode(["message" => "Registration failed"]);
}
?>
