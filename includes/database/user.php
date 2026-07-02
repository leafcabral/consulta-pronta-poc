<?php
require_once __DIR__ . "/connection.php";

function add_new_user($name, $cpf, $email, $password, $user_type, $signup_date) {
	return insert_table_row("usuario", [
		"nome" => $name,
		"cpf" => $cpf,
		"email" => $email,
		"senha_hash" => $password,
		"tipo_usuario" => $user_type,
		"data_cadastro" => $signup_date
	]);
}

function get_user($id) {
	return select_table_row("usuario", "id_usuario", $id);
}

function get_user_by_email($email) {
	return select_table_row("usuario", "email", $email);
}

function update_user_email($id, $email) {
	return update_table_row("usuario", ["email" => $email], "id", $id);
}

function user_exists($column, $value) {
	$select_result = select_table_row("usuario", $column, $value);
	if ($select_result == false) { return $select_result; }
	return count($select_result) > 0;
}

function user_really_exists($email, $cpf) {
	return [
		"email" => user_exists("email", $email),
		"cpf" => user_exists("cpf", $cpf)
	];
}

function add_new_contact($user_id, $type, $value) {
	return insert_table_row("contato", [
		"id_usuario" => $user_id,
		"tipo" => $type,
		"valor" => $value
	]);
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

	return check_result_return_all($result);
}

function update_user_contacts($id, $dados) {
	foreach ($dados as $tipo => $valor) {
		update_table_row("contato", ["valor" => $valor], "tipo", $tipo);
	}
	return true;
}