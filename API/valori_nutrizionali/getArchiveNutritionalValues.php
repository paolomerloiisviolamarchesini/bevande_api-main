<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/valori_nutrizionali.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$db = new Database();
$conn = $db->connect();
$valori_nutrizionali = new Valori_Nutrizionali($conn);
$result = $valori_nutrizionali->getArchiveNutritionalValue();

if ($result != false) {
    $valori_nutrizionali = array();
    while ($row = $result->fetch_assoc())
    {
        $valori_nutrizionali[] = $row;
    }
    echo json_encode($valori_nutrizionali, JSON_PRETTY_PRINT);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Valori nutrizionali not found"]);
}
?>