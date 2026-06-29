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

        $sql_command = "INSERT INTO sintoma VALUES
        ($pacient_id, '$description', $intensity, '$date_begin', '$local', '$status')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
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

        $sql_command = "INSERT INTO prescricao VALUES
        ($pacient_id, $profissional_id, '$medicines', '$use_orietations', '$emission_date', '$date')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
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

    function add_new_report($pacient_id, $gen_date, $title, $period_analyzed, $analytical_data) {
        $connection = connect_to_database();

        $sql_command = "INSERT INTO relatorio VALUES
        ($pacient_id, '$gen_date', '$title', '$period_analyzed', '$analytical_data')";

        if (mysqli_query($connection, $sql_command)) {
            // handle succesful query
        } else {
            // handle failed query
        }
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

	function get_patient_data_html($id, $table, $null_message = "Vazio") {
		$data = get_patient_data($id, $table);

		if (empty($data)) {
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

		// var_dump($data);
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
?>