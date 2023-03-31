<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/utente.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->email) || empty($data->oldPassword) || empty($data->newPassword)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);

if ($utente->modifyPassword($data->email, $data->oldPassword, $data->newPassword) == 1) {
    http_response_code(201);
    echo json_encode(["message" => "Password changed successfully"]);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Bad credentials"]);
}
?>