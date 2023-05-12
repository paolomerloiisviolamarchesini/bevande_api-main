<?php
header("Access-Control-Allow-Origin: *");
require __DIR__ . '/../../MODEL/ordine.php';
header("Content-type: application/json; charset=UTF-8");

$ordine = new Ordine();
$result = $ordine->getArchiveOrders();
$ordini = array();

for ($i = 0; $i < (count($result)); $i++) {
    $prodottiordine = $ordine->getOrderProducts($result[$i]["id"]);
    $prodotti = array(
    	"id" => $result[$i]["id"],
        "data_ora" => $result[$i]["data_ora"],
        "totale" => $result[$i]["totale"],
        "nome_user" => $result[$i]["nome_user"],        
        "cognome" => $result[$i]["cognome"],
        "email" => $result[$i]["email"],
        "telefono" => $result[$i]["telefono"],
        "ritiro" => $result[$i]["ritiro"],
        "prodotti" => $prodottiordine
    );
    array_push($ordini, $prodotti);
}

if (empty($ordini)) {
    http_response_code(404);
    echo json_encode(["Message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($ordini);
}
?>
