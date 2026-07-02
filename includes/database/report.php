<?php
require_once __DIR__ . "/connection.php";


function add_new_report($pacient_id, $gen_date, $title, $period_start, $period_end, $analytical_data) {
	return insert_table_row("relatorio", [
		"id_paciente" => $pacient_id,
		"data_geracao" => $gen_date,
		"titulo" => $title,
		"periodo_inicio" => $period_start,
		"perido_fim" => $period_end,
		"dados_analiticos" => $analytical_data
	]);
}

function get_report($id) {
	return select_table_row("relatorio", "id_relatorio", $id);
}

function get_report_notes($id) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT anotacao_clinica.*
		FROM relatorio
		INNER JOIN anotacao_clinica ON anotacao_clinica.id_relatorio = relatorio.id_relatorio
		WHERE relatorio.id_relatorio = $id
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}

function get_patient_reports($id_paciente) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT relatorio.*
		FROM paciente
		INNER JOIN relatorio ON paciente.id_paciente = relatorio.id_paciente
		WHERE paciente.id_paciente = $id_paciente
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}

function get_professional_patients_reports($id_profissional) {
	$connection = connect_to_database();

	$sql_command = "
		SELECT relatorio.*, usuario.nome AS paciente_nome
		FROM relatorio
		INNER JOIN paciente ON paciente.id_paciente = relatorio.id_paciente
		INNER JOIN autorizacao ON autorizacao.id_paciente = paciente.id_paciente
		INNER JOIN usuario ON paciente.id_paciente = usuario.id_usuario
		WHERE autorizacao.id_profissional = $id_profissional
		AND autorizacao.status = 'ativa'
	";
	$result = mysqli_query($connection, $sql_command);

	return check_result_return_all($result);
}