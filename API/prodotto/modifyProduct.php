<?php
require("../../COMMON/connect.php");
require("../../MODEL/prodotto.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents('php://input'));

if (empty($data->id)|| empty($data->nome) || empty($data->descrizione) || empty($data->prezzo) || empty($data->id_categoria))
{
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

if ($data->amount < 0)
{
    echo json_encode(["message" => "Type valid amount"]);
    die();
}

$database = new Database();
$db = $database->connect();
$product = new Prodotto($db);
if ($product->modifyProduct($data->id, $data->nome, $data->descrizione, $data->prezzo, $data->id_categoria ))
{
    echo json_encode(array("Message" => "Product changed", "Response" => true));
    die();
}
else
{
    echo json_encode(array("Message" => "Error", "Response" => false));
    die();
}

?>