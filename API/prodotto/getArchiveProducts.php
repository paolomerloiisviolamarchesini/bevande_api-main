<?php
require __DIR__ . '/../../MODEL/prodotto.php';
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");

$prodotto = new Prodotto();
$result = $prodotto->getArchiveProducts();

echo json_encode($result);
