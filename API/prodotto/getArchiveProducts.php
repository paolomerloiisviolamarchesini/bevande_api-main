<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/prodotto.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$db = new Database();
$conn = $db->connect();
$prodotto = new Prodotto($conn);
$result = $prodotto->getArchiveProducts();

if ($result != false) {
    $prodotto = array();
    while ($row = $result->fetch_assoc())
    {
        $prodotto[] = $row;
    }
    echo json_encode($prodotto, JSON_PRETTY_PRINT);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Product not found"]);
}
?>
