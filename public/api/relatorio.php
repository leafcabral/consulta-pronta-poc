<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/global.php";
header('Content-Type: application/json');

$putput = file_get_contents('php://input');
$data = json_decode($putput, true);

$action = (isset($data["action"])) ? $data["action"] : null;
$id = $data["id"];

$status = "";

if ($action == "delete") {
	$result = delete_table_row("relatorio", "id_relatorio", $id);
	$status = $result ? "success" : "error";
}

echo json_encode([
	"status" => $status,
	"message" => "Booyah $id"
]);