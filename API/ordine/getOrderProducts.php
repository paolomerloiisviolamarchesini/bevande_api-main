<?php
header("Access-Control-Allow-Origin: *");
require __DIR__ . '/../../MODEL/ordine.php';

header("Content-type: application/json; charset=UTF-8");

if (!isset($_GET['id']) || empty($id = $_GET['id']))
{
    echo json_encode(array("Message" => "No id passed"));
    die();
}

$ordine = new Ordine($conn);
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

