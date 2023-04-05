<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/utente.php';
header("Content-type: application/json; charset=UTF-8");

$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);
$result = $utente->getArchiveUsers();

$users = array();
for ($i = 0; $i < (count($result)); $i++) {
    $user = array(
        "id" =>  $result[$i]['id'],
        "cognome" => $result[$i]["cognome"],
        "nome" => $result[$i]["nome"],
        "email" => $result[$i]["email"],
        "password" => $result[$i]["password"],
        "telefono" => $result[$i]["telefono"],
        "active" => $result[$i] ["active"],
        "data_nascita" => $result[$i] ["data_nascita"]
    );
    array_push($users, $user);
}

echo json_encode($users);
?>