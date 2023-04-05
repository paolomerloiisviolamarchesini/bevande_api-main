<?php
require("../../COMMON/connect.php");
require("../../MODEL/utente.php");

header("Content-type: application/json; charset=UTF-8");

$data = json_decode(file_get_contents("php://input"));

if (empty($data->email) || empty($data->password))
{
    http_response_code(400);
    echo json_encode(["Message" => "All fields required"]);
    die();
}
$db = new Database();
$conn = $db->connect();
$utente = new Utente($conn);
$id=$utente->login($data->email, $data->password);
if ($id>0)
{
    http_response_code(200);
    echo json_encode(["response" => true, "userID" =>$id]);
}
else
{
    http_response_code(400);
    echo json_encode(["response" => false, "message" => "no record"]);
}

die();
?>
