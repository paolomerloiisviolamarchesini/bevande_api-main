<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/valori_nutrizionali.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$db = new Database();
$conn = $db->connect();
$valori_nutrizionali = new Valori_Nutrizionali($conn);
$result = $valori_nutrizionali->getArchiveNutritionalValue();

$nvs = array();
for ($i = 0; $i < (count($result)); $i++) {
    $nv = array(
        "id" =>  $result[$i]['id'],
        "nome" => $result[$i]["nome"]
    );
    array_push($nvs, $nv);
}

echo json_encode($nvs);
?>