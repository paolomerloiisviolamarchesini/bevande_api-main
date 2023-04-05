<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/ordine.php';

header("Content-type: application/json; charset=UTF-8");

if (!isset($_GET['id']) || empty($id = $_GET['id']))
{
    echo json_encode(array("Message" => "No id passed"));
    die();
}

$db = new Database();
$conn = $db->connect();
$ordine = new Ordine($conn);
//qui result è un array
$result = $ordine->getOrderProducts($id);

$ordersProduct = array();
for ($i = 0; $i < (count($result)); $i++) {
    $orderProduct = array(
        "id" =>  $result[$i]["id"],
        "nome" => $result[$i]["nome"],
    );
    array_push($ordersProduct, $orderProduct);
}

echo json_encode($ordersProduct);

