<?php

    function connect_to_database() {
        $server = "localhost";
        $user = "root"; 
        $password = "usbw";
        $database_name = "consultapronta_poc";

		$connection = mysqli_connect($server, $user, $password, $database_name);
		mysqli_set_charset($connection, "utf8mb4");

        return $connection;
    }

    function add_new_contact($user_id, $type, $value) {
        $connection = connect_to_database();

        $sql_command = "INSERT INTO contato (id_usuario, tipo, valor)
        VALUES ($user_id, '$type', '$value')";

        if (mysqli_query($connection, $sql_command)) {
            return mysqli_insert_id($connection); // returns the id of the inserted row
        } else {
            // handle failed query
            return -1;
        }
    }

    function add_new_user($connection, $name, $cpf, $email, $password, $user_type, $signup_date) {
        $sql_command = "INSERT INTO usuario (nome, cpf, email, senha_hash, tipo_usuario, data_cadastro)
        VALUES ('$name', '$cpf', '$email', '$password', '$user_type', '$signup_date')";

        if (mysqli_query($connection, $sql_command)) {
            return mysqli_insert_id($connection); // returns the id of the inserted row
        } else {
            // handle failed query
            return -1;
        }
    }

    function add_new_pacient($name, $cpf, $email, $password, $signup_date, $birth_date, $height, $weight, $allergies, $family_history, $diseases, $blood_type) {
        $connection = connect_to_database();
        $user_id = add_new_user($connection, $name, $cpf, $email, $password, "paciente", $signup_date);

        $sql_command = "INSERT INTO paciente (id_paciente, data_nascimento, altura, peso, alergias, historico_familiar, doencas, tipo_sanguineo)
        VALUES ($user_id, '$birth_date', '$height', '$weight', '$allergies', '$family_history', '$diseases', '$blood_type')";

        if (mysqli_query($connection, $sql_command)) {
            return $user_id;
        } else {
            return -1;
        }
    }
    
    function add_new_profissional($name, $cpf, $email, $password, $signup_date, $crm, $specialties) {
        $connection = connect_to_database();
        $user_id = add_new_user($connection, $name, $cpf, $email, $password, "profissional", $signup_date);

        $sql_command = "INSERT INTO profissional VALUES
        ($user_id, '$crm', '$specialties')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
    }

    function add_new_symptom($pacient_id, $description, $intensity, $date_begin, $local, $status) {
        $connection = connect_to_database();

        $sql_command = "
			INSERT INTO sintoma (id_paciente, descricao, intensidade, data_inicio, local, status)
			VALUES ($pacient_id, '$description', $intensity, '$date_begin', '$local', '$status')";
		$result = mysqli_query($connection, $sql_command);

		return $result;
    }

    function add_new_exam($pacient_id, $profissional_id, $title, $type, $result_description, $result_date) {
        $connection = connect_to_database();

        $sql_command = "INSERT INTO exame VALUES
        ($pacient_id, $profissional_id, '$title', '$type', '$result_description', '$result_date')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
    }

    function add_new_prescription($pacient_id, $profissional_id, $medicines, $use_orietations, $emission_date, $date) {
        $connection = connect_to_database();

        $sql_command = "
			INSERT INTO prescricao (id_paciente, id_profissional, medicamento, frequencia, duracao, data_emissao, orientacoes_uso)
			VALUES ($pacient_id, $profissional_id, '$medicines', '$use_orietations', '$emission_date', '$date')
		";

		$result = mysqli_query($connection, $sql_command);

		return $result;
    }

    function add_new_authorization($pacient_id, $profissional_id, $concession_date, $revocation_date, $status) {
        $connection = connect_to_database();

        $sql_command = "INSERT INTO autorizacao VALUES
        ($pacient_id, $profissional_id, '$concession_date', '$revocation_date', '$status')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
    }

    function add_new_clinic_note($profissional_id, $report_id, $datetime, $evolution_text, $diagnostic_hypothesis) {
        $connection = connect_to_database();

        $sql_command = "INSERT INTO anotacao_clinica VALUES
        ($profissional_id, $report_id, '$datetime', '$evolution_text', '$diagnostic_hypothesis')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
    }

	function add_new_report($pacient_id, $gen_date, $title, $period_start, $period_end, $analytical_data) {
		$connection = connect_to_database();

		$sql_command = "
			INSERT INTO relatorio (id_paciente, data_geracao, titulo, periodo_inicio, perido_fim, dados_analiticos)
			VALUES ($pacient_id, '$gen_date', '$title', '$period_start', '$period_end', '$analytical_data')
		";
		$result = mysqli_query($connection, $sql_command);

		return $result;
	}

    function delete_table_row($table, $row_name, $value) {
        $connection = connect_to_database();

        $sql_command = "DELETE FROM $table WHERE $row_name = $value";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
    }

	function user_exists($column, $value) {
		$connection = connect_to_database();

		$sql_command = "SELECT * FROM usuario WHERE $column = '$value'";
		$result = mysqli_query($connection, $sql_command);

		return mysqli_num_rows($result) > 0;
	}

	function get_user($email) {
		$connection = connect_to_database();

		$sql_command = "SELECT * FROM usuario WHERE email = '$email'";
		$result = mysqli_query($connection, $sql_command);

		return mysqli_fetch_assoc($result);
	}

	function get_user_by_id($id) {
		$connection = connect_to_database();

		$sql_command = "SELECT * FROM usuario WHERE id_usuario = '$id'";
		$result = mysqli_query($connection, $sql_command);

		return mysqli_fetch_assoc($result);
	}

	function update_user_email($id, $email) {
		$connection = connect_to_database();
		$safe_email = mysqli_real_escape_string($connection, $email);
		$sql_command = "UPDATE usuario SET email = '$safe_email' WHERE id_usuario = $id";

		return mysqli_query($connection, $sql_command);
	}

	// DEPRECATED (maybe)
    function check_if_user_exists($user_type, $email, $cpf) {
        $connection = connect_to_database();
        $error = [];

        $sql_command_email = "SELECT * FROM $user_type p INNER JOIN usuario usr ON usr.id_usuario = p.id_{$user_type} WHERE usr.email = '$email'";
        $sql_command_cpf = "SELECT * FROM $user_type p INNER JOIN usuario usr ON usr.id_usuario = p.id_{$user_type} WHERE usr.cpf = '$cpf'";
    
        if (mysqli_num_rows(mysqli_query($connection, $sql_command_email)) > 0) $error["email"] = true;
        if (mysqli_num_rows(mysqli_query($connection, $sql_command_cpf)) > 0) $error["cpf"] = true;

        return $error;
    }

	function get_patient($id) {
		$connection = connect_to_database();

		$sql_command = "SELECT * FROM paciente WHERE id_paciente = '$id'";
		$result = mysqli_query($connection, $sql_command);

		return mysqli_fetch_assoc($result);
	}
	
	function get_professional($id) {
		$connection = connect_to_database();

		$sql_command = "SELECT * FROM profissional WHERE id_profissional = '$id'";
		$result = mysqli_query($connection, $sql_command);

		return mysqli_fetch_assoc($result);
	}

	function get_user_contacts($id) {
		$connection = connect_to_database();

		$sql_command = "
			SELECT contato.tipo, contato.valor
			FROM usuario
			INNER JOIN contato ON usuario.id_usuario = contato.id_usuario
			WHERE usuario.id_usuario = $id
		";
		$result = mysqli_query($connection, $sql_command);

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
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

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
	}

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
			$base_url = $_SERVER["DOCUMENT_ROOT"] . "/includes";
			$result = get_rendered_template($base_url . "/{$table}.php", $item);

			$html .= (empty($result)) 
				? "<article class=\"light\">". implode(", ", $item) ."</article>"
				: $result;
		}

		return $html;
	}

	function update_patient_data($id, $dados) {
		$connection = connect_to_database();
		
		if (empty($dados)) return false;

		$sets = [];
		foreach ($dados as $key => $value) {
			$sets[] = "$key = '$value'";
		}
		$sql_set_string = implode(", ", $sets);

		$sql_command = "UPDATE paciente SET $sql_set_string WHERE id_paciente = $id";

		return mysqli_query($connection, $sql_command);
	}

	function update_patient_contacts($id, $dados) {
		$connection = connect_to_database();
		
		if (empty($dados)) return false;

		foreach ($dados as $tipo => $valor) {
			$sql_command = "UPDATE contato 
							SET valor = '$valor' 
							WHERE id_usuario = $id AND LOWER(tipo) = LOWER('$tipo')";
			
			mysqli_query($connection, $sql_command);
		}
		
		return true;
	}

	function get_patient_professionals($id_paciente) {
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
			WHERE paciente.id_paciente = $id_paciente
		";
		$result = mysqli_query($connection, $sql_command);

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
	}

	function get_patient_professionals_html($id_paciente) {
		$data = get_patient_professionals($id_paciente);
		if (empty($data)) {
			return "<p class=\"mensagem\">Você não possui nenhum profissional</p>";
		}

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(ROOT."/includes/profissional.php", $item);
		}

		return $html;
	}

	function update_authorization_status($id_paciente, $id_profissional, $status) {
		$connection = connect_to_database();

		$data_revogacao = $status == "ativa" ? "null" : "CURRENT_DATE";
		$sql_command = "
			UPDATE autorizacao
			SET status = '$status', data_revogacao = $data_revogacao
			WHERE id_paciente = $id_paciente AND id_profissional = $id_profissional
		";
		$result = mysqli_query($connection, $sql_command);

		return $result;
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

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
	}

	function get_patient_reports_html($id_paciente) {
		$data = get_patient_reports($id_paciente);

		if (empty($data)) {
			return "<p class=\"mensagem\">Você não possui nenhum relatório</p>";
		}

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(ROOT."/includes/relatorio_card.php", $item);
		}

		return $html;
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

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
	}

	function get_professional_reports_html($id_profissional) {
		$data = get_professional_patients_reports($id_profissional);

		if (empty($data)) {
			return "<p class=\"mensagem\">Você não possui nenhum relatório de pacientes</p>";
		}

		$html = "";
		foreach ($data as $item) {
			$html .= get_rendered_template(ROOT."/includes/relatorio_card.php", $item);
		}

		return $html;
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

	function get_report($id_report) {
		$connection = connect_to_database();

		$sql_command = "
			SELECT *
			FROM relatorio
			WHERE id_relatorio = $id_report
		";
		$result = mysqli_query($connection, $sql_command);

		return ($result) ? mysqli_fetch_array($result, MYSQLI_ASSOC) : [];
	}

	function get_report_notes($id_report) {
		$connection = connect_to_database();

		$sql_command = "
			SELECT anotacao_clinica.*
			FROM relatorio
			INNER JOIN anotacao_clinica ON anotacao_clinica.id_relatorio = relatorio.id_relatorio
			WHERE relatorio.id_relatorio = $id_report
		";
		$result = mysqli_query($connection, $sql_command);

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
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

		return ($result) ? mysqli_fetch_all($result, MYSQLI_ASSOC) : [];
	}
?>