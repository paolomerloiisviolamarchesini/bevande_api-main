<?php
require __DIR__ . '/../../COMMON/connect.php';
require __DIR__ . '/../../MODEL/utente.php';
header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->nome) || empty($data->cognome) || empty($data->email) || empty($data->password) || empty($data->telefono) || empty($data->data_nascita)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);

if ($user->createUser($data->nome, $data->cognome, $data->email, $data->password, $data->telefono, $data->data_nascita) == true) {
    $userID = $user->login($data->email, $data->password);

    echo json_encode(["message" => "Registration completed", "userID" => $userID->fetch_assoc()['id'], "response" => true]);
} else {
    echo json_encode(["message" => "Registration failed successfully ", "response" => false]);
}
?>