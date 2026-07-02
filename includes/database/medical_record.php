<?php
require_once __DIR__ . "/connection.php";


function add_new_exam($pacient_id, $profissional_id, $title, $type, $result_description, $result_date) {
	return insert_table_row("exame", [
		"id_paciente" => $pacient_id,
		"id_profissional" => $profissional_id,
		"titulo" => $title,
		"tipo" => $type,
		"descricao_resultado" => $result_description,
		"data_resultado" => $result_date,
	]);
}

function add_new_prescription($pacient_id, $profissional_id, $medicines, $frequency, $duration, $emission_date, $orientations) {
	return insert_table_row("prescricao", [
		"id_paciente" => $pacient_id,
		"id_profissional" => $profissional_id,
		"medicamento" => $medicines,
		"frequencia" => $frequency,
		"duracao" => $duration,
		"data_emissao" => $emission_date,
		"orientacoes_uso" => $orientations
	]);
}

function add_new_clinic_note($profissional_id, $report_id, $datetime, $evolution_text, $diagnostic_hypothesis) {
	return insert_table_row("anotacao_clinica", [
		"id_profissional" => $profissional_id,
		"id_relatorio" => $report_id,
		"data_hora" => $datetime,
		"texto_evolucao" => $evolution_text,
		"hipotese_diagnostica" => $diagnostic_hypothesis
	]);
}