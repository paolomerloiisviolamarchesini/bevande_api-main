<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/ordine.php';
header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$ordine = new Ordine($conn);
$result = $ordine->getArchiveOrders();

if ($result != false) {
    $ordini = array();
    while ($row = $result->fetch_assoc())
    {
        $ordini[] = $row;
    }
    echo json_encode($ordini, JSON_PRETTY_PRINT);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Order not found"]);
}
?>