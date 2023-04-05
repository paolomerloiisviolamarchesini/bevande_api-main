<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/ordine.php';
header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$ordine = new Ordine($conn);
$result = $ordine->getArchiveOrders();

$orders = array();
for ($i = 0; $i < (count($result)); $i++) {
    $order = array(
        "id" =>  $result[$i]["id"],
        "data_ora" => $result[$i]["data_ora"],
        "nome_cliente" => $result[$i]["nome_cliente"],
        "cognome_cliente" => $result[$i]["cognome_cliente"],
        "totale" => $result[$i]["nome_cliente"],
        "email_cliente" => $result[$i]["email_cliente"],
        "telefono_cliente" => $result[$i]["telefono_cliente"],
        "indirizzo_cliente" => $result[$i]["indirizzo_cliente"],
        "ritiro" => $result[$i] ["ritiro"]
    );
    array_push($orders, $order);
}

echo json_encode($orders);
?>