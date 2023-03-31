<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/valori_nutrizionali.php';
header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$valori_nutrizionali = new Valori_Nutrizionali($conn);
$result = $valori_nutrizionali->getArchiveNutritionalValues();

if ($result->num_rows > 0) {
    $archive = array();
    while ($row = $result->fetch_assoc())
    {
        $archive[] = $row;
    }
    echo json_encode($archive, JSON_PRETTY_PRINT);
}
else {
    http_response_code(400);
    echo json_encode(["message" => "Valori nutrizionali not found"]);
    die();
}
?>
