<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/valori_nutrizionali.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->nome)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$val= new Valori_Nutrizionali($conn);

if ($val->setNutritionalValue($data->nome)==1)
{
    http_response_code(201);
    echo json_encode(["message" => "Registration completed"]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Registration failed"]);
}
?>