<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/global.php";
header('Content-Type: application/json');

switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$id = $_GET["id"];

		handle_get($id);
		break;
	case "POST":
		$data = json_decode(file_get_contents("php://input"), true);
		$action = $data["action"];
		$id = $data["id"];

		handle_post($action, $id);
		break;
}

function handle_get($id) {
	return;
}

function handle_post($action, $id) {
	if ($action == "delete") {
		$result = delete_table_row("relatorio", "id_relatorio", $id);
		$status = $result ? "success" : "error";
	}
}

echo json_encode([
	// "status" => $status,
	"message" => "Booyah $id"
]);