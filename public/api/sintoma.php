<?php
require_once $_SERVER["DOCUMENT_ROOT"] . "/global.php";
header('Content-Type: application/json');

$result = [];
switch ($_SERVER["REQUEST_METHOD"]) {
	case "GET":
		$id = $_GET["id"];

		// select_table_row("sintoma", "id_sintoma", $id);
		break;
	case "POST":
		$data = json_decode(file_get_contents("php://input"), true);
		$action = $data["action"];
		$id = $data["id"];

		if ($action == "delete") {
			$result = delete_table_row("sintoma", "id_sintoma", $id);
			$status = $result ? "success" : "error";
			$message = $result ? "Sintoma deletado" : "Não foi possível deletar o sintoma";
			$result = ["status" => $status, "message" => $message];
		}
		break;
}

echo json_encode($result);