<?php
require_once __DIR__ . "/connection.php";
require_once __DIR__ .  "/user.php";

function add_new_pacient($name, $cpf, $email, $password, $signup_date, $birth_date, $height, $weight, $allergies, $family_history, $diseases, $blood_type) {
	$user_id = add_new_user($name, $cpf, $email, $password, "paciente", $signup_date);
	if (!$user_id) { return false; }

	return insert_table_row("paciente", [
		"data_nascimento" => $birth_date,
		"altura" => $height,
		"peso" => $weight,
		"alergias" => $allergies,
		"historico_familiar" => $family_history,
		"doencas" => $diseases,
		"tipo_sanguineo" => $blood_type
	]);
}

function get_patient($id) {
	return select_table_row("paciente", "id_paciente", $id);
}

function update_patient($id, $dados) {
	return update_table_row("paciente", $dados, "id_paciente", $id);
}

function get_patient_data($id, $table) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT {$table}.*
		FROM paciente
		INNER JOIN $table ON paciente.id_paciente = {$table}.id_paciente
		WHERE paciente.id_paciente = $id
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}

function add_new_symptom($pacient_id, $description, $intensity, $date_begin, $local, $status) {
	return insert_table_row("sintoma", [
		"id_paciente" => $pacient_id,
		"descricao" => $description,
		"intensidade" => $intensity,
		"data_inicio" => $date_begin,
		"local" => $local,
		"statu" => $status
	]);
}

function get_symptoms_by_period($id_paciente, $data_inicio, $data_fim) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT * FROM sintoma 
		WHERE
			id_paciente = $id_paciente 
			AND data_inicio BETWEEN '$data_inicio 00:00:00' AND '$data_fim 23:59:59'
		ORDER BY data_inicio DESC
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}

function get_patient_professionals($id) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT
			usuario.nome,
			profissional.id_profissional,
			profissional.crm,
			profissional.especialidades,
			autorizacao.data_concessao,
			autorizacao.data_revogacao,
			autorizacao.status
		FROM paciente
		INNER JOIN autorizacao ON paciente.id_paciente = autorizacao.id_paciente
		INNER JOIN profissional ON autorizacao.id_profissional = profissional.id_profissional
		INNER JOIN usuario ON profissional.id_profissional = usuario.id_usuario
		WHERE paciente.id_paciente = $id
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}

function add_new_authorization($pacient_id, $profissional_id, $concession_date, $revocation_date, $status) {
	return insert_table_row("autorizacao", [
		"id_paciente" => $pacient_id,
		"id_profissional" => $profissional_id,
		"data_concessao" => $concession_date,
		"data_revogacao" => $revocation_date,
		"status" => $status,
	]);
}

function update_authorization_status($id_paciente, $id_professional, $status) {
	$connection = connect_to_database();

	$data_revogacao = $status == "ativa" ? "null" : "CURRENT_DATE";
	$sql_command = "
		UPDATE autorizacao
		SET status = '$status', data_revogacao = $data_revogacao
		WHERE id_paciente = $id_paciente AND id_profissional = $id_professional
	";

	return mysqli_query($connection, $sql_command);
}