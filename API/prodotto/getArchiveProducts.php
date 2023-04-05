<?php
require __DIR__ . '/../../MODEL/prodotto.php';
require __DIR__ . '/../../COMMON/connect.php';
header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$prodotto = new Prodotto($conn);
$result = $prodotto->getArchiveProducts();

$products = array();
for ($i = 0; $i < (count($result)); $i++) {
    $product = array(
        "id" =>  $result[$i]["id"],
        "id_categoria" => $result[$i]["id_categoria"],
        "nome" => $result[$i]["nome"],
        "descrizione" => $result[$i]["descrizione"],
        "quantita" => $result[$i]["quantita"],
        "prezzo" => $result[$i]["prezzo"],
        "active" => $result[$i] ["active"]
    );
    array_push($products, $product);
}

echo json_encode($products);
