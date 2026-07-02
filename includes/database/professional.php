<?php
require_once __DIR__ . "/connection.php";
require_once __DIR__ .  "/user.php";

function add_new_profissional($name, $cpf, $email, $password, $signup_date, $crm, $specialties) {
	$user_id = add_new_user($name, $cpf, $email, $password, "profissional", $signup_date);
	if (!$user_id) { return false; }

	return insert_table_row("profissional", [
		"crm" => $crm,
		"especialidades" => $specialties
	]);
}

function get_professional($id) {
	return select_table_row("profissional", "id_profissional", $id);
}

function professional_can_view_report($id_profissional, $id_report) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT 1
		FROM relatorio
		INNER JOIN autorizacao ON relatorio.id_paciente = autorizacao.id_paciente
		WHERE relatorio.id_relatorio = $id_report
		AND autorizacao.id_profissional = $id_profissional
		AND autorizacao.status = 'ativa'
	";
	$result = mysqli_query($connection, $sql_command);

	return ($result && mysqli_num_rows($result) > 0);
}