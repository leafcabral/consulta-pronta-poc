<?php
	require_once __DIR__ . "/constants.php";

	require_once __DIR__ . "/database/connection.php";
	require_once __DIR__ . "/database/user.php";
	require_once __DIR__ . "/database/patient.php";
	require_once __DIR__ . "/database/professional.php";
	require_once __DIR__ . "/database/medical_record.php";
	require_once __DIR__ . "/database/report.php";


	// TODO: mover todos esses para a pasta de api da maneira correta

	function get_patient_data_html($id, $table, $null_message = "Vazio", $is_consulta_filtered = false) {
		$data = get_patient_data($id, $table);
		$is_data_empty = empty($data);

		if ($table == "consulta" && !$is_data_empty && $is_consulta_filtered) {
			$temp = $data;

			for ($i = 0; $i < count($data); $i += 1) {
				if ($data[$i]["status"] != "agendada") {
					array_splice($temp, $i, 1);
				}
			}

			$data = $temp;
			$is_data_empty = empty($data);
		}

		if ($is_data_empty) {
			return "<p class=\"mensagem\">$null_message</p>";
		}

		$html = "";
		foreach ($data as $item) {
			$result = get_rendered_template(COMPONENTS . "{$table}.php", $item);

			$html .= (empty($result)) 
				? "<article class=\"light\">". implode(", ", $item) ."</article>"
				: $result;
		}

		return $html;
	}
	
	function get_patient_professionals_html($id_paciente) {
		$data = get_patient_professionals($id_paciente);

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(COMPONENTS . "profissional.php", $item);
		}

		return $html;
	}

	function get_patient_reports_html($id_paciente) {
		$data = get_patient_reports($id_paciente);

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(COMPONENTS . "relatorio_card.php", $item);
		}

		return $html;
	}

	function get_professional_reports_html($id_profissional) {
		$data = get_professional_patients_reports($id_profissional);

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(COMPONENTS . "relatorio_card.php", $item);
		}

		return $html;
	}
?>