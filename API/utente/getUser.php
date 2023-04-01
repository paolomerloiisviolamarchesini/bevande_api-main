<?php
require("../../COMMON/connect.php");
require("../../MODEL/utente.php");

header("Content-type: application/json; charset=UTF-8");
$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[5]->$id)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}
$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);
$result = $utente->getUser($id);

if ($result != false) {
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(["message" => "User not found"]);
}