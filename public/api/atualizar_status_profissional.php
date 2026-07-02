<?php
header("Content-Type: application/json");
require_once $_SERVER["DOCUMENT_ROOT"] . "/global.php";

$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
	$id = $_GET["id"];
	$status = $_GET["status"];

	$sucesso = update_authorization_status($_SESSION["id_usuario"], $id, $status);
}

echo json_encode([
	"sucesso" => $sucesso,
	"data_revogacao" => ($status == "ativa") ? null : date("Y-m-d")
]);